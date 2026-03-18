@extends('layouts.app')

@section('content')
    <h1>Ödeme</h1>
    <div class="grid" style="grid-template-columns:2fr 1fr;align-items:start;">
        <form method="POST" action="{{ route('checkout.store') }}" class="card">
            @csrf
            <label>Teslimat Adresi</label>
            <textarea name="address" rows="4" required>{{ old('address') }}</textarea>

            <label style="display:block;margin-top:10px;">Ödeme Yöntemi</label>
            <select name="payment_method" required>
                <option value="credit_card">Kredi Kartı</option>
                <option value="bank_transfer">Havale/EFT</option>
                <option value="cash_on_delivery">Kapıda Ödeme</option>
            </select>

            <label style="display:block;margin-top:10px;">Sipariş Notu</label>
            <textarea name="notes" rows="3">{{ old('notes') }}</textarea>

            <button class="btn" type="submit" style="margin-top:12px;">Siparişi Tamamla</button>
        </form>

        <aside class="card">
            <h3>Sipariş Özeti</h3>
            @foreach($cartItems as $item)
                <p class="muted">{{ $item->product->brand }} {{ $item->product->model }} × {{ $item->quantity }}</p>
            @endforeach
            <p>Ara Toplam: <strong>{{ number_format($subtotal, 2, ',', '.') }} ₺</strong></p>
            <p>Kargo: <strong>{{ number_format($shippingFee, 2, ',', '.') }} ₺</strong></p>
            <hr>
            <p>Genel Toplam: <strong>{{ number_format($grandTotal, 2, ',', '.') }} ₺</strong></p>
        </aside>
    </div>
@endsection
