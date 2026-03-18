@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1 style="margin:0;">Sepetim</h1>
            <p class="muted" style="margin:6px 0 0;">Birim fiyat snapshot mantığı ile sipariş öncesi net tutarları gör.</p>
        </div>
        <span class="badge badge-soft">{{ $cartItems->count() }} ürün</span>
    </div>

    <div class="grid-2 checkout-grid" style="display:grid; grid-template-columns:2fr 1fr; gap:16px; align-items:start;">
        <section class="list">
            @forelse($cartItems as $item)
                <article class="card">
                    <div class="row-between">
                        <div>
                            <strong>{{ $item->product->brand }} {{ $item->product->model }}</strong>
                            <div class="muted">Birim fiyat: {{ number_format($item->unit_price, 2, ',', '.') }} ₺ · Kalan stok: {{ $item->product->stock }}</div>
                        </div>
                        <strong>{{ number_format($item->line_total, 2, ',', '.') }} ₺</strong>
                    </div>
                    <div class="row" style="margin-top:12px;">
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="row">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" min="1" max="99" value="{{ $item->quantity }}" style="width:96px;">
                            <button class="btn btn-outline" type="submit">Adedi Güncelle</button>
                        </form>
                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Kaldır</button>
                        </form>
                    </div>
                </article>
            @empty
                <article class="card">
                    <h3>Sepetiniz boş</h3>
                    <p class="muted">Ürün kataloğundan sepetinize ürün ekleyerek sipariş akışını test edin.</p>
                    <a href="{{ route('home') }}" class="btn">Alışverişe Başla</a>
                </article>
            @endforelse
        </section>

        <aside class="card summary">
            <h3 style="margin-top:0;">Sipariş özeti</h3>
            <p>Ara toplam <strong style="float:right;">{{ number_format($subtotal, 2, ',', '.') }} ₺</strong></p>
            <p>Kargo <strong style="float:right;">{{ number_format($shippingFee, 2, ',', '.') }} ₺</strong></p>
            <p class="muted">2.500 ₺ üzeri ücretsiz kargo uygulanır.</p>
            <hr style="border:none; border-top:1px solid var(--line); margin:16px 0;">
            <p>Genel toplam <strong style="float:right; font-size:20px;">{{ number_format($grandTotal, 2, ',', '.') }} ₺</strong></p>
            <a href="{{ route('checkout.index') }}" class="btn" style="width:100%; margin-top:14px;">Ödemeye Geç</a>
        </aside>
    </div>
    <h1>Sepetim</h1>
    @forelse($cartItems as $item)
        <article class="card">
            <strong>{{ $item->product->brand }} {{ $item->product->model }}</strong>
            <p>Adet: {{ $item->quantity }}</p>
        </article>
    @empty
        <p>Sepetiniz boş.</p>
    @endforelse
@endsection
