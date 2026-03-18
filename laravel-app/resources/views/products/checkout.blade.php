@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1 style="margin:0;">Ödeme</h1>
            <p class="muted" style="margin:6px 0 0;">Adres, ödeme yöntemi ve sipariş notuyla checkout akışını tamamla.</p>
        </div>
        <span class="badge badge-soft">Toplam {{ number_format($grandTotal, 2, ',', '.') }} ₺</span>
    </div>

    <div class="checkout-grid" style="display:grid; grid-template-columns:2fr 1fr; gap:16px; align-items:start;">
        <form method="POST" action="{{ route('checkout.store') }}" class="card">
            @csrf
            <label for="address"><strong>Teslimat adresi</strong></label>
            <textarea id="address" name="address" rows="5" required>{{ old('address', 'İstanbul / Türkiye\nMahalle, sokak, bina no, daire no') }}</textarea>

            <label for="payment_method" style="display:block; margin-top:14px;"><strong>Ödeme yöntemi</strong></label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card" @selected(old('payment_method') === 'credit_card')>Kredi Kartı</option>
                <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Havale / EFT</option>
                <option value="cash_on_delivery" @selected(old('payment_method') === 'cash_on_delivery')>Kapıda Ödeme</option>
            </select>

            <label for="notes" style="display:block; margin-top:14px;"><strong>Sipariş notu</strong></label>
            <textarea id="notes" name="notes" rows="3" placeholder="Kurye için not bırakabilirsiniz">{{ old('notes') }}</textarea>

            <button class="btn" type="submit" style="margin-top:16px;">Siparişi Tamamla</button>
        </form>

        <aside class="card summary">
            <h3 style="margin-top:0;">Sipariş özeti</h3>
            @forelse($cartItems as $item)
                <div style="padding:10px 0; border-bottom:1px solid var(--line);">
                    <div class="row-between">
                        <strong>{{ $item->product->brand }} {{ $item->product->model }}</strong>
                        <span>{{ $item->quantity }} adet</span>
                    </div>
                    <div class="muted">{{ number_format($item->line_total, 2, ',', '.') }} ₺</div>
                </div>
            @empty
                <p class="muted">Sepetinizde ürün bulunmuyor.</p>
            @endforelse
            <div style="margin-top:14px;">
                <p>Ara toplam <strong style="float:right;">{{ number_format($subtotal, 2, ',', '.') }} ₺</strong></p>
                <p>Kargo <strong style="float:right;">{{ number_format($shippingFee, 2, ',', '.') }} ₺</strong></p>
                <hr style="border:none; border-top:1px solid var(--line); margin:16px 0;">
                <p>Genel toplam <strong style="float:right; font-size:20px;">{{ number_format($grandTotal, 2, ',', '.') }} ₺</strong></p>
            </div>
        </aside>
    </div>
@endsection
