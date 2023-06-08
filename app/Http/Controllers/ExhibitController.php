<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ExhibitController extends Controller
{
    public function create(): View
    {
        return view('exhibit');
    }

    public function exhibitPage()
    {
        $categories = Category::all();
        return view("exhibit", ["categories" => $categories]);
    }

    public function confirmExhibitPage(Request $request): View
    {
        $session = $request->session()->all();

        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'category_id' => ['required', 'integer',],
            'price' => ['required', 'integer', 'min:300', 'max:9999999'],
            'inventory' => ['required', 'integer', 'min:1'],
            'description' => ['string', 'nullable', 'max:1000'],
            'image' => ['file'],
        ]);

        $name = $request->name;
        $category_id = $request->category_id;
        $price = $request->price;
        $inventory = $request->inventory;
        $description = $request->description;
        $image = $request->image;

        $data = compact('name', 'category_id', 'price', 'inventory', 'description', 'image');
        session($data);

        return view('confirm-exhibit', $data);
    }
}
