<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Selection;
use App\Models\User;
use App\Models\Product;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function addToCart(Product $product, Request $request)
    {
        $quantity = $request->quantity;

        $cart = New Selection();
        $cart->all();
        // $product_id = $product->id;
        // dd($product_id);


        if(!$cart->where('product_id', $product->id)->exists()) {
            $cart->product_id=$product->id;
            $cart->user_id=Auth::user()->id;
            $cart->quantity=$quantity;
            $cart->timestamps = false;
            $cart->save();
        } else {
            
            $cart->timestamps = false;
            $cart->where('product_id', '=',  $product->id)->increment('quantity', $quantity);
        }
        
        return back();
    }

    public function shoppingCartPage():View
    {
        
        $cart = Selection::join('products', 'selections.product_id', '=', 'products.id')->get();
        $cart->user_id=Auth::user()->id;

        $sum = $cart->map(function($cart) { return $cart->price * $cart->quantity; })->sum();

        

        return View('shopping-cart', compact('cart', 'sum'));

    }

    public function removeFromCart($id):View
    {

        $cart_product = Selection::find($id);
        $cart_product->delete();

        return View('shopping-cart', compact('cart_product'));
    }


}
