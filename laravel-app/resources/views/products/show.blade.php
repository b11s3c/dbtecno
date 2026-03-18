@extends('layouts.app')

@section('content')
    <article class="card">
        <div class="row-between" style="margin-bottom:16px;">
            <div>
                <span class="badge badge-soft">{{ $product->category }}</span>
                <h1 style="margin:12px 0 6px;">{{ $product->brand }} {{ $product->model }}</h1>
                <p class="muted">Kod: {{ $product->code }} · Seri: {{ $product->series ?: 'Standart' }} · Renk: {{ $product->color ?: 'Belirtilmedi' }}</p>
            </div>
            <div style="text-align:right; min-width:220px;">
                @if($product->discount_price)
                    <div class="price-old">{{ number_format($product->price, 2, ',', '.') }} ₺</div>
                @endif
                <strong style="font-size:30px;">{{ number_format($product->current_price, 2, ',', '.') }} ₺</strong>
                <div style="margin-top:8px;">
                    @if($product->stock > 0)
                        <span class="badge">Hemen teslim · {{ $product->stock }} stok</span>
                    @else
                        <span class="badge badge-warn">Geçici olarak tükendi</span>
                    @endif
                </div>
            </div>
        </div>

        <p style="font-size:16px; line-height:1.7;">{{ $product->short_description }}</p>

        <div class="spec-list" style="margin:18px 0;">
            <div class="spec-item"><strong>Marka</strong><br>{{ $product->brand }}</div>
            <div class="spec-item"><strong>Model</strong><br>{{ $product->model }}</div>
            <div class="spec-item"><strong>Tip</strong><br>{{ $product->type ?: 'Belirtilmedi' }}</div>
            <div class="spec-item"><strong>Renk</strong><br>{{ $product->color ?: 'Belirtilmedi' }}</div>
        </div>

        <div class="row" style="margin-top:18px;">
            <form action="{{ route('cart.store') }}" method="POST" class="row">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" min="1" max="99" name="quantity" value="1" style="width:96px;">
                <button class="btn" type="submit" @disabled($product->stock < 1)>Sepete Ekle</button>
            </form>
            <form action="{{ route('favorites.store', $product) }}" method="POST">
                @csrf
                <button class="btn btn-outline" type="submit">Favorilere Kaydet</button>
            </form>
            <a href="{{ route('checkout.index') }}" class="btn btn-outline">Hızlı Ödeme</a>
        </div>
    </article>

    <h2 class="section-title">Müşteri değerlendirmeleri</h2>
    <div class="list">
        @forelse($product->evaluations as $evaluation)
            <article class="card">
                <div class="row-between">
                    <strong>{{ $evaluation->user->name ?? 'Müşteri' }}</strong>
                    <span class="badge badge-soft">{{ $evaluation->score }}/5</span>
                </div>
                <p style="margin:10px 0 0;">{{ $evaluation->comment }}</p>
            </article>
        @empty
            <article class="card">
                <p class="muted">Henüz değerlendirme yok. İlk sipariş verenlerden biri siz olun.</p>
            </article>
        @endforelse
    </div>

    @if($relatedProducts->isNotEmpty())
        <h2 class="section-title">Benzer ürünler</h2>
        <div class="grid">
            @foreach($relatedProducts as $related)
                <article class="card product-card">
                    <span class="badge badge-soft">{{ $related->category }}</span>
                    <h3>{{ $related->brand }} {{ $related->model }}</h3>
                    <p class="muted">Puan: {{ number_format($related->evaluations_avg_score ?? 0, 1) }}/5</p>
                    <div class="row-between" style="margin-top:12px;">
                        <strong>{{ number_format($related->current_price, 2, ',', '.') }} ₺</strong>
                        <a href="{{ route('products.show', $related) }}">İncele</a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
