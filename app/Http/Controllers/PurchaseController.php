<?php

namespace App\Http\Controllers;

use App\Models\Completion;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showHistory()
    {
        $completions = Completion::whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->with(['order', 'product'])
            ->get();

        return view('purchase_history', compact('completions'));
    }
}
