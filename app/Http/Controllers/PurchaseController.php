<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PaymentInformationRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Selection;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Completion;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function addToCart(Product $product, Request $request)
    {
        $quantity = $request->quantity;

        $cart = new Selection();
        $cart->all();


        if (!$cart->where('product_id', $product->id)->exists()) {
            $cart->product_id = $product->id;
            $cart->user_id = Auth::user()->id;
            $cart->quantity = $quantity;
            $cart->timestamps = false;
            $cart->save();
        } else {

            $cart->user_id = Auth::user()->id;

            $cart->timestamps = false;
            $cart->where('product_id', '=',  $product->id)->increment('quantity', $quantity);
        }

        return back();
    }

    public function shoppingCartPage(): View
    {

        $cart = Selection::select('*', 'selections.id as id')->join('products', 'selections.product_id', '=', 'products.id')->get();
        $cart->user_id = Auth::user()->id;


        $sum = $cart->map(function ($cart) {
            return $cart->price * $cart->quantity;
        })->sum();


        return View('shopping-cart', compact('cart', 'sum'));
    }

    public function removeFromCart(Request $request)
    {

        $user = Auth::user()->id;

        $productId = $request->query('id');

        $productId = (int) $productId;

        $cart = Selection::get();

        $item = Selection::where('id', $productId)->first();
        $cart->user_id = Auth::user()->id;

        $item->delete();

        return back();
    }


    public function inputShippingAddress()
    {
        return view('input-shipping-address');
    }

    public function inputPaymentInformation(AddressRequest $request)
    {
        $data = [
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'name' => $request->name,
        ];

        session($data);

        return view('input-payment-information', $data);
    }

    public function confirm(PaymentInformationRequest $request)
    {
        $id = Auth::id();
        $cart = Selection::getCartProducts($id);

        $sum_price = Selection::sumPrice($cart);
        $sum_quantity = Selection::sumQuantity($cart);
        $product_id = Selection::getProductIdsFromCart($cart);
        $product = Product::getCartProduct($product_id);
        $product_quantity = Selection::getProductQuantitiesFromCart($cart);
        $product_price = Selection::getProductPricesFromCart($product);
        $product_sum_price = $product->map(function ($product, $key) use ($product_quantity, $product_price) {
            return $product_quantity[$key] * $product_price[$key];
        });

        $data = [
            'card_number' => $request->card_number,
            'expiration_month' => $request->expiration_month,
            'expiration_year' => $request->expiration_year,
            'cvv' => $request->cvv,
            'cardholder_name' => $request->cardholder_name,
            'cart' => $cart,
            'sum_price' => $sum_price,
            'sum_quantity' => $sum_quantity,
            'product_id' => $product_id,
            'quantity' => $product_quantity,
            'price' => $product_sum_price
        ];

        session($data);

        $data = $request->session()->all();

        return view('confirm-purchase', $data);
    }

    public function store(Request $request)
    {
        $purchase_request = new PurchaseRequest();
        $data = $request->session()->all();
        $validator = Validator::make($data, $purchase_request->rules());
        if ($validator->fails()) {
            return redirect()->route('input-shipping-address')
                ->withErrors($validator)
                ->withInput();
        }

        Order::createOrder($data);

        $request->session()->forget($purchase_request->attributes());

        return view('complete-purchase');
    }

    public function showHistory()
    {
        $completions = Completion::getPurchaseProducts();

        return view('purchase_history', compact('completions'));
    }
}
