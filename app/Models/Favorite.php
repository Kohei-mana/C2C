<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsTo('App\Models\User');
    }
 
    public function products() {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getFavorite(Product $product) {
        $user_id=Auth::user()->id;
        return self::where('product_id', $product->id)->where('user_id', $user_id)->first();
    }

    public static function getFavoriteProducts() {
        $user_id=Auth::user()->id;
        return self::
        join('products', 'favorites.product_id', '=', 'products.id')
        ->where('favorites.user_id', $user_id)
        ->get();
    }
}
