@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1 style="margin:0;">Favorilerim</h1>
            <p class="muted" style="margin:6px 0 0;">Sonra incelemek veya hızlıca sepete atmak için saklanan ürünler.</p>
        </div>
        <span class="badge badge-soft">{{ $favorites->count() }} kayıt</span>
    </div>

    <div class="grid">
        @forelse($favorites as $favorite)
            <article class="card product-card">
                <span class="badge badge-soft">{{ $favorite->product->category }}</span>
                <h3>{{ $favorite->product->brand }} {{ $favorite->product->model }}</h3>
                <p class="muted">{{ $favorite->product->short_description }}</p>
                <div class="row-between" style="margin-top:14px;">
                    <strong>{{ number_format($favorite->product->current_price, 2, ',', '.') }} ₺</strong>
                    <span class="muted">Stok: {{ $favorite->product->stock }}</span>
                </div>
                <div class="row" style="margin-top:14px;">
                    <a class="btn btn-outline" href="{{ route('products.show', $favorite->product) }}">Detay</a>
                    <form method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button class="btn" type="submit">Sepete At</button>
                    </form>
                    <form method="POST" action="{{ route('favorites.destroy', $favorite->product) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Kaldır</button>
                    </form>
                </div>
            </article>
        @empty
            <article class="card">
                <h3>Favori listen boş</h3>
                <p class="muted">Beğendiğin ürünleri favorilere ekleyerek daha sonra hızlıca satın alabilirsin.</p>
            </article>
        @endforelse
    </div>
    <h1>Favorilerim</h1>
    @forelse($favorites as $favorite)
        <article class="card">
            <strong>{{ $favorite->product->brand }} {{ $favorite->product->model }}</strong>
        </article>
    @empty
        <p>Favori ürününüz yok.</p>
    @endforelse
@endsection
