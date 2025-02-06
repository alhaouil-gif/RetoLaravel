<?php

namespace Database\Seeders;

use App\Models\User;
 
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
         $role = Role::firstOrCreate(['name' => 'superadministrador']);

         $superadmin = User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
            'foto' => 'default.png',  
            'dni' => '12345678',  
            'apellido' => 'Admin', 
            'direccion' => 'Dirección genérica',  
        ]);

         $superadmin->assignRole($role);
    }
}
