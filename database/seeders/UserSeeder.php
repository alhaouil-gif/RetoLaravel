<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()

    {
        // Crear roles de profesor y alumno si no existen
        
        $profesorRole = Role::firstOrCreate(['name' => 'profesor']);
        $alumnoRole = Role::firstOrCreate(['name' => 'alumno']);
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        // Crear 20 profesores
        User::factory(20)->create()->each(function ($user) use ($profesorRole) {
            $user->assignRole($profesorRole);
        });

        // Crear 50 alumnos
        User::factory(50)->create()->each(function ($user) use ($alumnoRole) {
            $user->assignRole($alumnoRole);
        });


        User::factory(10)->create()->each(function ($user) {
            // No asignar rol
        });
    }
}
