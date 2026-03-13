@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded">
            @else
                <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-md-7">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h3 class="text-success">${{ number_format($product->price, 2) }}</h3>
            <p>Stock disponible: {{ $product->stock }}</p>

            @auth
                @if(auth()->user()->hasRole('cliente'))
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-lg">🛒 Agregar al carrito</button>
                    </form>
                @endif
            @endauth

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">← Volver</a>
        </div>
    </div>
</div>
@endsection
