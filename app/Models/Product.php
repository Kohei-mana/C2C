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


    public function selections() {
        return $this->hasMany('App\Models\Selection');
    }

    public static function createProduct(array $data): Product
    {
        return self::create([
            'name' => $data['product_name'],
            'image' => $data['filename'],
            'category_id' => $data['category_id'],
            'user_id'  => Auth::id(),
            'price' => $data['price'],
            'inventory' => $data['inventory'],
            'product_description' => $data['description'],
            'listing_status' => '0'
        ]);
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
}
