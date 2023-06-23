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
    public function makeFavorite(Product $product)
    {
        $favorite = New Favorite();
        $favorite->product_id=$product->id;
        $favorite->user_id=Auth::user()->id;
        $favorite->timestamps = false;
        $favorite->save();
        return back();

    }

    public function removeFavorite(Product $product){
        
        $favorite = Favorite::getFavorite($product);
        $favorite->delete();

        //もしログイン状態なら、
        $login = Auth::check();
        if($login){
            $favorite = Favorite::getFavorite($product);
        } else {
            $favorite = null;
        }

        return back();
    }

    public function showFavoriteProducts() {
        $user = Auth::user()->id;
        $favorite_products = Favorite::getFavoriteProducts();
        
        return View('favorite', compact('favorite_products'));
    }
}
