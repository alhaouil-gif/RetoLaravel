<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
 

         $this->call(CicloSeeder::class);

        $this->call([
          SuperAdminSeeder::class,  
          UserSeeder::class,  
      ]);
       // $this->call(HorarioSeeder::class);  

        $this->call(HorariosAsignaturaSeeder::class);
        $this->call(AsignaturaCursoSeeder::class);

    }
}
/*****************************/






