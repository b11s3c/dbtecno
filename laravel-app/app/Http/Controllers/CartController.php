<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function update(UpdateCartItemRequest $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->customer_id === Auth::id(), 403);

        $this->cartService->addOrUpdate((int) Auth::id(), (int) $cartItem->product_id, (int) $request->validated('quantity'));
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
