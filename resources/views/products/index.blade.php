@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2>Productos</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top" style="height:200px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sin+Imagen"
                             class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <h4 class="text-success">${{ number_format($product->price, 2) }}</h4>
                        <p class="text-muted small">Stock: {{ $product->stock }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm">Ver</a>

                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            @endif

                            @if(auth()->user()->hasRole('cliente'))
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">🛒 Agregar</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No hay productos aún.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
