<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class Exhibit
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $product;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }
}
