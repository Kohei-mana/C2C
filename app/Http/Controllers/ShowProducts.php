<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ShowProducts extends Controller
{
    //
    public function show(): View
    {

        $products = DB::select('select * from products');

        foreach($products as $product) {

        };

        $name = $product->name;
        $image = $product->image;
        $price = $product->price;


        $data = compact(
            'name', 
            'image',
            'price'
        );
        // $data = ['title' => '商品', 'products' => $products];

        return view('welcome', $data);
    }
}
