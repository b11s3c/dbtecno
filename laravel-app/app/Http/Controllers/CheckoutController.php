<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $cartItems = CartItem::query()
            ->where('customer_id', Auth::id())
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(fn (CartItem $item): float => $item->line_total);
        $shippingFee = $subtotal > 2500 ? 0 : 99.90;
        $grandTotal = max($subtotal + $shippingFee, 0);

        return view('products.checkout', compact('cartItems', 'subtotal', 'shippingFee', 'grandTotal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'address' => ['required', 'string', 'min:10', 'max:500'],
            'payment_method' => ['required', 'in:credit_card,bank_transfer,cash_on_delivery'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $customerId = Auth::id();
        $cartItems = CartItem::query()->where('customer_id', $customerId)->with('product')->get();

        abort_if($cartItems->isEmpty(), 422, 'Sipariş oluşturmak için sepetinizde ürün olmalı.');

        $subtotal = $cartItems->sum(fn (CartItem $item): float => $item->line_total);
        $shippingFee = $subtotal > 2500 ? 0 : 99.90;
        $grandTotal = max($subtotal + $shippingFee, 0);

        DB::transaction(function () use ($payload, $customerId, $cartItems, $subtotal, $shippingFee, $grandTotal): void {
            $order = Order::query()->create([
                'customer_id' => $customerId,
                'order_number' => 'DBT-' . now()->format('YmdHis') . '-' . random_int(100, 999),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'discount_total' => 0,
                'grand_total' => $grandTotal,
                'address' => $payload['address'],
                'payment_method' => $payload['payment_method'],
                'notes' => $payload['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                if (! $item->product || $item->product->stock < $item->quantity) {
                    abort(422, 'Stok güncellendi. Lütfen sepetinizi kontrol edin.');
                }

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->brand . ' ' . $item->product->model,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'line_total' => $item->line_total,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::query()->where('customer_id', $customerId)->delete();
        });

        return redirect()->route('home')->with('status', 'Siparişiniz başarıyla oluşturuldu.');
    }
}
