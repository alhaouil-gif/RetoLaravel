<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Curso;
use App\Models\Ciclo;

use App\Models\Matriculacion;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $type = $request->input('type', 'alumnos'); // Por defecto, muestra alumnos

    if ($type === 'alumnos') {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'alumno');
        })->paginate(10)->appends(['type' => 'alumnos']);
    } else {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'alumno');
        })->paginate(10)->appends(['type' => 'no-alumnos']);
    }

    return view('admin.index', compact('users', 'type'));
}

    
    
    

    

    public function edit($id)
    {
        $user = User::findOrFail($id);
    
        // Obtener las matriculaciones del usuario
        $matriculaciones = Matriculacion::where('alumno_id', $id)->get();
    
        // Si el usuario no tiene matriculaciones, no pasamos los ciclos ni cursos a la vista
        $ciclosConNombre = [];
        $cursosPorCiclo = [];
    
        if ($matriculaciones->isNotEmpty()) {
            $ciclos = Ciclo::all()->pluck('nombre', 'id');
            $cursosPorCiclo = Curso::with('ciclo')->get()->groupBy('ciclo_id');
    
            $ciclosConNombre = $ciclos;
        }
    
        return view('admin.create', compact('user', 'ciclosConNombre', 'cursosPorCiclo'));
    }
    
    
    

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:alumno,profesor,administrador',
            'dni' => 'nullable|string|max:20',
            'apellido' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->dni = $validated['dni'] ?? null;
        $user->apellido = $validated['apellido'] ?? null;
        $user->direccion = $validated['direccion'] ?? null;

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        $user->syncRoles($validated['role']);
        $matriculacion = Matriculacion::where('alumno_id', $user->id)->first();

        $cursoId = $validated['curso_id'];

        if ($cursoId) {
            $asignaturasSegundo = Asignatura::where('curso_id', $cursoId)->get(); // Recuperar asignaturas
            if ($matriculacion) {
                $matriculacion->update([
                    'alumno_id' => $user->id,
                    'curso_id' => $cursoId,
                    'nombre_asignatura' => json_encode($asignaturasSegundo->pluck('nombre')),
                    'fecha' => now()->toDateString(),
                ]);
            }
        }

        return back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public function show(Request $request, $id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);
        $type = $request->query('type', ''); // Si no hay 'type' en la URL, se define como vacío

        // Obtener las matriculaciones del alumno
        $matriculaciones = Matriculacion::where('alumno_id', $id)->get();
        $datosAgrupados = [];
    
        foreach ($matriculaciones as $matriculacion) {
            $curso = Curso::find($matriculacion->curso_id);
    
            if ($curso) {
                $ciclo = Ciclo::find($curso->ciclo_id);
                $asignaturasJson = json_decode($matriculacion->nombre_asignatura, true) ?? [];
    
                if ($ciclo) {
                    $datosAgrupados[$ciclo->nombre][$curso->nombre] = $asignaturasJson;
                }
            }
        }
    
        // Obtener el rol del usuario con el ID recibido
        $role = $user->getRoleNames()->first();  // Obtiene el primer rol del usuario asociado al ID
    
      
        // Pasamos el rol del usuario y el usuario a la vista
        return view('admin.show', compact('user', 'datosAgrupados', 'type'));
    }
    
    




   
    
 









}