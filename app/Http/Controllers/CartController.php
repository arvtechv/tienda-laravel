<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Ver carrito
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
                            ->with('product')
                            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Agregar al carrito
    public function add(Product $product)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
                           ->where('product_id', $product->id)
                           ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito!');
    }

    // Actualizar cantidad
    public function update(Request $request, CartItem $cartItem)
    {
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Carrito actualizado!');
    }

    // Eliminar del carrito
    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito!');
    }
}
