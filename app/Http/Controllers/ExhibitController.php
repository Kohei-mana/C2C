<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Events\Exhibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExhibitController extends Controller
{
    public function create()
    {
        $categories = Category::getLists()->prepend('選択', '');
        return view("exhibit", ["categories" => $categories]);
    }

    public function confirm(Request $request): View
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:40'],
            'category_id' => ['required'],
            'price' => ['required', 'integer', 'min:300', 'max:9999999'],
            'inventory' => ['required', 'integer', 'min:1'],
            'description' => ['string', 'nullable', 'max:1000'],
            'image' => ['required']
        ]);

        $product_name = $request->product_name;
        $category_id = $request->category_id;
        $category_name = Category::getCategory_name($category_id);
        $price = $request->price;
        $inventory = $request->inventory;
        $description = $request->description;
        $image = $request->file("image");
        $filename = $image->getClientOriginalName();
        $move = $image->move('./upload/', $filename);

        $data = compact('product_name', 'category_id', 'price', 'inventory', 'description', 'filename', 'category_name');
        session($data);

        return view('confirm-exhibit', $data);
    }

    public function store(Request $request): View
    {
        $data = $request->session()->all();

        $product = Product::createProduct($data);

        $request->session()->flush();

        event(new Exhibit($product));

        Auth::loginUsingId($product->user_id);

        return view('complete-exhibit');
    }

    public function showAll()
    {
        $id = Auth::id();
        $exhibit_products = Product::getExhibitProducts($id);

        return view('listing_history', compact('exhibit_products'));
    }

    public function showSpecific($id)
    {
        $exhibit_product = Product::getProduct($id);
        return view('exhibition-product', compact('exhibit_product'));
    }


    public function stopListing($id)
    {
        $exhibit_product = Product::getProduct($id);
        $exhibit_product->listing_status = 1;
        $exhibit_product->save();

        return view('exhibition-product', compact('exhibit_product'));
    }

    public function resumeListing($id)
    {
        $exhibit_product = Product::getProduct($id);
        $exhibit_product->listing_status = 0;
        $exhibit_product->save();

        return view('exhibition-product', compact('exhibit_product'));
    }
}
