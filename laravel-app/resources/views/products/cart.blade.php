@extends('layouts.app')

@section('content')
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
