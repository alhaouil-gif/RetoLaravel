<?php

 
namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Curso;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Muestra una lista de todas las asignaturas.
     */
    public function index()
    {
        // Obtener todas las asignaturas comunes con sus cursos
        $asignaturasComunes = Asignatura::where('es_comun', 1)
                                        ->with('cursos')
                                        ->get()
                                        ->groupBy('nombre'); // Agrupar por nombre
    
        // Procesar las asignaturas comunes para evitar duplicados
        $asignaturasComunesProcesadas = [];
        foreach ($asignaturasComunes as $nombre => $asignaturas) {
            $cursosAsociados = $asignaturas->flatMap(function ($asignatura) {
                return $asignatura->cursos->pluck('nombre');
            })->unique()->values();
    
            $asignaturasComunesProcesadas[] = [
                'id' => $asignaturas->first()->id, // Usar el ID de la primera asignatura del grupo
                'nombre' => $nombre,
                'cursos_asociados' => $cursosAsociados,
                'es_comun' => true, // Marcar como asignatura común
            ];
        }
    
        // Obtener las asignaturas no comunes con sus cursos
        $asignaturasNoComunes = Asignatura::where('es_comun', 0)
                                          ->with('cursos')
                                          ->get()
                                          ->map(function ($asignatura) {
                                              return [
                                                  'id' => $asignatura->id,
                                                  'nombre' => $asignatura->nombre,
                                                  'cursos_asociados' => $asignatura->cursos->pluck('nombre'),
                                                  'es_comun' => false, // Marcar como asignatura no común
                                              ];
                                          });
    
        // Combinar asignaturas comunes y no comunes
        $asignaturas = collect($asignaturasComunesProcesadas)->concat($asignaturasNoComunes);
    
        // Paginación manual
        $porPagina = 10; // Número de asignaturas por página
        $page = request()->get('page', 1); // Página actual
        $offset = ($page - 1) * $porPagina; // Desplazamiento
        $asignaturasPaginadas = $asignaturas->slice($offset, $porPagina); // Obtener las asignaturas para la página actual
        $totalAsignaturas = $asignaturas->count(); // Total de asignaturas
    
        // Crear un objeto LengthAwarePaginator para la paginación
        $asignaturasPaginadas = new \Illuminate\Pagination\LengthAwarePaginator(
            $asignaturasPaginadas,
            $totalAsignaturas,
            $porPagina,
            $page,
            [
                'path' => request()->url(), // Ruta base para la paginación
                'query' => request()->query(), // Parámetros de la URL
            ]
        );
    
        // Pasar los datos a la vista
        return view('asignaturas.index', [
            'asignaturasPaginadas' => $asignaturasPaginadas,
        ]);
    }
    
    
    
    /**
     * Muestra el formulario para crear una nueva asignatura.
     */
    public function create()
    {
        $cursos = Curso::all(); // Obtener todos los cursos disponibles
        return view('asignaturas.create', compact('cursos'));
    }

    /**
     * Guarda una nueva asignatura en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255|unique:asignaturas',
            'curso_id' => 'required|array', // Se espera un array de IDs de cursos
            'es_comun' => 'boolean'
        ]);
    
        // Crear la asignatura
        // Se toma el primer curso del array como curso predeterminado para el campo 'curso_id'
        $asignatura = Asignatura::create([
            'nombre'   => $request->nombre,
            'es_comun' => $request->es_comun ?? 0,
            'curso_id' => $request->curso_id[0] ?? null,
        ]);
    
        // Asociar la asignatura con todos los cursos seleccionados a través de la relación n-m.
        // Se asume que la relación está definida en el modelo Asignatura (por ejemplo, en el método cursos())
        $asignatura->cursos()->attach($request->curso_id);
    
        return redirect()->route('admin.asignaturas.index')
                         ->with('success', 'Asignatura creada exitosamente.');
    }
    
    
    

    
    
    
    

    /**
     * Muestra los detalles de una asignatura específica.
     */
    public function show(Asignatura $asignatura)
    {  
        return view('asignaturas.show', compact('asignatura'));
    }
    

    /**
     * Muestra el formulario para editar una asignatura.
     */
    public function edit(Asignatura $asignatura)
    {
         return view('asignaturas.edit', compact('asignatura',  ));
    }

    /**
     * Actualiza la información de una asignatura en la base de datos.
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        // Validar solo el nombre, ignorando el registro actual para la regla de unicidad
        $request->validate([
            'nombre' => 'required|string|max:255|unique:asignaturas,nombre,' . $asignatura->id,
        ]);
    
        // Guardar el nombre actual (antes de actualizar)
        $oldName = $asignatura->nombre;
        $newName = $request->nombre;
    
        // Actualizar en masa todas las asignaturas que tengan el mismo nombre que el actual
        Asignatura::where('nombre', $oldName)->update([
            'nombre' => $newName,
        ]);
    
        return redirect()->route('admin.asignaturas.index')
                         ->with('success', 'Asignatura(s) actualizada(s) correctamente.');
    }
    
    

    /**
     * Elimina una asignatura de la base de datos.
     */
    public function destroy(Asignatura $asignatura)
    {
        // Guardamos el nombre actual
        $oldName = $asignatura->nombre;
    
        // Eliminar todas las asignaturas que tengan el mismo nombre
        Asignatura::where('nombre', $oldName)->delete();
    
        return redirect()->route('admin.asignaturas.index')
                         ->with('success', 'Asignatura(s) eliminada(s) correctamente.');
    }
    
}

