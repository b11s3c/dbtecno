<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->where('customer_id', Auth::id())
            ->with('items')
            ->latest('id')
            ->get();

        return view('products.orders', compact('orders'));
    }
}
