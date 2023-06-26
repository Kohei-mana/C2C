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
        ->where('listing_status', '=', 0)
        ->get();
    }
    

    public static function getSumInACart()
    {
        $productInACart = self::getProductsInACart();
        return $productInACart
        ->map(function ($productInACart) {
            return $productInACart->price * $productInACart->quantity;
        })->sum();
    }

    public static function deleteProductFromCart($request)
    {
        $productId = $request->query('id');
        
        $productId = (integer) $productId;
        self::getProductsInACart()->where('id', $productId)->first()->delete();
    }

    public static function getCartProducts($id)
    {
        return self::select('*', 'selections.id as id')->join('products', 'selections.product_id', '=', 'products.id')->where('selections.user_id', $id)->get();
    }

    public static function sumPrice($cart)
    {
        return $cart->map(function ($cart) {
            return $cart->price * $cart->quantity;
        })->sum();
    }

    public static function sumQuantity($cart)
    {
        return $cart->map(function ($cart) {
            return $cart->quantity;
        })->sum();
    }

    public static function getProductIdsFromCart($cart)
    {
        return $cart->map(function ($cart) {
            return $cart->product_id;
        });
    }

    public static function getProductQuantitiesFromCart($cart)
    {
        return $cart->map(function ($cart) {
            return $cart->quantity;
        });
    }

    public static function getProductPricesFromCart($product)
    {
        return $product->map(function ($product) {
            return $product->price;
        });
    }

    public static function getProductSumPricesFromCart($product)
    {
        return $product->map(function ($product) {
            return $product->price;
        });

    }
}
