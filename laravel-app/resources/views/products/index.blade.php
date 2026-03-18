@extends('layouts.app')

@section('content')
    <section class="hero-panel">
        <article class="card panel-dark">
            <span class="badge badge-soft">Hazır Laravel vitrini</span>
            <h1 style="font-size:34px; margin:16px 0 10px;">Daha güçlü katalog, sepet ve sipariş akışı.</h1>
            <p style="color:#cbd5e1; max-width:640px; line-height:1.6;">
                Bu sürüm; filtreleme, fiyat sıralama, favoriler, stok kontrollü sepet, checkout ve sipariş geçmişi ile
                acemi projeyi daha sağlam bir e-ticaret kurgusuna dönüştürür.
            </p>
            <div class="row" style="margin-top:16px;">
                <a class="btn" href="#catalog">Kataloğa Git</a>
                <a class="btn btn-outline" href="{{ route('orders.index') }}">Siparişleri Gör</a>
            </div>
        </article>
        <aside class="stats">
            <div class="stat">
                <div class="muted">Aktif ürün</div>
                <strong style="font-size:28px;">{{ $stats['product_count'] }}</strong>
            </div>
            <div class="stat">
                <div class="muted">Kategori</div>
                <strong style="font-size:28px;">{{ $stats['category_count'] }}</strong>
            </div>
            <div class="stat">
                <div class="muted">İndirimli ürün</div>
                <strong style="font-size:28px;">{{ $stats['discounted_count'] }}</strong>
            </div>
            <div class="stat">
                <div class="muted">Stokta hazır</div>
                <strong style="font-size:28px;">{{ $stats['in_stock_count'] }}</strong>
            </div>
        </aside>
    </section>

    <section id="catalog">
        <div class="page-head">
            <div>
                <h2 style="margin:0;">Ürün kataloğu</h2>
                <p class="muted" style="margin:6px 0 0;">Marka, kategori ve fiyat filtreleriyle ürünleri hızlıca bulun.</p>
            </div>
            <span class="badge badge-soft">{{ $products->total() }} sonuç</span>
        </div>

        <form method="GET" action="{{ route('products.search') }}" class="card" style="margin-bottom:16px;">
            <div class="form-grid">
                <input type="text" name="q" placeholder="Marka, model veya ürün kodu" value="{{ request('q') }}">
                <select name="category">
                    <option value="">Tüm kategoriler</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
                <input type="number" min="0" step="0.01" name="min_price" placeholder="Min ₺" value="{{ request('min_price') }}">
                <input type="number" min="0" step="0.01" name="max_price" placeholder="Max ₺" value="{{ request('max_price') }}">
                <button class="btn" type="submit">Filtrele</button>
            </div>
            <div class="row" style="margin-top:12px;">
                <span class="muted">Sırala:</span>
                <label><input type="radio" name="sort" value="newest" @checked(request('sort', 'newest') === 'newest')> En yeni</label>
                <label><input type="radio" name="sort" value="price_asc" @checked(request('sort') === 'price_asc')> Fiyat artan</label>
                <label><input type="radio" name="sort" value="price_desc" @checked(request('sort') === 'price_desc')> Fiyat azalan</label>
                <label><input type="radio" name="sort" value="popular" @checked(request('sort') === 'popular')> Popüler</label>
                <a href="{{ route('home') }}" class="muted">Temizle</a>
            </div>
        </form>

        <div class="grid">
            @forelse($products as $product)
                <article class="card product-card">
                    <div class="row-between">
                        <span class="badge badge-soft">{{ $product->category }}</span>
                        @if($product->stock > 0)
                            <span class="badge">Stokta {{ $product->stock }}</span>
                        @else
                            <span class="badge badge-warn">Tükendi</span>
                        @endif
                    </div>
                    <h3>{{ $product->brand }} {{ $product->model }}</h3>
                    <p class="muted">Kod: {{ $product->code }} · Seri: {{ $product->series ?: 'Standart' }}</p>
                    <p style="margin-top:10px; min-height:48px;">{{ $product->short_description }}</p>
                    <div class="row-between" style="margin-top:14px;">
                        <div class="price-stack">
                            @if($product->discount_price)
                                <span class="price-old">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                            @endif
                            <strong style="font-size:24px;">{{ number_format($product->current_price, 2, ',', '.') }} ₺</strong>
                            <span class="muted">Favori: {{ $product->favorites_count }} · Puan: {{ number_format($product->evaluations_avg_score ?? 0, 1) }}/5</span>
                        </div>
                        <a class="btn btn-outline" href="{{ route('products.show', $product) }}">Detay</a>
                    </div>
                </article>
            @empty
                <article class="card">
                    <h3>Ürün bulunamadı</h3>
                    <p class="muted">Arama kriterlerini sadeleştirerek tekrar deneyin.</p>
                </article>
            @endforelse
        </div>

        <div style="margin-top:18px;">{{ $products->links() }}</div>
    </section>
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
