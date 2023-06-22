<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Selection;
use App\Models\User;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Completion;

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
        $cart = Selection::getProductsInACart();
        $sum = Selection::getSumInACart();

        return View('shopping-cart', compact('cart', 'sum'));
    }

    public function removeFromCart(Request $request)
    {
      
        Selection::deleteProductFromCart($request);
    
        return back();
    }


    public function inputShippingAddress(): View
    {
        return view('input-shipping-address');
    }

    public function inputPaymentInformation(): View
    {
        return view('input-payment-information');
    }

    public function store(): View
    {
        return view('complete-purchase');
    }

    public function showHistory()
    {
        $completions = Completion::whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->with(['order', 'product'])
            ->get();

        return view('purchase_history', compact('completions'));
    }
}
