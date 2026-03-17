<?php

namespace App\Http\Controllers;

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
