<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Selection extends Model
{
    use HasFactory;


    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getProductsInACart() {
        $user_id=Auth::user()->id;
        return self::
        select('*', 'selections.id as id')
        ->join('products', 'selections.product_id', '=', 'products.id')
        ->where('selections.user_id', $user_id)
        ->get();
    }

    public static function getSumInACart()
    {
        $productInACart = self::getProductsInACart();
        // dd($productInACart);
        return $productInACart
        ->map(function ($productInACart) {
            return $productInACart->price * $productInACart->quantity;
        })->sum();
    }

    public static function deleteProductFromCart($request)
    {
        $productId = $request->query('id');
        //TODO [ 書き方直す ]
        $productId = (integer) $productId;
        self::getProductsInACart()->where('id', $productId)->first()->delete();
    }
}
