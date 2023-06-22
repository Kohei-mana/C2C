<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
