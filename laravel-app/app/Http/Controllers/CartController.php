<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
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

        $subtotal = $cartItems->sum(fn (CartItem $item): float => $item->line_total);
        $shippingFee = $subtotal > 2500 ? 0 : 99.90;
        $grandTotal = max($subtotal + $shippingFee, 0);

        return view('products.cart', compact('cartItems', 'subtotal', 'shippingFee', 'grandTotal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::query()->findOrFail($payload['product_id']);
        abort_if($product->stock < $payload['quantity'], 422, 'Yetersiz stok.');

        CartItem::query()->updateOrCreate(
            [
                'customer_id' => Auth::id(),
                'product_id' => $payload['product_id'],
            ],
            [
                'quantity' => $payload['quantity'],
                'unit_price' => $product->current_price,
            ]
        );

        return back()->with('status', 'Ürün sepete eklendi.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);

        $payload = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        abort_if($cartItem->product && $cartItem->product->stock < $payload['quantity'], 422, 'Yetersiz stok.');

        $cartItem->update($payload);

        return back()->with('status', 'Sepet güncellendi.');
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);
        $cartItem->delete();

        return back()->with('status', 'Ürün sepetten kaldırıldı.');
    }
}
