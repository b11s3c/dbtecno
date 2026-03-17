@extends('layouts.app')

@section('content')
    <h1>Favorilerim</h1>
    @forelse($favorites as $favorite)
        <article class="card">
            <strong>{{ $favorite->product->brand }} {{ $favorite->product->model }}</strong>
        </article>
    @empty
        <p>Favori ürününüz yok.</p>
    @endforelse
@endsection
