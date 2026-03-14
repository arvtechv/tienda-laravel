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

    @elseif(auth()->user()->hasRole('cliente'))
    {{-- VISTA CLIENTE: CARDS --}}
    <div style="display:flex; gap:20px;">
        <div style="flex:1;">
            <p style="color:#686B75; margin-bottom:16px;">Agrega a tu carrito los artículos que deseas comprar</p>

            {{-- FILTROS --}}
            <div class="filter-tabs-new">
                <button class="filter-tab-new active" onclick="filterProducts('todos', this)">Todos</button>
                <button class="filter-tab-new" onclick="filterProducts('electronicos', this)">Electrónicos</button>
                <button class="filter-tab-new" onclick="filterProducts('ropa', this)">Ropa</button>
                <button class="filter-tab-new" onclick="filterProducts('calzado', this)">Calzado</button>
                <button class="filter-tab-new" onclick="filterProducts('linea_blanca', this)">Linea Blanca</button>
            </div>

            {{-- GRID DE PRODUCTOS --}}
            <div class="product-grid">
                @forelse($products as $product)
                <div class="product-card-new">
                    <a href="{{ route('products.show', $product) }}" style="text-decoration:none;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div style="width:100%; height:140px; background:#dde0e8; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:2rem; margin-bottom:10px;">📦</div>
                        @endif
                        <div class="p-name">{{ $product->name }}</div>
                        <div class="p-price">$ {{ number_format($product->price, 0) }}</div>
                    </a>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button class="btn-agregar-card">Agregar</button>
                    </form>
                </div>
                @empty
                <div style="grid-column:span 4; text-align:center; color:#9CA3AF; padding:40px;">
                    No hay productos aún.
                </div>
                @endforelse
            </div>

            {{-- PAGINACION --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                <div style="font-size:0.85rem; color:#686B75;">
                    <select style="border:1px solid #e5e7eb; border-radius:6px; padding:4px 8px;">
                        <option>20</option><option>50</option>
                    </select>
                    Registros Visibles
                </div>
                <div class="pagination-custom">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No hay productos aún.</p>
            </div>
        @endforelse
    </div>
    @endif
@else
 <div style="text-align:center; color:#fff;">
        <div style="font-size:1.8rem; font-weight:800; margin-bottom:8px;">str<span style="color:#D15253;">APP</span>berry</div>
        <p style="color:rgba(255,255,255,0.7); margin-bottom:24px;">Inicia sesión para ver los productos</p>
        <a href="{{ route('login') }}" style="background:#fff; color:#353C59; padding:12px 32px; border-radius:10px; font-weight:700; text-decoration:none;">
            Iniciar sesión
        </a>
    </div>
@endauth
@endsection

@section('scripts')
<script>
// Búsqueda en tabla admin
document.getElementById('searchInput')?.addEventListener('input', function() {
    const val = this.value.toLowerCase();
    document.querySelectorAll('#productTable tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
    });
});

// Filtros cliente
function filterProducts(cat, btn) {
    document.querySelectorAll('.filter-tab-new').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
</script>
@endsection
