<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matriculacion;
use App\Models\Asignatura;
use App\Models\User;

class HorarioController extends Controller
{
    public function index()
    {
      /*  // Obtener los horarios del profesor autenticado
        $horarios = Horario::where('usuario_id', Auth::id())->get();

        return view('profesor.horarios.index', compact('horarios'));*/
    }    
}
