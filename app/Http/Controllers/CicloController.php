<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    // Mostrar todos los ciclos
    public function index()
    {
        $ciclos = Ciclo::paginate(10);
        return view('ciclos.index', compact('ciclos'));
    }
    

    // Mostrar el formulario para crear un nuevo ciclo
    public function create()
    {
        return view('ciclos.create');
    }

    // Almacenar un nuevo ciclo en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Crear el ciclo
        $ciclo = Ciclo::create([
            'nombre' => $request->nombre,
        ]);
    
        // Crear los dos cursos asociados al ciclo
        $cursos = [
            ['nombre' => 'Primero ' . $ciclo->nombre, 'ciclo_id' => $ciclo->id],
            ['nombre' => 'Segundo ' . $ciclo->nombre, 'ciclo_id' => $ciclo->id],
        ];
    
        \App\Models\Curso::insert($cursos);
    
        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo y sus cursos creados exitosamente.');
    }
    

    // Mostrar un ciclo específico
    public function show($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('ciclos.show', compact('ciclo'));
    }

    // Mostrar el formulario de edición de un ciclo
    public function edit($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('ciclos.edit', compact('ciclo'));
    }

    // Actualizar un ciclo en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $ciclo = Ciclo::findOrFail($id);
        $ciclo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo actualizado correctamente.');
    }

    // Eliminar un ciclo
    public function destroy($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $ciclo->delete();

        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo eliminado correctamente.');
    }
}
