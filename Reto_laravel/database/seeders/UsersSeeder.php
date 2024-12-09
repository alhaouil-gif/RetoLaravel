<?php

namespace Database\Seeders;

// database/seeders/UsersSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
         $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $secretaryRole = Role::firstOrCreate(['name' => 'Seretari@']);

         $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),  
        ]);
        $admin->assignRole($adminRole);   

         $secretary = User::create([
            'name' => 'Secretary User',
            'email' => 'secretary@admin.com',
            'password' => Hash::make('password123'),
        ]);
        $secretary->assignRole($secretaryRole); 
    }
}
