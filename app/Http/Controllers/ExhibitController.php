<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExhibitRequest;
use App\Models\Product;
use App\Models\Category;
use App\Events\Exhibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ExhibitController extends Controller
{
    public function create()
    {
        $categories = Category::getLists();
        return view("exhibit", ["categories" => $categories]);
    }

    public function confirm(ExhibitRequest $request): View
    {
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'category_name' => Category::getCategoryName($request->category_id),
            'price' => $request->price,
            'inventory' => $request->inventory,
            'description' => $request->description,
            'filename' => $request->file('image')->getClientOriginalName()
        ];

        $request->file('image')->move('./upload/', $data['filename']);

        session($data);

        return view('confirm-exhibit', $data);
    }

    public function store(Request $request)
    {
        $data2 = new ExhibitRequest();
        $data = $request->session()->all();
        $validator = Validator::make($data, $data2->rules());

        if ($validator->fails()) {
            return redirect()->route('exhibit')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::createProduct($data);

        $request->session()->forget($data2->attributes());

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

    public function updateListing($id)
    {
        $exhibit_product = Product::getProduct($id);
        Product::updateListingStatus($exhibit_product);

        return view('exhibition-product', compact('exhibit_product'));
    }
}
