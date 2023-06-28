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

        $user_id = Auth::user()->id;
        $cart = new Selection();
        $cart->all();

        // カート内数量が在庫数量最大の場合、エラーメッセージを表示
        if($quantity==0) {
            return back()->with('error_message', 'これ以上追加できません');
        }

        if (!$cart->where('product_id', $product->id)->where('user_id', $user_id)->exists()) {
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

        return back()->with('sucsess_message', 'カートに追加しました');
    }

    public function shoppingCartPage(): View
    {
        $productsInACart = Selection::getProductsInACart();
        $sum = Selection::getSumInACart();
        if($sum == 0) {
            
        }

        return View('shopping-cart', compact('productsInACart', 'sum'));
    }

    public function removeFromCart(Request $request)
    {

        Selection::deleteProductFromCart($request);
    
        return back()->with('delete_message', 'カートから削除しました。');
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
        $user_id = Auth::user()->id;
        $orders = Order::select('id', 'sum_quantity', 'sum_price', 'created_at')->where('user_id', '=', $user_id)->orderBy('created_at', 'desc')->get();
        
        $completions = Completion::getPurchaseProducts();

        return view('purchase_history', compact('orders', 'completions'));
    }
}
