<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
class ProfesorController extends Controller
{
    public function dashboard()
    {
        return view('profesor.dashboard');   
    }

    public function index()
    {
        $profesores = User::role('profesor')->paginate(10);

        return view('profesor.profesores.index', compact('profesores'));
    }

 public function horarios()
{
    $profesorId = auth()->user()->id; // Obtiene el ID del profesor autenticado

    // Consulta los horarios con sus asignaturas
    $horarios = DB::table('horarios')
        ->leftJoin('horarios_asignaturas', 'horarios.id', '=', 'horarios_asignaturas.horario_id')
        ->leftJoin('asignaturas', 'horarios_asignaturas.asignatura_id', '=', 'asignaturas.id')
        ->where('horarios.usuario_id', $profesorId)
        ->select('horarios.dia', 'horarios.hora', 'horarios.horalibre', 'asignaturas.nombre as asignatura')
        ->get();

    // Organizar horarios en un array para la tabla
    $tablaHorarios = [];
    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

    foreach ($dias as $dia) {
        for ($hora = 1; $hora <= 6; $hora++) {
            $registro = $horarios->firstWhere(fn ($h) => $h->dia === $dia && $h->hora == $hora);

            if ($registro) {
                $tablaHorarios[$dia][$hora] = $registro->horalibre ? 'HORA LIBRE' : ($registro->asignatura ?? 'Sin asignatura');
            } else {
                $tablaHorarios[$dia][$hora] = 'Sin asignatura';
            }
        }
    }

    return view('profesor.horarios', compact('tablaHorarios'));
}


}