<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    public function userItems(int $userId): Collection
    {
        return CartItem::query()
            ->where('customer_id', $userId)
            ->with('product')
            ->latest('id')
            ->get();
    }

    public function addOrUpdate(int $userId, int $productId, int $quantity): void
    {
        $product = Product::query()->findOrFail($productId);

        if ($product->stock < $quantity) {
            abort(422, 'Yetersiz stok.');
        }

        CartItem::query()->updateOrCreate(
            [
                'customer_id' => $userId,
                'product_id' => $productId,
            ],
            [
                'quantity' => $quantity,
                'unit_price' => $product->current_price,
            ]
        );
    }

    public function totals(Collection $cartItems): array
    {
        $subtotal = $cartItems->sum(fn (CartItem $item): float => $item->line_total);
        $shippingFee = $subtotal > 2500 ? 0.0 : 99.90;

        return [
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'grand_total' => max($subtotal + $shippingFee, 0),
        ];
    }
}
