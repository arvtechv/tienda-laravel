@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Agregar Producto</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
