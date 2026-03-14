@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width:680px;">
    <div style="background:#fff; border-radius:16px; border:1px solid #e5e7eb; padding:36px;">

        <div style="margin-bottom:28px;">
            <h4 style="font-weight:700; color:#0f172a; margin-bottom:4px;">➕ Agregar Producto</h4>
            <p style="color:#94a3b8; font-size:0.9rem; margin:0;">Completa los datos del nuevo producto</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:18px;">
                <label style="font-size:0.85rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Nombre del producto</label>
                <input type="text" name="name" placeholder="Ej: Laptop Gaming Pro"
                       style="width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 14px; font-size:0.9rem; outline:none;"
                       value="{{ old('name') }}" required>
            </div>

            <div style="margin-bottom:18px;">
                <label style="font-size:0.85rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Descripción</label>
                <textarea name="description" rows="3" placeholder="Describe el producto..."
                          style="width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 14px; font-size:0.9rem; outline:none; resize:none;"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6" style="margin-bottom:18px;">
                    <label style="font-size:0.85rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Precio ($)</label>
                    <input type="number" name="price" step="0.01" placeholder="0.00"
                           style="width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 14px; font-size:0.9rem; outline:none;"
                           value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6" style="margin-bottom:18px;">
                    <label style="font-size:0.85rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Stock</label>
                    <input type="number" name="stock" placeholder="0"
                           style="width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 14px; font-size:0.9rem; outline:none;"
                           value="{{ old('stock') }}" required>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="font-size:0.85rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Imagen del producto</label>
                <div style="border:2px dashed #e5e7eb; border-radius:8px; padding:24px; text-align:center;">
                    <div style="font-size:2rem; margin-bottom:8px;">📷</div>
                    <input type="file" name="image" accept="image/*" style="font-size:0.85rem;">
                    <p style="color:#94a3b8; font-size:0.8rem; margin-top:8px; margin-bottom:0;">PNG, JPG hasta 2MB</p>
                </div>
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit" style="
                    background:#2563eb; color:#fff; border:none;
                    border-radius:8px; padding:12px 28px;
                    font-weight:600; font-size:0.95rem; cursor:pointer; flex:1;
                ">Guardar Producto</button>
                <a href="{{ route('products.index') }}" style="
                    background:#f1f5f9; color:#64748b; border:none;
                    border-radius:8px; padding:12px 28px;
                    font-weight:600; font-size:0.95rem; text-decoration:none;
                    display:flex; align-items:center;
                ">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
