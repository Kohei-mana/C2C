<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'postal_code', 'address', 'created_at', 'updated_at'];

    protected $casts = [
        'email_verification_at' => 'datetime'
    ];


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function selections() {
        return $this->hasMany('App\Models\Selection');
    }
}
