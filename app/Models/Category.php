<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function getLists()
    {
        return self::orderBy('id', 'asc')->pluck('category_name', 'id')->prepend('選択', '');
    }

    public static function getCategories()
    {
        return self::
        select('id', 'category_name')
        ->get();
    }

    public static function getCategoryName($category_id)
    {
        return self::find($category_id)->category_name;
    }
}
