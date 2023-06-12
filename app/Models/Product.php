<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'price', 'category_id', 'user_id', 'image', 'inventory', 'product_description', 'listing_status', 'created_at', 'updated_at'];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryName()
    {
        $categoryName = $this->category->name;
        return $categoryName;
    }
}
