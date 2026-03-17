<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = CartItem::query()
            ->where('customer_id', Auth::id())
            ->with('product')
            ->latest('id')
            ->get();

        return view('products.cart', compact('cartItems'));
    }

    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        CartItem::query()->updateOrCreate(
            [
                'customer_id' => Auth::id(),
                'product_id' => $payload['product_id'],
            ],
            [
                'quantity' => $payload['quantity'],
            ]
        );

        return back()->with('status', 'Ürün sepete eklendi.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);

        $cartItem->update($request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]));

        return back()->with('status', 'Sepet güncellendi.');
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);
        $cartItem->delete();

        return back()->with('status', 'Ürün sepetten kaldırıldı.');
    }
}
