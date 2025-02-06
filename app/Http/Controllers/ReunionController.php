<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Matriculacion;
use App\Models\Reunion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReunionController extends Controller
{
    // Mostrar los profesores disponibles para solicitar reunión
    public function mostrarProfesores()
    {
        $alumnoId = Auth::id(); // ID del alumno autenticado

        // Obtener las asignaturas desde el campo JSON en la tabla matriculacions
        $matricula = Matriculacion::where('alumno_id', $alumnoId)->first();

        if (!$matricula) {
            return redirect()->back()->with('error', 'No estás matriculado en ninguna asignatura.');
        }

        // Extraer los nombres de las asignaturas desde el JSON
        $asignaturas = json_decode($matricula->nombre_asignatura, true);


        $profesores = User::whereHas('horarios.asignaturas', function ($query) use ($asignaturas) {
            $query->whereIn('nombre', $asignaturas);
        })->get();
          
return view('alumno.solicitar_reunion', compact('profesores'));


        return view('alumno.solicitar_reunion', compact('profesores'));
    }

    // Guardar la solicitud de reunión
    public function solicitarReunion(Request $request)
    {
        $request->validate([
            'profesor_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora' => 'required|integer|min:1|max:6',
        ]);

        Reunion::create([
            'alumno_id' => Auth::id(),
            'profesor_id' => $request->profesor_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('alumno.reuniones')->with('success', 'Reunión solicitada con éxito.');
    }

    // Mostrar reuniones solicitadas por el alumno
    public function reunionesAlumno()
    {
        $reuniones = Reunion::where('alumno_id', Auth::id())->get();
        return view('alumno.reuniones', compact('reuniones'));
    }

    public function reunionesProfesor()
    {
        $reuniones = Reunion::where('profesor_id', Auth::id())->get(); // Sin filtrar por estado
        return view('profesor.reuniones', compact('reuniones'));
    }
    
    
    
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate(['estado' => 'required|in:aceptada,rechazada']);
        
        $reunion = Reunion::findOrFail($id);
        $reunion->estado = $request->estado;
        $reunion->save();
        
        // Redirigir a la lista de reuniones con un mensaje de éxito
        return redirect()->route('profesor.reuniones')->with('success', 'Estado actualizado correctamente.');
    }
    
    
}
