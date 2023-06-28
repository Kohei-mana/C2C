<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id', 'user_id', 'image', 'inventory', 'product_description', 'listing_status', 'created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function selections()
    {

        return $this->hasMany('App\Models\Selection');
    }

    public static function createProduct(array $data): Product
    {
        return self::create([
            'name' => $data['product_name'],
            'image' => $data['image'],
            'category_id' => $data['category_id'],
            'user_id'  => Auth::id(),
            'price' => $data['price'],
            'inventory' => $data['inventory'],
            'product_description' => $data['description'],
            'listing_status' => '0'
        ]);
    }

    public function updateProduct(array $data)
    {

        return self::find($data['product_id'])
            ->update([
                'name' => $data['product_name'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'price' => $data['price'],
                'inventory' => $data['inventory'],
                'product_description' => $data['description'],
            ]);
    }

    public static function getShowProducts()
    {
        //出品中のすべての商品データを取得
        return self::select('products.id', 'user_id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'listing_status', 'categories.category_name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('listing_status', 0)
            ->where('inventory', '>=', 1)
            ->orderBy('id', 'desc')
            ->simplePaginate(20);
    }

    public static function getSelectedProduct($id)
    {
        //クリックした商品のデータを取得
        return self::select('products.id', 'products.user_id', 'products.name', 'products.image', 'products.price', 'products.product_description', 'products.inventory', 'products.listing_status', 'products.category_id', 'categories.category_name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();
    }

    public static function getProductsJoinedWithCategory()
    {
        return self::select('products.id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'category_id', 'categories.category_name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id');
    }

    public static function getProduct($id)
    {
        return self::find($id);
    }

    public static function getExhibitProducts($id)
    {
        return self::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public static function updateListingStatus($exhibit_product)
    {
        if ($exhibit_product->listing_status == 0) {
            $exhibit_product->listing_status = 1;
        } else {
            $exhibit_product->listing_status = 0;
        }

        $exhibit_product->save();
    }

    public static function getCartProduct($product_id)
    {
        return self::find($product_id);
    }
}
