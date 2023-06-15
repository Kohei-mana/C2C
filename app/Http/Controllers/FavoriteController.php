<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Favorite;

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
        dd($favorite);
        return back();
    }

    public function removeFavorite(Product $product, Request $request){
        $user=Auth::user()->id;
        $favorite=Favorite::where('product_id', $product->id)->where('user_id', $user)->first();
        $favorite->delete();
        return back();
    }

    public function showFavoriteProducts() {
        // $product = Product::
        $user = Auth::user()->id;
        $favorite_products = Favorite::join('products', 'favorites.product_id', '=', 'products.id')->get();
        return View('favorite', compact('user', 'favorite_products'));
    }
}
