<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Matriculacion;
use App\Models\Curso;
use App\Models\user;

 use App\Models\Ciclo;
use App\Models\Reunion;
use App\Models\Asignatura;
use Illuminate\Http\Request;


class MatriculacionController extends Controller
{
     public function index(Request $request)
    {

        $matriculaciones = Matriculacion::with(['alumno', 'curso.ciclo']) ->paginate(10);
        return view('admin.matriculaciones.index', compact('matriculaciones'));
    }
    


    public function create($user)
    {
        $alumno = User::findOrFail($user);
    
        // Obtener los cursos en los que ya está matriculado el alumno
        $cursosMatriculados = Matriculacion::where('alumno_id', $alumno->id)
                                           ->pluck('curso_id')
                                           ->toArray();
    
        // Obtener todos los cursos (tanto matriculados como disponibles)
        $cursos = Curso::all();
    
        // Obtener todas las asignaturas con paginación
        $asignaturas = Asignatura::paginate(10);
    
        // Pasar los cursos matriculados y todos los cursos a la vista
        return view('admin.matriculaciones.create', compact('alumno', 'cursos', 'asignaturas', 'cursosMatriculados'));
    }
    
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'alumno_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
            'asignaturas' => 'required|array',
            'fecha' => 'required|date',
        ]);
    
        // Verificar si ya existe una matrícula para ese alumno y curso
        $matriculacion = Matriculacion::where('alumno_id', $request->alumno_id)
                                      ->where('curso_id', $request->curso_id)
                                      ->first();
    
        // Si no existe matrícula, crear una nueva
        if (!$matriculacion) {
            $matriculacion = Matriculacion::create([
                'alumno_id' => $request->alumno_id,
                'curso_id' => $request->curso_id,
                'nombre_asignatura' => json_encode($request->asignaturas), // Crear un nuevo JSON
                'fecha' => $request->fecha,
            ]);
        } else {
            // Si ya existe matrícula, obtener las asignaturas actuales
            $currentAsignaturas = json_decode($matriculacion->nombre_asignatura, true);
    
            // Combinar las asignaturas actuales con las nuevas seleccionadas, asegurándonos de que no haya duplicados
            $updatedAsignaturas = array_merge($currentAsignaturas, $request->asignaturas);
            $updatedAsignaturas = array_unique($updatedAsignaturas); // Eliminar posibles duplicados
    
            // Actualizar la matrícula con las asignaturas combinadas
            $matriculacion->nombre_asignatura = json_encode($updatedAsignaturas);
            $matriculacion->fecha = $request->fecha; // También podemos actualizar la fecha si es necesario
            $matriculacion->save();
        }
    
        // Redirigir con mensaje de éxito y al perfil del alumno
        return redirect()->route('admin.users.show', $request->alumno_id)
                         ->with('success', 'Matrícula actualizada correctamente');
    }
    
    
    

  
public function update(Request $request, $id)
{
    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
        'nombre_asignatura' => 'required|array',
        'nombre_asignatura.*' => 'exists:asignaturas,nombre',  // Asegura que cada asignatura sea válida
        'fecha' => 'required|date',
    ]);
    
    $matriculacion = Matriculacion::find($id);
    
    if (!$matriculacion) {
        return redirect()->route('admin.matriculaciones.index')->with('error', 'Matrícula no encontrada.');
    }
    
    // Actualizar los datos de la matrícula
    $matriculacion->curso_id = $request->curso_id;
    $matriculacion->nombre_asignatura = json_encode($request->nombre_asignatura);
    $matriculacion->fecha = $request->fecha;
    
    // Guardar la matrícula actualizada
    $matriculacion->save();
    
    return redirect()->route('admin.matriculaciones.index')->with('success', 'Matrícula actualizada correctamente.');
}


 

public function borrarAsignaturas(Request $request, $userId)
{
    // Validar que se han enviado asignaturas
    $request->validate([
        'asignaturas' => 'required|array',
    ]);

    // Obtener el usuario
    $user = User::findOrFail($userId);

    // Obtener las matriculaciones del alumno
    $matriculaciones = DB::table('matriculacions')
        ->where('alumno_id', $user->id)
        ->get();

    foreach ($matriculaciones as $matriculacion) {
        // Decodificar el JSON de la columna nombre_asignatura
        $asignaturas = json_decode($matriculacion->nombre_asignatura, true);

        // Verificar si la decodificación fue exitosa
        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->route('admin.matriculaciones.index', $user->id)
                ->with('error', 'Error al procesar las asignaturas.');
        }

        // Filtrar las asignaturas para eliminar las que se recibieron en la solicitud
        $asignaturas = array_diff($asignaturas, $request->asignaturas);

        // Si hay asignaturas restantes, volver a codificar y actualizar el registro
        if (!empty($asignaturas)) {
            $nuevoJson = json_encode(array_values($asignaturas));

            DB::table('matriculacions')
                ->where('id', $matriculacion->id)
                ->update(['nombre_asignatura' => $nuevoJson]);
        } else {
            // Si no quedan asignaturas, eliminar el registro completo
            DB::table('matriculacions')
                ->where('id', $matriculacion->id)
                ->delete();
        }
    }

    // Redireccionar con un mensaje de éxito
    return redirect()->route('admin.matriculaciones.index', $user->id)
        ->with('success', 'Asignaturas eliminadas correctamente.');
}





}