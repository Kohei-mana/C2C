<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

// use app/Models/Category.php;

class ShowProducts extends Controller
{
    //
    public function show(Request $request): View
    {
        $products = Product::getShowProducts();
        $categories = Category::getCategories();

        $searchWord = $request->searchWord;
        $categoryId = $request->categoryId;

        return View('welcome', compact('products', 'categories', 'searchWord', 'categoryId'));
    }

    public function showDetail($id): View
    {

        $product = Product::getselectedProduct($id);
        
        //もしログイン状態なら
        $login = Auth::check();

        //TODO[いいねしているかどうかをbooleanに直す]
        if($login){
            $favorite = Favorite::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
        } else {
            $favorite = null;
        }
        
        return View('product-detail', compact('product', 'favorite'));
    }

    public function search(Request $request): View
    {

        $searchWord = $request->searchWord;
        $categoryId = $request->categoryId;

        $categories = Category::getCategories();
        
        $searchQueryBuilder = Product::getProductsJoinedWithCategory();
        
        if (isset($searchWord)) {
            $searchQueryBuilder->where('products.name', 'like', '%' . $searchWord . '%');
        }

        if (isset($categoryId)) {
            $searchQueryBuilder->where('products.category_id', $categoryId);
        }
        
        $products = $searchQueryBuilder->simplePaginate(8);
        
        return view('welcome', compact('products', 'categories', 'searchWord', 'categoryId'));

    }

}
