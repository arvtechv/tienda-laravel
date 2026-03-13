@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Producto</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <div class="form-group">
            <label>Imagen actual</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
