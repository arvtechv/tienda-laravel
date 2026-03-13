@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>🛒 Mi Carrito</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Tu carrito está vacío.
            <a href="{{ route('home') }}">Ver productos</a>
        </div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 width="50" class="mr-2">
                        @endif
                        {{ $item->product->name }}
                    </td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex">
                            @csrf @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                   min="1" class="form-control form-control-sm" style="width:70px">
                            <button class="btn btn-sm btn-outline-secondary ml-1">✔</button>
                        </form>
                    </td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td colspan="2"><strong class="text-success">${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">← Seguir comprando</a>
            <button class="btn btn-success">💳 Proceder al pago</button>
        </div>
    @endif

</div>
@endsection
