<?php

namespace App\Http\Controllers;




use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
// use app/Models/Category.php;

class ShowProducts extends Controller
{
    //
    public function show(): View
    {

        $products = DB::table('products')
            ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'categories.category_name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->simplePaginate(2);

        // $products = array_reverse(DB::select('select * from products'));


        return view('welcome', compact('products'));
    }

    public function showDetail(): View
    {
        $products = DB::table('products')
        ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'products.product_description', 'categories.category_name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->get();

        foreach($products as $product){
        }

        return View('product-detail', compact('product'));
    }
}
