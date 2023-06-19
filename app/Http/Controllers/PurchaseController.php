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
        // $product_id = $product->id;
        // dd($product_id);


        if (!$cart->where('product_id', $product->id)->exists()) {
            $cart->product_id = $product->id;
            $cart->user_id = Auth::user()->id;
            $cart->quantity = $quantity;
            $cart->timestamps = false;
            $cart->save();
        } else {

            $cart->timestamps = false;
            $cart->where('product_id', '=',  $product->id)->increment('quantity', $quantity);
        }

        return back();
    }

    public function shoppingCartPage(): View
    {

        $cart = Selection::join('products', 'selections.product_id', '=', 'products.id')->get();
        $cart->user_id = Auth::user()->id;

        $sum = $cart->map(function ($cart) {
            return $cart->price * $cart->quantity;
        })->sum();



        return View('shopping-cart', compact('cart', 'sum'));
    }

    public function removeFromCart(Request $request)
    {

        $id = $request->query('id');
        $id = (integer) $id;
        // dd($id);

        // $cart = Selection::get();
        // dd($cart);
        $item = Selection::where('id', $id)->first();
        dd($item);
        $item->delete();
        
        // $cart->join('products', 'selections.product_id', '=', 'products.id')->all();

        // $sum = $cart->map(function($cart) { return $cart->price * $cart->quantity; })->sum();

        return back();
        // return View('shopping-cart', compact('cart', 'sum'));
    }

    public function inputShippingAddress(): View
    {
        return view('input-shipping-address');
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
