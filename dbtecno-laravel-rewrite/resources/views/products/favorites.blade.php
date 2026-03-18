@extends('layouts.app')

@section('content')
    <h1>Favorilerim</h1>
    <div class="grid">
        @forelse($favorites as $favorite)
            <article class="card">
                <strong>{{ $favorite->product->brand }} {{ $favorite->product->model }}</strong>
                <p>{{ number_format($favorite->product->current_price, 2, ',', '.') }} ₺</p>
                <div class="row">
                    <a class="btn btn-outline" href="{{ route('products.show', $favorite->product) }}">Ürüne Git</a>
                    <form method="POST" action="{{ route('favorites.destroy', $favorite->product) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Kaldır</button>
                    </form>
                </div>
            </article>
        @empty
            <p>Favori ürününüz yok.</p>
        @endforelse
    </div>
@endsection
