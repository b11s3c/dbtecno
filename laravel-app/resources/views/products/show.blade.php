@extends('layouts.app')

@section('content')
    <article class="card">
        <div class="row" style="justify-content:space-between;">
            <div>
                <h1 style="margin:0;">{{ $product->brand }} {{ $product->model }}</h1>
                <p class="muted">{{ $product->category }} · {{ $product->series }}</p>
            </div>
            <div>
                <strong>{{ number_format($product->current_price, 2, ',', '.') }} ₺</strong>
                <p class="muted">Stok: {{ $product->stock }}</p>
            </div>
        </div>

        <p>{{ $product->short_description }}</p>

        @auth
            <div class="row">
                <form action="{{ route('cart.store') }}" method="POST" class="row">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" min="1" max="99" name="quantity" value="1" style="width:90px;">
                    <button class="btn" type="submit">Sepete Ekle</button>
                </form>
                <form action="{{ route('favorites.store', $product) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline" type="submit">Favorile</button>
                </form>
            </div>
        @endauth
    </article>

    <h2>Değerlendirmeler</h2>
    @forelse($product->evaluations as $evaluation)
        <article class="card">
            <strong>{{ $evaluation->user->name ?? 'Müşteri' }}</strong>
            <p>Puan: {{ $evaluation->score }}/5</p>
            <p>{{ $evaluation->comment }}</p>
        </article>
    @empty
        <p>Henüz değerlendirme yok.</p>
    @endforelse

    @if($relatedProducts->isNotEmpty())
        <h2>Benzer Ürünler</h2>
        <div class="grid">
            @foreach($relatedProducts as $related)
                <article class="card">
                    <strong>{{ $related->brand }} {{ $related->model }}</strong>
                    <p>{{ number_format($related->current_price, 2, ',', '.') }} ₺</p>
                    <a href="{{ route('products.show', $related) }}">İncele</a>
                </article>
            @endforeach
        </div>
    @endif
@endsection
