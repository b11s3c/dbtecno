<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:40'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'sort' => ['nullable', 'in:newest,price_asc,price_desc,popular'],
        ]);

        $products = Product::query()
            ->where('is_active', true)
            ->when(isset($validated['category']), fn ($q) => $q->where('category', $validated['category']))
            ->when(isset($validated['q']), function ($q) use ($validated) {
                $term = $validated['q'];
                $q->where(function ($subQ) use ($term): void {
                    $subQ->where('brand', 'like', "%{$term}%")
                        ->orWhere('model', 'like', "%{$term}%")
                        ->orWhere('code', 'like', "%{$term}%")
                        ->orWhere('short_description', 'like', "%{$term}%");
                });
            })
            ->when(isset($validated['min_price']), fn ($q) => $q->whereRaw('COALESCE(discount_price, price) >= ?', [$validated['min_price']]))
            ->when(isset($validated['max_price']), fn ($q) => $q->whereRaw('COALESCE(discount_price, price) <= ?', [$validated['max_price']]))
            ->withCount('favorites')
            ->when(($validated['sort'] ?? 'newest') === 'price_asc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) asc'))
            ->when(($validated['sort'] ?? 'newest') === 'price_desc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) desc'))
            ->when(($validated['sort'] ?? 'newest') === 'popular', fn ($q) => $q->orderByDesc('favorites_count'))
            ->when(($validated['sort'] ?? 'newest') === 'newest', fn ($q) => $q->latest('id'))
            ->paginate(12)
            ->withQueryString();

        $categories = Product::query()->select('category')->distinct()->orderBy('category')->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        $product->load(['evaluations.user']);

        $relatedProducts = Product::query()
            ->where('is_active', true)
            ->where('category', $product->category)
            ->whereKeyNot($product->id)
            ->latest('id')
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request): View
    {
        return $this->index($request);
    }
}
