<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AsignaturaCursoSeeder extends Seeder
{
    public function run()
    {
        // Obtener todas las asignaturas y cursos
        $asignaturas = DB::table('asignaturas')->get();
        $cursos = DB::table('cursos')->get();

        $data = [];

        foreach ($asignaturas as $asignatura) {
            // Relacionar asignatura con su curso correspondiente
            $cursoRelacionado = $cursos->firstWhere('id', $asignatura->curso_id);
            if ($cursoRelacionado) {
                $data[] = [
                    'asignatura_id' => $asignatura->id,
                    'curso_id' => $cursoRelacionado->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insertar datos en la tabla pivote
        DB::table('asignatura_curso')->insert($data);

        $this->command->info('Datos insertados correctamente en la tabla asignatura_curso.');
    }
}
