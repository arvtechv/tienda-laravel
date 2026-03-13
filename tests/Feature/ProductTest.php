<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Crear roles antes de cada prueba
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'cliente']);
    }

    // Prueba 1 - Ver lista de productos
    public function test_puede_ver_lista_de_productos()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Prueba 2 - Admin puede crear producto
    public function test_admin_puede_crear_producto()
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post('/products', [
            'name'        => 'Producto Test',
            'description' => 'Descripcion test',
            'price'       => 99.99,
            'stock'       => 10,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Producto Test']);
    }

    // Prueba 3 - Cliente NO puede crear producto
    public function test_cliente_no_puede_crear_producto()
    {
        $cliente = User::create([
            'name'     => 'Cliente',
            'email'    => 'cliente@test.com',
            'password' => bcrypt('password'),
        ]);
        $cliente->assignRole('cliente');

        $response = $this->actingAs($cliente)->post('/products', [
            'name'        => 'Producto Test',
            'description' => 'Descripcion test',
            'price'       => 99.99,
            'stock'       => 10,
        ]);
         // Verificamos que NO se creó en la base de datos
        $this->assertDatabaseMissing('products', ['name' => 'Producto Test']);
    }

    // Prueba 4 - Admin puede eliminar producto
    public function test_admin_puede_eliminar_producto()
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $product = Product::create([
            'name'        => 'Producto a eliminar',
            'description' => 'Descripcion',
            'price'       => 50.00,
            'stock'       => 5,
        ]);

        $response = $this->actingAs($admin)->delete("/products/{$product->id}");
        $response->assertRedirect('/products');
         // Verificamos que se eliminó de la base de datos
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
