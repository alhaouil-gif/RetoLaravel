<?php

namespace Database\Seeders;
use App\Models\Ciclo;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dam = Ciclo::create(['nombre' => 'DAM']);
        $dam->cursos()->createMany([
            ['nombre' => 'DAM 1'],
            ['nombre' => 'DAM 2']
        ]);

        $daw = Ciclo::create(['nombre' => 'DAW']);
        $daw->cursos()->createMany([
            ['nombre' => 'DAW 1'],
            ['nombre' => 'DAW 2']
        ]);

        $asir = Ciclo::create(['nombre' => 'ASIR']);
        $asir->cursos()->createMany([
            ['nombre' => 'ASIR 1'],
            ['nombre' => 'ASIR 2']
        ]);
    }
}
