@extends('layouts.app')

@section('content')
    <h1>Sepetim</h1>
    <div class="grid" style="grid-template-columns:2fr 1fr;align-items:start;">
        <section>
            @forelse($cartItems as $item)
                <article class="card">
                    <div class="row" style="justify-content:space-between;">
                        <strong>{{ $item->product->brand }} {{ $item->product->model }}</strong>
                        <span>{{ number_format($item->line_total, 2, ',', '.') }} ₺</span>
                    </div>
                    <p class="muted">Birim: {{ number_format($item->unit_price, 2, ',', '.') }} ₺</p>
                    <div class="row">
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="row">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" min="1" max="99" value="{{ $item->quantity }}" style="width:90px;">
                            <button class="btn btn-outline" type="submit">Güncelle</button>
                        </form>
                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">Sil</button>
                        </form>
                    </div>
                </article>
            @empty
                <p>Sepetiniz boş.</p>
            @endforelse
        </section>

        <aside class="card">
            <h3>Sipariş Özeti</h3>
            <p>Ara Toplam: <strong>{{ number_format($subtotal, 2, ',', '.') }} ₺</strong></p>
            <p>Kargo: <strong>{{ number_format($shippingFee, 2, ',', '.') }} ₺</strong></p>
            <hr>
            <p>Genel Toplam: <strong>{{ number_format($grandTotal, 2, ',', '.') }} ₺</strong></p>
            <a href="{{ route('checkout.index') }}" class="btn" style="display:inline-block;">Ödemeye Geç</a>
        </aside>
    </div>
@endsection
