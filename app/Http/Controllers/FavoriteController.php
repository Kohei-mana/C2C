<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class FavoriteController extends Controller
{
    //
    public function makeFavorite(Product $product, Request $request)
    {
        $favorite = New Favorite();
        $favorite->product_id=$product->id;
        $favorite->user_id=Auth::user()->id;
        $favorite->timestamps = false;
        $favorite->save();
        // return View('product-detail');
        return back();
    }

    public function removeFavorite(Product $product){
        $user=Auth::user()->id;
        $favorite=Favorite::where('product_id', $product->id)->where('user_id', $user)->first();
        // dd($favorite);
        $favorite->delete();

        //もしログイン状態なら、
        $login = Auth::check();
        
        if($login){
            $favorite = Favorite::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
        } else {
            $favorite = null;
        }

        return back();
    }

    public function showFavoriteProducts() {
        // $product = Product::
        $user = Auth::user()->id;
        $favorite_products = Favorite::join('products', 'favorites.product_id', '=', 'products.id')->where('favorites.user_id', $user)->get();
        
        return View('favorite', compact('favorite_products'));
    }
}
