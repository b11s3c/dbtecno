@extends('layouts.app')

@section('content')
    <h1>Ürün Kataloğu</h1>
    <p class="muted">Filtreleme, sıralama, kampanya fiyatı ve stok takibi ile modern ürün keşfi.</p>

    <form method="GET" action="{{ route('products.search') }}" class="card" style="margin: 14px 0;">
        <div class="form-grid">
            <input type="text" name="q" placeholder="Marka, model veya kod" value="{{ request('q') }}">
            <select name="category">
                <option value="">Tüm kategoriler</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <input type="number" min="0" step="0.01" name="min_price" placeholder="Min ₺" value="{{ request('min_price') }}">
            <input type="number" min="0" step="0.01" name="max_price" placeholder="Max ₺" value="{{ request('max_price') }}">
            <button class="btn" type="submit">Ara</button>
        </div>
        <div class="row" style="margin-top:10px;">
            <span class="muted">Sırala:</span>
            <label><input type="radio" name="sort" value="newest" @checked(request('sort', 'newest') === 'newest')> En yeni</label>
            <label><input type="radio" name="sort" value="price_asc" @checked(request('sort') === 'price_asc')> Fiyat ↑</label>
            <label><input type="radio" name="sort" value="price_desc" @checked(request('sort') === 'price_desc')> Fiyat ↓</label>
            <label><input type="radio" name="sort" value="popular" @checked(request('sort') === 'popular')> Popüler</label>
        </div>
    </form>

    <div class="grid">
        @forelse($products as $product)
            <article class="card">
                <div class="row" style="justify-content:space-between;">
                    <h3 style="margin:0;">{{ $product->brand }} {{ $product->model }}</h3>
                    @if($product->stock > 0)<span class="badge">Stokta</span>@endif
                </div>
                <p class="muted">{{ $product->category }} · Kod: {{ $product->code }}</p>
                <p>{{ $product->short_description }}</p>
                <div class="row" style="justify-content:space-between;">
                    <div>
                        @if($product->discount_price)
                            <small class="muted"><s>{{ number_format($product->price, 2, ',', '.') }} ₺</s></small><br>
                        @endif
                        <strong>{{ number_format($product->current_price, 2, ',', '.') }} ₺</strong>
                    </div>
                    <a class="btn btn-outline" href="{{ route('products.show', $product) }}">Detay</a>
                </div>
            </article>
        @empty
            <p>Aramanıza uygun ürün bulunamadı.</p>
        @endforelse
    </div>

    <div style="margin-top: 16px;">{{ $products->links() }}</div>
@endsection
