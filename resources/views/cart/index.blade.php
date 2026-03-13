@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4 style="font-weight:700; color:#0f172a; margin-bottom:24px">🛒 Mi Carrito</h4>

    @if($cartItems->isEmpty())
        <div style="text-align:center; padding:80px 0;">
            <div style="font-size:4rem; margin-bottom:16px">🛒</div>
            <h5 style="color:#64748b; font-weight:600">Tu carrito está vacío</h5>
            <p style="color:#94a3b8">Agrega productos para continuar</p>
            <a href="{{ route('home') }}" style="
                background:#2563eb; color:#fff; padding:10px 24px;
                border-radius:8px; text-decoration:none; font-weight:600;
                display:inline-block; margin-top:12px;
            ">Ver productos</a>
        </div>
    @else
        <div class="row">
            {{-- TABLA DE PRODUCTOS --}}
            <div class="col-md-8">
                <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">
                    <table class="table mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:0.8rem; color:#64748b; font-weight:600; border:none; padding:14px 20px;">PRODUCTO</th>
                                <th style="font-size:0.8rem; color:#64748b; font-weight:600; border:none;">PRECIO</th>
                                <th style="font-size:0.8rem; color:#64748b; font-weight:600; border:none;">CANTIDAD</th>
                                <th style="font-size:0.8rem; color:#64748b; font-weight:600; border:none;">SUBTOTAL</th>
                                <th style="border:none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr style="border-top:1px solid #f1f5f9;">
                                <td style="padding:16px 20px; vertical-align:middle;">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 style="width:56px; height:56px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;">
                                        @else
                                            <div style="width:56px; height:56px; background:#f1f5f9; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">📦</div>
                                        @endif
                                        <div>
                                            <div style="font-weight:600; color:#1e293b; font-size:0.95rem;">{{ $item->product->name }}</div>
                                            <div style="font-size:0.8rem; color:#94a3b8;">Stock: {{ $item->product->stock }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align:middle; color:#64748b; font-size:0.95rem;">
                                    ${{ number_format($item->product->price, 2) }}
                                </td>
                                <td style="vertical-align:middle;">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" style="display:flex; align-items:center; gap:6px;">
                                        @csrf @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                               style="width:65px; border:1px solid #e5e7eb; border-radius:8px; padding:6px 10px; font-size:0.9rem; text-align:center;">
                                        <button style="background:#f1f5f9; border:none; border-radius:8px; padding:6px 10px; cursor:pointer; color:#64748b;">✔</button>
                                    </form>
                                </td>
                                <td style="vertical-align:middle; font-weight:700; color:#0f172a;">
                                    ${{ number_format($item->product->price * $item->quantity, 2) }}
                                </td>
                                <td style="vertical-align:middle;">
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('¿Eliminar?')"
                                                style="background:#fee2e2; color:#ef4444; border:none; border-radius:8px; padding:6px 12px; cursor:pointer; font-size:0.85rem;">
                                            🗑
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('home') }}" style="
                    display:inline-flex; align-items:center; gap:6px;
                    color:#64748b; text-decoration:none; margin-top:16px;
                    font-size:0.9rem; font-weight:500;
                ">← Seguir comprando</a>
            </div>

            {{-- RESUMEN --}}
            <div class="col-md-4">
                <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; padding:24px;">
                    <h6 style="font-weight:700; color:#0f172a; margin-bottom:20px;">Resumen del pedido</h6>

                    <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                        <span style="color:#64748b; font-size:0.9rem;">Subtotal</span>
                        <span style="font-weight:600;">${{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                        <span style="color:#64748b; font-size:0.9rem;">Envío</span>
                        <span style="color:#22c55e; font-weight:600;">Gratis</span>
                    </div>

                    <hr style="border-color:#f1f5f9;">

                    <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
                        <span style="font-weight:700; color:#0f172a;">Total</span>
                        <span style="font-weight:700; font-size:1.2rem; color:#0f172a;">${{ number_format($total, 2) }}</span>
                    </div>

                    <button style="
                        background:#2563eb; color:#fff; border:none;
                        border-radius:8px; padding:14px; width:100%;
                        font-weight:600; font-size:0.95rem; cursor:pointer;
                    ">💳 Proceder al pago</button>

                    <div style="display:flex; align-items:center; justify-content:center; gap:6px; margin-top:16px;">
                        <span style="font-size:0.75rem; color:#94a3b8;">🔒 Pago seguro y encriptado</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
