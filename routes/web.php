<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\MatriculacionController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\HorarioController;


use Illuminate\Support\Facades\Route;

// Rutas de autenticación
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
// Ruta principal del administrador
Route::middleware(['auth', 'role:superadministrador|administrador'])->group(function () {
 
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/alumno', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


Route::post('/admin/reuniones/{id}/actualizar', [AdminController::class, 'actualizarEstado'])->name('admin.reuniones.actualizar');
Route::get('/admin/reuniones/pendientes', [AdminController::class, 'reunionesPendientes'])->name('admin.reuniones.pendientes');
Route::get('/admin/reuniones/aceptadas', [AdminController::class, 'reunionesAceptadas'])->name('admin.reuniones.aceptadas');
Route::get('/admin/reuniones/rechazadas', [AdminController::class, 'reunionesRechazadas'])->name('admin.reuniones.rechazadas');
  
  Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('matriculaciones', [MatriculacionController::class, 'index'])->name('matriculaciones.index'); // Listar
    Route::get('matriculaciones/create/{user}', [MatriculacionController::class, 'create'])->name('matriculaciones.create'); // Crear
    Route::post('matriculaciones', [MatriculacionController::class, 'store'])->name('matriculaciones.store'); // Guardar
    Route::get('matriculaciones/{matriculacion}', [MatriculacionController::class, 'show'])->name('matriculaciones.show'); // Ver detalle
    Route::get('matriculaciones/{matriculacion}/edit', [MatriculacionController::class, 'edit'])->name('matriculaciones.edit'); // Editar
    Route::put('matriculaciones/{matriculacion}', [MatriculacionController::class, 'update'])->name('matriculaciones.update'); // Actualizar
    Route::delete('matriculaciones/{matriculacion}', [MatriculacionController::class, 'destroy'])->name('matriculaciones.destroy'); // Eliminar

    Route::get('admin/usuarios-sin-rol', [AdminController::class, 'showUsersWithoutRole'])
    ->name('admin.SinRol');

});

Route::put('/admin/matriculaciones/{user}/borrar-asignaturas', 
    [MatriculacionController::class, 'borrarAsignaturas']
)->name('admin.matriculaciones.borrarAsignaturas');

 
   
     Route::resource('reuniones', ReunionController::class)->except(['show']);

   

    Route::resource('ciclos', CicloController::class);
    Route::resource('asignaturas', AsignaturaController::class);


});



Route::get('/horarios/{userId}', [HorarioController::class, 'mostrarHorarios'])->name('mostrarHorarios');
Route::post('/horarios/agregar/{userId}', [HorarioController::class, 'agregarHorario'])->name('agregarHorario');
Route::put('/horarios/editar/{horarioId}', [HorarioController::class, 'editarHorario'])->name('editarHorario');
 
// Ruta para asignar los horarios
 
// Ruta para mostrar los horarios
Route::get('/horarios/{alumnoId}', [HorarioController::class, 'asignarHorarios'])->name('horarios.index');

 Route::get('/get-horarios-por-curso/{cursoId}', [HorarioController::class, 'getHorariosPorCurso']);

 
 


 Route::resource('ciclos', CicloController::class)->names([
    'index' => 'admin.ciclos.index',
    'create' => 'admin.ciclos.create',
    'store' => 'admin.ciclos.store',  // Ruta para crear ciclo
    'show' => 'admin.ciclos.show',
    'edit' => 'admin.ciclos.edit',
    'update' => 'admin.ciclos.update',
    'destroy' => 'admin.ciclos.destroy',
])->middleware('role:superadministrador'); 




// Ruta principal del profesor

    Route::middleware(['auth', 'role:profesor'])->group(function () {
    
        Route::get('/profesor/dashboard', [ProfesorController::class, 'dashboard'])->name('profesor.dashboard');
        Route::get('/profesor/horarios', [ProfesorController::class, 'horarios'])->name('profesor.horarios.index');
        Route::get('/profesor/profesores', [ProfesorController::class, 'index'])->name('profesor.profesores.index');


        Route::get('/reuniones/profesor', [ReunionController::class, 'reunionesProfesor'])->name('profesor.reuniones');
        Route::post('/reuniones/{id}/actualizar', [ReunionController::class, 'actualizarEstado'])->name('profesor.reuniones.actualizar');
});







// Ruta principal del alumno
Route::middleware(['auth', 'role:alumno'])->group(function () {


    Route::get('/alumno/asignaturas', [AlumnoController::class, 'show'])->name('alumno.asignaturas');

    Route::get('/alumno/dashboard', [AlumnoController::class, 'dashboard'])->name('alumno.dashboard');

    Route::get('/reuniones/solicitar', [ReunionController::class, 'mostrarProfesores'])->name('alumno.solicitar_reunion');
    Route::post('/reuniones/solicitar', [ReunionController::class, 'solicitarReunion'])->name('alumno.solicitar_reunion.post');
    Route::get('/reuniones', [ReunionController::class, 'reunionesAlumno'])->name('alumno.reuniones');
});

// Rutas para   matriculaciones, usuarios, reuniones, asignaturas, y ciclos
Route::resource('matriculaciones', MatriculacionController::class)->names([
    'index' => 'admin.matriculaciones.index',
])->middleware(['role:superadministrador|administrador']);

Route::resource('users', UserController::class)->names([
    'index' => 'admin.users.index',
])->middleware(['role:superadministrador|administrador']);



Route::resource('asignaturas', AsignaturaController::class)->names([
    'index' => 'admin.asignaturas.index',
])->middleware(['role:superadministrador|administrador']);




