<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $favorites = Favorite::query()
            ->where('customer_id', Auth::id())
            ->with('product')
            ->latest('id')
            ->get();

        return view('products.favorites', compact('favorites'));
    }

    public function store(Product $product): RedirectResponse
    {
        Favorite::query()->firstOrCreate([
            'customer_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return back()->with('status', 'Favorilere eklendi.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Favorite::query()
            ->where('customer_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('status', 'Favorilerden kaldırıldı.');
    }
}
