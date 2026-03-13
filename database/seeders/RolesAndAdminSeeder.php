<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'cliente']);

        // Crear usuario admin
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@tienda.com',
            'password' => bcrypt('password123'),
        ]);

        $admin->assignRole('admin');
    }
}
