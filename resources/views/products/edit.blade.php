@extends('layouts.app')

@section('content')
<div class="content-card">
    <div class="content-header">Editar Producto</div>
    <div class="content-body">

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div style="max-width:600px;">
                <input type="text" name="name" class="input-custom"
                       placeholder="Nombre" value="{{ $product->name }}" required>

                <input type="number" name="price" step="0.01" class="input-custom"
                       placeholder="Precio" value="{{ $product->price }}" required>

                <select name="category" class="input-custom">
                    <option value="">Categoría ▼</option>
                    <option value="electronicos" {{ $product->category == 'electronicos' ? 'selected' : '' }}>Electrónicos</option>
                    <option value="ropa" {{ $product->category == 'ropa' ? 'selected' : '' }}>Ropa</option>
                    <option value="calzado" {{ $product->category == 'calzado' ? 'selected' : '' }}>Calzado</option>
                    <option value="linea_blanca" {{ $product->category == 'linea_blanca' ? 'selected' : '' }}>Linea Blanca</option>
                </select>

                <textarea name="description" class="input-custom" rows="4"
                          placeholder="Descripcion" required>{{ $product->description }}</textarea>

                <input type="number" name="stock" class="input-custom"
                       placeholder="Stock" value="{{ $product->stock }}" required>

                <div style="border:2px dashed #cdd0d8; border-radius:12px; padding:32px; text-align:center; margin-bottom:20px; cursor:pointer; background:#FAFAFA;"
                     onclick="document.getElementById('imageInput').click()">
                    <div id="imagePreview">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 style="max-height:150px; border-radius:8px;">
                        @else
                            <div style="font-size:2.5rem; color:#9CA3AF; margin-bottom:8px;">🖼</div>
                            <p style="color:#9CA3AF; font-size:0.9rem;">Carga tu imagen</p>
                        @endif
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*"
                           style="display:none" onchange="previewImage(this)">
                </div>

                <div style="display:flex; justify-content:flex-end; gap:12px;">
                    <a href="{{ route('products.index') }}"
                       style="background:#F0F1F5; color:#353C59; border-radius:10px; padding:13px 28px; font-weight:600; text-decoration:none;">
                        Cancelar
                    </a>
                    <button type="submit" class="btn-primary-custom" style="width:auto; padding:13px 40px;">
                        Actualizar producto
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').innerHTML =
                `<img src="${e.target.result}" style="max-height:150px; border-radius:8px;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
