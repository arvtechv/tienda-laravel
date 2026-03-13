@extends('layouts.app')

@section('content')
@auth
    @if(auth()->user()->hasRole('admin'))
    {{-- VISTA ADMIN: TABLA --}}
    <div class="content-card">
        <div class="content-header">Productos</div>
        <div class="content-body">

            <div style="display:flex; justify-content:flex-end; align-items:center; margin-bottom:16px; gap:10px;">
                <label style="font-size:0.9rem; color:#686B75;">Buscar</label>
                <div style="position:relative;">
                    <input type="text" id="searchInput" placeholder="Buscar..."
                           style="border:1px solid #e5e7eb; border-radius:8px; padding:8px 36px 8px 14px; font-size:0.9rem; outline:none;">
                    <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#686B75;">🔍</span>
                </div>
            </div>

            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre ↕</th>
                        <th>Precio ↕</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     style="width:56px; height:42px; object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:56px; height:42px; background:#ECEEF3; border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">📦</div>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td class="price-red">$ {{ number_format($product->price, 0) }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn-edit">
                                📅 Editar
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  style="display:inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn-delete">🗑 Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#9CA3AF; padding:40px;">
                            No hay productos aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINACION --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                <div style="font-size:0.85rem; color:#686B75;">
                    <select style="border:1px solid #e5e7eb; border-radius:6px; padding:4px 8px;">
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    Registros Visibles
                </div>
                <div class="pagination-custom">
                    {{ $products->links() }}
                </div>
            </div>

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

        {{-- CARRITO LATERAL --}}
        @php
            $cartItems = \App\CartItem::where('user_id', auth()->id())->with('product')->get();
            $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        @endphp
        @if($cartItems->count() > 0)
        <div class="cart-sidebar">
            <h5>Mi carrito</h5>
            @foreach($cartItems as $item)
            <div class="cart-item-row">
                @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}">
                @else
                    <div style="width:50px; height:40px; background:#ECEEF3; border-radius:6px; display:flex; align-items:center; justify-content:center;">📦</div>
                @endif
                <div class="cart-item-info">
                    <div class="name">{{ $item->product->name }}</div>
                    <div class="price">$ {{ number_format($item->product->price, 0) }}</div>
                </div>
                <div class="qty-controls">
                    <form action="{{ route('cart.update', $item) }}" method="POST" style="display:inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                        <button class="qty-btn">−</button>
                    </form>
                    {{ $item->quantity }}
                    <form action="{{ route('cart.update', $item) }}" method="POST" style="display:inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                        <button class="qty-btn">+</button>
                    </form>
                </div>
            </div>
            @endforeach

            <div class="cart-total">
                <span>Total</span>
                <span>${{ number_format($total, 0) }}</span>
            </div>

            <button class="btn-primary-custom" style="margin-top:16px;">Comprar ahora</button>
        </div>
        @endif
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
