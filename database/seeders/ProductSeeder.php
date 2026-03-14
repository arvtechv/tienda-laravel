<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Teclado', 'price' => 700, 'stock' => 10, 'category' => 'electronicos', 'description' => 'Teclado mecánico', 'image' => null],
            ['name' => 'Mouse', 'price' => 1299, 'stock' => 15, 'category' => 'electronicos', 'description' => 'Mouse inalámbrico', 'image' => null],
            ['name' => 'Laptop', 'price' => 16999, 'stock' => 5, 'category' => 'electronicos', 'description' => 'Laptop de alto rendimiento', 'image' => null],
            ['name' => 'Monitor 20"', 'price' => 2900, 'stock' => 8, 'category' => 'electronicos', 'description' => 'Monitor Full HD', 'image' => null],
        ];

        foreach ($products as $product) {
            DB::table('products')->insertOrIgnore($product);
        }
    }
}
