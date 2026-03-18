@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1 style="margin:0;">Siparişlerim</h1>
            <p class="muted" style="margin:6px 0 0;">Checkout sonrası oluşan siparişleri ve kalemlerini buradan takip edin.</p>
        </div>
        <span class="badge badge-soft">{{ $orders->count() }} sipariş</span>
    </div>

    <div class="list">
        @forelse($orders as $order)
            <article class="card">
                <div class="row-between">
                    <div>
                        <strong>{{ $order->order_number }}</strong>
                        <div class="muted">{{ $order->created_at?->format('d.m.Y H:i') }} · {{ $order->payment_method }}</div>
                    </div>
                    <div style="text-align:right;">
                        <span class="badge badge-soft">{{ strtoupper($order->status) }}</span>
                        <div style="margin-top:8px;"><strong>{{ number_format($order->grand_total, 2, ',', '.') }} ₺</strong></div>
                    </div>
                </div>
                <div class="list" style="margin-top:14px;">
                    @foreach($order->items as $item)
                        <div class="row-between" style="padding:10px 0; border-top:1px solid var(--line);">
                            <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                            <strong>{{ number_format($item->line_total, 2, ',', '.') }} ₺</strong>
                        </div>
                    @endforeach
                </div>
                <div class="muted" style="margin-top:12px;">Adres: {{ $order->address }}</div>
            </article>
        @empty
            <article class="card">
                <h3>Henüz sipariş oluşturulmadı</h3>
                <p class="muted">Katalogdan ürün ekleyip ödeme adımını tamamladığınızda siparişler burada listelenir.</p>
            </article>
        @endforelse
    </div>
@endsection
