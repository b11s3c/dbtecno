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
    }
}
