<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService)
    {
    }

    public function index(): View
    {
        $cartItems = $this->cartService->userItems((int) Auth::id());
        $totals = $this->cartService->totals($cartItems);

        return view('products.cart', [
            'cartItems' => $cartItems,
            'subtotal' => $totals['subtotal'],
            'shippingFee' => $totals['shipping_fee'],
            'grandTotal' => $totals['grand_total'],
        ]);
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        $this->cartService->addOrUpdate((int) Auth::id(), (int) $payload['product_id'], (int) $payload['quantity']);

        return back()->with('status', 'Ürün sepete eklendi.');
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);

        $this->cartService->addOrUpdate((int) Auth::id(), (int) $cartItem->product_id, (int) $request->validated('quantity'));

        return back()->with('status', 'Sepet güncellendi.');
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);

        $cartItem->delete();

        return back()->with('status', 'Ürün sepetten kaldırıldı.');
    }
}
