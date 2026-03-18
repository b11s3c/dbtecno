<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly CheckoutService $checkoutService,
    ) {
    }

    public function index(): View
    {
        $cartItems = $this->cartService->userItems((int) Auth::id());
        $totals = $this->cartService->totals($cartItems);

        return view('products.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $totals['subtotal'],
            'shippingFee' => $totals['shipping_fee'],
            'grandTotal' => $totals['grand_total'],
        ]);
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        $this->checkoutService->placeOrder((int) Auth::id(), $request->validated());

        return redirect()->route('home')->with('status', 'Siparişiniz başarıyla oluşturuldu.');
    }
}
