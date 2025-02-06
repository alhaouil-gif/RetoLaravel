<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{


    public function dashboard()
    {
        return view('alumno.dashboard');   
    }
    public function show()
    {
        $alumno = User::with('matriculaciones.curso.ciclo')->findOrFail(auth()->id());
    
        return view('alumno.asignaturas', compact('alumno'));
    }
    
    }
