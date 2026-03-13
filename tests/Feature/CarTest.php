<?php

namespace Tests\Feature;

use App\CartItem;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'cliente']);
    }

    // Prueba 1 - Cliente puede agregar al carrito
    public function test_cliente_puede_agregar_al_carrito()
    {
        $cliente = User::create([
            'name'     => 'Cliente',
            'email'    => 'cliente@test.com',
            'password' => bcrypt('password'),
        ]);
        $cliente->assignRole('cliente');

        $product = Product::create([
            'name'        => 'Producto Test',
            'description' => 'Descripcion',
            'price'       => 99.99,
            'stock'       => 10,
        ]);

        $response = $this->actingAs($cliente)->post("/cart/add/{$product->id}");
        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', [
            'user_id'    => $cliente->id,
            'product_id' => $product->id,
        ]);
    }

    // Prueba 2 - Cliente puede ver su carrito
    public function test_cliente_puede_ver_carrito()
    {
        $cliente = User::create([
            'name'     => 'Cliente',
            'email'    => 'cliente@test.com',
            'password' => bcrypt('password'),
        ]);
        $cliente->assignRole('cliente');

        $response = $this->actingAs($cliente)->get('/cart');
        $response->assertStatus(200);
    }

    // Prueba 3 - Cliente puede eliminar del carrito
    public function test_cliente_puede_eliminar_del_carrito()
    {
        $cliente = User::create([
            'name'     => 'Cliente',
            'email'    => 'cliente@test.com',
            'password' => bcrypt('password'),
        ]);
        $cliente->assignRole('cliente');

        $product = Product::create([
            'name'        => 'Producto Test',
            'description' => 'Descripcion',
            'price'       => 99.99,
            'stock'       => 10,
        ]);

        $cartItem = CartItem::create([
            'user_id'    => $cliente->id,
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        $response = $this->actingAs($cliente)->delete("/cart/remove/{$cartItem->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }
}
