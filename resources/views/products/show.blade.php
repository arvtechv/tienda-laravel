@extends('layouts.app')

@section('content')
<div class="content-card">
    <div class="content-header">Detalle del Producto</div>
    <div class="content-body">

        <div style="display:flex; gap:40px; align-items:flex-start;">
            {{-- IMAGEN --}}
            <div style="flex-shrink:0;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         style="width:220px; height:180px; object-fit:cover; border-radius:12px; background:#ECEEF3;">
                @else
                    <div style="width:220px; height:180px; background:#ECEEF3; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:3rem;">📦</div>
                @endif
            </div>

            {{-- INFO --}}
            <div style="flex:1;">
                <h4 style="font-weight:700; color:#353C59; font-size:1.2rem; margin-bottom:8px;">
                    {{ $product->name }}
                </h4>
                <h3 style="font-weight:700; color:#353C59; font-size:1.5rem; margin-bottom:20px;">
                    ${{ number_format($product->price, 0) }}
                </h3>
                <p style="color:#686B75; font-size:0.9rem; line-height:1.6; margin-bottom:28px;">
                    {{ $product->description }}
                </p>

                @auth
                    @if(auth()->user()->hasRole('cliente'))
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button class="btn-primary-custom" style="width:auto; padding:13px 40px;">
                                Agregar al carrito
                            </button>
                        </form>
                    @endif
                @endauth

                <a href="{{ route('home') }}"
                   style="display:inline-block; margin-top:16px; color:#686B75; font-size:0.9rem; text-decoration:none;">
                    ← Volver a productos
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
