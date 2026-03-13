<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Ver todos los productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Formulario crear producto (solo admin)
    public function create()
    {
        $this->authorize('isAdmin');
        return view('products.create');
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado!');
    }

    // Ver un producto
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Formulario editar
    public function edit(Product $product)
    {
        $this->authorize('isAdmin');
        return view('products.edit', compact('product'));
    }

    // Actualizar producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado!');
    }

    // Eliminar producto
    public function destroy(Product $product)
    {
        $this->authorize('isAdmin');
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado!');
    }
}
