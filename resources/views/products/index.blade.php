@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    {{-- HERO --}}
    <div class="hero-section">
        <div class="hero-badge">
            🖥️ La mejor tecnología al mejor precio
        </div>
        <h1 class="hero-title">TechStore</h1>
        <p class="hero-subtitle">Computadoras, periféricos y accesorios de las mejores marcas con envío rápido.</p>
    </div>

    {{-- FILTROS --}}
    <div class="filter-bar">
        <div class="filter-tabs">
            <button class="filter-tab active">Todos</button>
            <button class="filter-tab">Computadoras</button>
            <button class="filter-tab">Mouse</button>
            <button class="filter-tab">Teclados</button>
            <button class="filter-tab">Monitores</button>
            <button class="filter-tab">Accesorios</button>
        </div>
        <div class="search-box">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Buscar productos...">
        </div>
    </div>

    {{-- PRODUCTOS --}}
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 mb-4">
            <div class="product-card">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/400x200?text={{ urlencode($product->name) }}"
                         alt="{{ $product->name }}">
                @endif

                <div class="product-card-body">
                    <div class="product-brand">{{ $product->brand ?? 'TechStore' }}</div>
                    <div class="product-name">{{ $product->name }}</div>

                    <div class="product-footer">
                        <span class="product-price">${{ number_format($product->price, 2) }}</span>

                        @auth
                            @if(auth()->user()->hasRole('cliente'))
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button class="btn-agregar">
                                        🛒 Agregar
                                    </button>
                                </form>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="btn-admin-edit">✏️ Editar</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('¿Eliminar?')">
                                        @csrf @method('DELETE')
                                        <button class="btn-admin-delete">🗑</button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-agregar">
                                🛒 Agregar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No hay productos aún.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
