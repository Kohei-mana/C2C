<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sum_quantity', 'sum_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function completions()
    {
        return $this->hasMany(Completion::class);
    }

    public function getUpdatedAtColumn()
    {
        return null;
    }

    public static function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = new Order([
                'user_id' => Auth::id(),
                'sum_quantity' => $data['sum_quantity'],
                'sum_price' => $data['sum_price'],
            ]);

            $order->save();

            foreach ($data['product_id'] as $key => $productId) {
                $completion = new Completion([
                    'product_id' => $productId,
                    'order_id' => $order->id,
                    'quantity' => $data['quantity'][$key],
                    'price' => $data['price'][$key],
                ]);

                $completion->save();
            }

            return $order;
        });
    }
}
