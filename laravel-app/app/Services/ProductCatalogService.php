<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductCatalogService
{
    public function list(array $filters): LengthAwarePaginator
    {
        return Product::query()
            ->where('is_active', true)
            ->when(isset($filters['category']), fn ($q) => $q->where('category', $filters['category']))
            ->when(isset($filters['q']), function ($q) use ($filters) {
                $term = $filters['q'];
                $q->where(function ($sub) use ($term): void {
                    $sub->where('brand', 'like', "%{$term}%")
                        ->orWhere('model', 'like', "%{$term}%")
                        ->orWhere('code', 'like', "%{$term}%")
                        ->orWhere('short_description', 'like', "%{$term}%");
                });
            })
            ->when(isset($filters['min_price']), fn ($q) => $q->whereRaw('COALESCE(discount_price, price) >= ?', [$filters['min_price']]))
            ->when(isset($filters['max_price']), fn ($q) => $q->whereRaw('COALESCE(discount_price, price) <= ?', [$filters['max_price']]))
            ->withCount('favorites')
            ->withAvg('evaluations', 'score')
            ->when(($filters['sort'] ?? 'newest') === 'price_asc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) asc'))
            ->when(($filters['sort'] ?? 'newest') === 'price_desc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) desc'))
            ->when(($filters['sort'] ?? 'newest') === 'popular', fn ($q) => $q->orderByDesc('favorites_count')->orderByDesc('evaluations_avg_score'))
            ->when(($filters['sort'] ?? 'newest') === 'newest', fn ($q) => $q->latest('id'))
            ->paginate(12)
            ->withQueryString();
    }

    public function categories(): Collection
    {
        return Product::query()
            ->where('is_active', true)
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    }

    public function related(Product $product): Collection
    {
        return Product::query()
            ->where('is_active', true)
            ->where('category', $product->category)
            ->whereKeyNot($product->id)
            ->withAvg('evaluations', 'score')
            ->latest('id')
            ->limit(4)
            ->get();
    }

    public function stats(): array
    {
        $activeProducts = Product::query()->where('is_active', true);

        return [
            'product_count' => (clone $activeProducts)->count(),
            'category_count' => (clone $activeProducts)->distinct('category')->count('category'),
            'discounted_count' => (clone $activeProducts)->whereNotNull('discount_price')->count(),
            'in_stock_count' => (clone $activeProducts)->where('stock', '>', 0)->count(),
        ];
    }
}
