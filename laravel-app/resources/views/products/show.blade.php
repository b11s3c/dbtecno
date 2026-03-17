@extends('layouts.app')

@section('content')
    <h1>{{ $product->brand }} {{ $product->model }}</h1>
    <p>Kategori: {{ $product->category }}</p>
    <p>Fiyat: {{ number_format($product->price, 2, ',', '.') }} ₺</p>

    <h2>Yorumlar</h2>
    @forelse($product->evaluations as $evaluation)
        <article class="card">
            <strong>{{ $evaluation->user->name ?? 'Müşteri' }}</strong>
            <p>Puan: {{ $evaluation->score }}/5</p>
            <p>{{ $evaluation->comment }}</p>
        </article>
    @empty
        <p>Henüz değerlendirme yok.</p>
    @endforelse
@endsection
