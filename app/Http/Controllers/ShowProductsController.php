<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ExhibitController;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Selection;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

// use app/Models/Category.php;

class ShowProductsController extends Controller
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

        $product = Product::getSelectedProduct($id);

        $login = Auth::check();

        if($login){
            $productInACart = Selection::select('*')->where('product_id', $id)->where('user_id', auth()->user()->id)->first();
            $quantity = $productInACart ? $productInACart->quantity : 0;
        } else {
            $quantity = 0;
        }

        //TODO[いいねしているかどうかをbooleanに直す]
        if ($login) {
            $favorite = Favorite::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
        } else {
            $favorite = null;
        }

        return View('product-detail', compact('product', 'favorite', 'quantity'));
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
