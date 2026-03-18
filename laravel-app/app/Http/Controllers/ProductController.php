<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Product;
use App\Services\ProductCatalogService;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __construct(private readonly ProductCatalogService $catalog)
    {
    }

    public function index(ProductFilterRequest $request): View
    {
        $filters = array_filter($request->validated(), fn ($value) => $value !== null && $value !== '');

        return view('products.index', [
            'products' => $this->catalog->list($filters),
            'categories' => $this->catalog->categories(),
            'stats' => $this->catalog->stats(),
        ]);
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->string('category')->isNotEmpty(), function ($query) use ($request) {
                $query->where('category', $request->string('category'));
            })
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $product->load(['evaluations.user']);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $this->catalog->related($product),
        ]);
    }

    public function search(ProductFilterRequest $request): View
    {
        return $this->index($request);
        return view('products.show', compact('product'));
    }

    public function search(Request $request): View
    {
        $q = $request->string('q');

        $products = Product::query()
            ->when($q->isNotEmpty(), function ($query) use ($q) {
                $query->where(function ($subQuery) use ($q): void {
                    $subQuery
                        ->where('brand', 'like', "%{$q}%")
                        ->orWhere('model', 'like', "%{$q}%")
                        ->orWhere('code', 'like', "%{$q}%");
                });
            })
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products'));
    }
}
