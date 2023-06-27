<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Completion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['product_id', 'order_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getPurchaseProducts()
    {
        $result = self::whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->with(['order', 'product'])

            ->get()
            ->sort(function ($first, $second) {
                return $first->order->created_at < $second->order->created_at ? 1 : -1;
            });
        return $result;
    }
}
