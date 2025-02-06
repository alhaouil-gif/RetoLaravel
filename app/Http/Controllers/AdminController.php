<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use App\Models\Matriculacion;
use App\Models\Ciclo;
use App\Models\Reunion;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
   public function dashboard(Request $request)
{
    $type = $request->query('type', '');  
    // Número de alumnos totales matriculados
    $totalStudents = User::role('alumno')->count();

    // Número de personal del instituto (profesores + administrativos)
    $totalStaff = User::role('profesor')->count();

    // Número de reuniones aceptadas para el día de hoy
    $todayAcceptedMeetings = Reunion::whereDate('fecha', Carbon::today())
        ->where('estado', 'aceptada')
        ->count();

    // Número de reuniones pendientes para el día de hoy
    $todayPendingMeetings = Reunion::whereDate('fecha', Carbon::today())
        ->where('estado', 'pendiente')
        ->count();

    // Número de reuniones totales a partir del día de hoy
    $futureMeetings = Reunion::whereDate('fecha', '>=', Carbon::today())->count();

    // Número de ciclos formativos
    $totalCycles = Ciclo::count();

    // Número de usuarios sin rol asignado (usando Spatie)
    $usersWithoutRole = User::doesntHave('roles')->count();

    // Número de asignaturas
    $totalSubjects = Asignatura::count();

    // Pasar los datos a la vista
    return view('admin.dashboard', compact(
        'type',
        'totalStudents',
        'totalStaff',
        'todayAcceptedMeetings',
        'todayPendingMeetings',
        'futureMeetings',
        'totalCycles',
        'usersWithoutRole',
        'totalSubjects'
    ));
}

    public function createUser()
    {
        $ciclos = Ciclo::all();
        $cursosPorCiclo = Curso::all()->groupBy('ciclo_id');
        $ciclosConNombre = $ciclos->mapWithKeys(function ($ciclo) {
            return [$ciclo->id => $ciclo->nombre];
        });
    
        return view('admin.create', [
            'user' => null, // No hay usuario porque es creación
            'cursosDisponibles' => [],
            'ciclosConNombre' => $ciclosConNombre,
            'cursosPorCiclo' => $cursosPorCiclo,
        ]);
    }
    
 
       
    
    public function storeUser(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8', // La contraseña ahora es opcional
            'role' => 'required|in:alumno,profesor,administrador',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Foto opcional
            'dni' => 'nullable|string|max:255',  // DNI opcional
            'apellido' => 'nullable|string|max:255',  // Apellido opcional
            'direccion' => 'nullable|string|max:255',  // Dirección opcional
            'ciclo_id' => 'nullable|exists:ciclos,id', // Solo para alumnos
        ]);
    
        // Si no se proporciona una contraseña, se asigna una predeterminada
        $password = $request->password ? Hash::make($request->password) : Hash::make('12345678');
    
        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'foto' => $request->foto ?? 'default_foto',   
            'dni' => $request->dni ?? 'default_dni',  
            'apellido' => $request->apellido ?? 'default_apellido',   
            'direccion' => $request->direccion ?? 'default_direccion',   
        ]);
    
        // Asignar el rol seleccionado
        $user->assignRole($request->role);
    
        // Lógica condicional según el rol seleccionado
        if ($request->role == 'alumno') {
            // Lógica para asignar el curso al alumno (si el rol es 'alumno')
            $this->assignStudentCourse($user);
        } elseif ($request->role == 'profesor') {
            // Lógica para profesores (por ejemplo, asignar asignaturas, etc.)
            $this->assignProfessorSubjects($user);
        } elseif ($request->role == 'administrador') {
            // Lógica para administradores (puedes añadir campos o funcionalidades adicionales)
            $this->assignAdministratorPermissions($user);
        }
    
        // Redirigir con mensaje de éxito
     return back()->with 
        ('success', 'Usuario creado con éxito.');
    }
    /******************************************************************************************************************************* */
    public function assignStudentCourse($user)
    {
         $cicloId = request()->input('ciclo_id');

         $ciclo = Ciclo::where('id', $cicloId)->first();         
         $cursos = Curso::where('ciclo_id', $ciclo->id)->get();
    
        $cursoPrimero = $cursos->where('nombre', 'Primero ' . $ciclo->nombre)->first();
        $cursoSegundo = $cursos->where('nombre', 'Segundo ' . $ciclo->nombre)->first();
    
        if ($cursoPrimero) {
            
             $asignaturasPrimero = Asignatura::where('curso_id', $cursoPrimero->id)->get();
    
             $matriculacion = Matriculacion::create([
                'alumno_id' => $user->id,
                'curso_id' => $cursoPrimero->id,
                 'nombre_asignatura' => json_encode($asignaturasPrimero->pluck('nombre')), 
                'fecha' => now()->toDateString(),
            ]);
    
          
        }
    
         if ($cursoSegundo) {
            $asignaturasSegundo = Asignatura::where('curso_id', $cursoSegundo->id)->get();
    
            Matriculacion::create([
                'alumno_id' => $user->id,
                'curso_id' => $cursoSegundo->id,
                'nombre_asignatura' => json_encode($asignaturasSegundo->pluck('nombre')), // Asignaturas del curso
                'fecha' => now()->toDateString(),
            ]);
    
          
        }










        
    }
    
    public function reunionesPendientes()
    {
        $reuniones = Reunion::where('estado', 'pendiente')->get();
        return view('admin.reunionesPendientes', compact('reuniones'));
    }

    public function reunionesAceptadas()
    {
        $reuniones = Reunion::where('estado', 'aceptada')->get();
        return view('admin.reunionesAceptadas', compact('reuniones'));
    }

    public function reunionesRechazadas()
    {
        $reuniones = Reunion::where('estado', 'rechazada')->get();
        return view('admin.reunionesRechazada', compact('reuniones'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate(['estado' => 'required|in:aceptada,rechazada']);

        $reunion = Reunion::findOrFail($id);
        $reunion->estado = $request->estado;
        $reunion->save();

        // Redirigir a la lista de reuniones con un mensaje de éxito
        return redirect()->route('admin.reuniones.pendientes')->with('success', 'Estado actualizado correctamente.');
    }






    public function showUsersWithoutRole()
    {
        // Obtiene el total de usuarios sin rol
        $usersWithoutRoleCount = User::whereDoesntHave('roles')->count();
    
        return view('admin.SinRol', compact('usersWithoutRoleCount'));
    }
}
