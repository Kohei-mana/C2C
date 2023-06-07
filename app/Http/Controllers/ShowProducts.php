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

        $products = array_reverse(DB::select('select * from products'));


        return view('welcome', compact('products'));
    }
}
