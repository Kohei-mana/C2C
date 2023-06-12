<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Exhibit;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ExhibitController extends Controller
{
    public function exhibitPage()
    {
        $category = new Category;
        $categories = $category->getLists()->prepend('選択', '');
        return view("exhibit", ["categories" => $categories]);
    }

    public function confirmExhibitPage(Request $request): View
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
        $category_name = DB::table('categories')
            ->where('id', $category_id)
            ->value('category_name');
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

        $product = Product::create([
            'name' => $data['product_name'],
            'image' => $data['filename'],
            'category_id' => $data['category_id'],
            'user_id'  => Auth::id(),
            'price' => $data['price'],
            'inventory' => $data['inventory'],
            'product_description' => $data['description'],
            'listing_status' => '0'
        ]);

        $request->session()->flush();

        event(new Exhibit($product));

        return view('complete-exhibit');
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('exhibition-product', compact('product'));
    }
}
