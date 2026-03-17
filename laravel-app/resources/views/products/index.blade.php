@extends('layouts.app')

@section('content')
    <h1>Ürünler</h1>

    <div class="grid">
        @forelse($products as $product)
            <article class="card">
                <h3>{{ $product->brand }} {{ $product->model }}</h3>
                <p>Kategori: {{ $product->category }}</p>
                <p>Fiyat: {{ number_format($product->price, 2, ',', '.') }} ₺</p>
                <a href="{{ route('products.show', $product) }}">Detay</a>
            </article>
        @empty
            <p>Ürün bulunamadı.</p>
        @endforelse
    </div>

    <div style="margin-top: 16px;">
        {{ $products->links() }}
    </div>
@endsection
