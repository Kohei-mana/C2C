<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

// use app/Models/Category.php;

class ShowProducts extends Controller
{
    //
    public function show(Request $request): View
    {
        $products = Product::all();

        $products = DB::table('products')
            ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'categories.category_name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->paginate(6);
        
        $categories = DB::table('categories')
        ->select('id', 'category_name')
        ->get();

        $searchWord = $request->searchWord;
        $categoryId = $request->categoryId;


        return View('welcome', compact('products', 'categories', 'searchWord', 'categoryId'));

    }

    public function showDetail($id): View
    {

        // $product = Product::find($id);
        $product = DB::table('products')
        ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.product_description', 'products.inventory','categories.category_name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id', $id)
        ->first();

        $favorite = Favorite::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();

        return View('product-detail', compact('product', 'favorite'));
    }

    public function search(Request $request): View
    {

        $searchWord = $request->searchWord;
        $categoryId = $request->categoryId;

        $categories = DB::table('categories')
        ->select('id', 'category_name')
        ->get();
        
        $searchQueryBuilder = DB::table('products')
        ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.inventory', 'category_id', 'categories.category_name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id');

        if (isset($searchWord)) {
            $searchQueryBuilder->where('products.name', 'like', '%' . $searchWord . '%');
        }

        if (isset($categoryId)) {
            $searchQueryBuilder->where('products.category_id', $categoryId);
        }
        
        $products = $searchQueryBuilder->simplePaginate(2);
        
        return view('welcome', compact('products', 'categories', 'searchWord', 'categoryId'));

    }

}
