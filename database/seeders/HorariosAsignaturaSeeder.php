<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horario;
use App\Models\Asignatura;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HorariosAsignaturaSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los profesores (usuarios con el rol 'profesor')
        $profesores = User::role('profesor')->get();

        // Obtener todas las asignaturas
        $asignaturas = Asignatura::all();

        // Verificar si hay suficientes profesores y asignaturas
        if ($profesores->isEmpty() || $asignaturas->count() < 3) {
            $this->command->warn('Se necesitan más profesores o asignaturas para poblar los horarios.');
            return;
        }

        // Definir los días de la semana y las horas disponibles
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $horas = [1, 2, 3, 4, 5, 6];

        // Crear horarios para cada profesor
        foreach ($profesores as $profesor) {
            // Seleccionar exactamente 3 asignaturas únicas para este profesor
            $asignaturasProfesor = $asignaturas->random(3);

            // Generar una lista de todas las combinaciones posibles de día y hora
            $horariosPosibles = [];
            foreach ($dias as $dia) {
                foreach ($horas as $hora) {
                    $horariosPosibles[] = ['dia' => $dia, 'hora' => $hora];
                }
            }

            // Barajar los horarios posibles y elegir algunos al azar como libres
            shuffle($horariosPosibles);
            $horasLibres = rand(7, 9);
            $horariosLibresSeleccionados = array_slice($horariosPosibles, 0, $horasLibres);

            // Crear horarios ocupados y libres
            $asignaturaIndex = 0; // Para alternar las asignaturas
            foreach ($horariosPosibles as $horarioData) {
                // Determinar si este horario está libre
                $horalibre = in_array($horarioData, $horariosLibresSeleccionados) ? 1 : 0;

                // Crear un horario para el profesor
                $horario = Horario::create([
                    'usuario_id' => $profesor->id,
                    'dia' => $horarioData['dia'],
                    'hora' => $horarioData['hora'],
                    'horalibre' => $horalibre,                  
                ]);

                // Si el horario no es libre, asignarle una de las 3 asignaturas seleccionadas
                if ($horalibre == 0) {
                    $asignaturaSeleccionada = $asignaturasProfesor[$asignaturaIndex % 3]; // Alternar entre 3 asignaturas
                    $asignaturaIndex++;

                    // Insertar en la tabla pivot 'horarios_asignaturas'
                    DB::table('horarios_asignaturas')->insert([
                        'asignatura_id' => $asignaturaSeleccionada->id,
                        'horario_id' => $horario->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->command->info('Horarios asignados a los profesores correctamente.');
    }
}
