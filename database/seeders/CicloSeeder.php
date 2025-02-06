<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\Asignatura;

class CicloSeeder extends Seeder
{
    public function run()
    {
        // Crear ciclos
        $ciclos = [
            'Desarrollo de Aplicaciones Web (DAW)',
            'Desarrollo de Aplicaciones Multiplataforma (DAM)',
            'Administración de Sistemas Informáticos en Red (ASIR)',
        ];

        foreach ($ciclos as $cicloNombre) {
            $ciclo = Ciclo::create(['nombre' => $cicloNombre]);

            // Crear cursos para cada ciclo
            $primerCurso = Curso::create([
                'nombre' => 'Primero ' . $cicloNombre,
                'ciclo_id' => $ciclo->id,
            ]);
            $segundoCurso = Curso::create([
                'nombre' => 'Segundo ' . $cicloNombre,
                'ciclo_id' => $ciclo->id,
            ]);

            // Asignaturas comunes a todos los ciclos
            $asignaturasComunesGenerales = [
                ['nombre' => 'Inglés profesional (SG)', 'curso_id' => $segundoCurso->id],
                ['nombre' => 'Formación y orientación laboral (FOL)', 'curso_id' => $primerCurso->id],
                ['nombre' => 'Inglés técnico', 'curso_id' => $primerCurso->id],
                ['nombre' => 'Itinerario personal para la empleabilidad I', 'curso_id' => $primerCurso->id],
                ['nombre' => 'Itinerario personal para la empleabilidad II', 'curso_id' => $segundoCurso->id],
                ['nombre' => 'Formación en centros de trabajo (FCT)', 'curso_id' => $segundoCurso->id],
                ['nombre' => 'Empresa e iniciativa emprendedora', 'curso_id' => $segundoCurso->id],
                ['nombre' => 'Digitalización aplicada a los sectores productivos (GS)', 'curso_id' => $segundoCurso->id],
                ['nombre' => 'Sostenibilidad aplicada al sistema productivo', 'curso_id' => $segundoCurso->id],
            ];

            foreach ($asignaturasComunesGenerales as $asignatura) {
                Asignatura::create([
                    'nombre' => $asignatura['nombre'],
                    'curso_id' => $asignatura['curso_id'],
                    'es_comun' => true,
                ]);
            }

            // Asignaturas comunes solo a DAW y DAM
            if ($cicloNombre == 'Desarrollo de Aplicaciones Web (DAW)' || $cicloNombre == 'Desarrollo de Aplicaciones Multiplataforma (DAM)') {
                $asignaturasComunesDAWyDAM = [
                    ['nombre' => 'Lenguajes de marcas y sistemas de gestión de información', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Sistemas informáticos', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Programación', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Entornos de desarrollo', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Bases de datos', 'curso_id' => $primerCurso->id],
                ];

                foreach ($asignaturasComunesDAWyDAM as $asignatura) {
                    Asignatura::create([
                        'nombre' => $asignatura['nombre'],
                        'curso_id' => $asignatura['curso_id'],
                        'es_comun' => true,
                    ]);
                }
            }

            // Asignaturas específicas para cada ciclo
            $asignaturasEspecificas = [];

            if ($cicloNombre == 'Desarrollo de Aplicaciones Web (DAW)') {
                $asignaturasEspecificas = [
                    ['nombre' => 'Desarrollo web en entorno cliente', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Desarrollo web en entorno servidor', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Despliegue de aplicaciones web', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Diseño de interfaces web', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Proyecto de desarrollo de aplicaciones web', 'curso_id' => $segundoCurso->id],
                ];
            } elseif ($cicloNombre == 'Desarrollo de Aplicaciones Multiplataforma (DAM)') {
                $asignaturasEspecificas = [
                    ['nombre' => 'Acceso a datos', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Desarrollo de interfaces', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Programación multimedia y dispositivos móviles', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Programación de servicios y procesos', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Sistemas de gestión empresarial', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Proyecto intermodular de desarrollo de aplicaciones multiplataforma', 'curso_id' => $segundoCurso->id],
                ];
            } elseif ($cicloNombre == 'Administración de Sistemas Informáticos en Red (ASIR)') {
                $asignaturasEspecificas = [
                    ['nombre' => 'Implantación de sistemas operativos', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Planificación y administración de redes', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Fundamentos de hardware', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Gestión de bases de datos', 'curso_id' => $primerCurso->id],
                    ['nombre' => 'Administración de sistemas operativos', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Servicios de red e internet', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Implantación de aplicaciones web', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Administración de sistemas gestores de bases de datos', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Seguridad y alta disponibilidad', 'curso_id' => $segundoCurso->id],
                    ['nombre' => 'Proyecto de administración de sistemas informáticos en red', 'curso_id' => $segundoCurso->id],
                ];
            }

            foreach ($asignaturasEspecificas as $asignatura) {
                Asignatura::create([
                    'nombre' => $asignatura['nombre'],
                    'curso_id' => $asignatura['curso_id'],
                    'es_comun' => false,
                ]);
            }
        }
    }
}
