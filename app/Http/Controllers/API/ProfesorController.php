<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 //...
/**
* @OA\Info(title="API", version="1.0"),
* @OA\SecurityScheme(
*     in="header",
*     scheme="bearer",
*     bearerFormat="JWT",
*     securityScheme="bearerAuth",
*     type="http",
* ),
*/
class ProfesorController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/v1.0/profesor/{id}/horario",
 *     summary="Obtener el horario de un profesor (versión 1.0)",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del profesor",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Horario obtenido correctamente"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Profesor no encontrado"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * )
 */




 public function obtenerHorario($id)
 {
     // Validar el id usando el validador
     $validator = Validator::make(['id' => $id], [
         'id' => 'required|exists:users,id',
     ]);
 
     // Si la validación falla, devolver un error
     if ($validator->fails()) {
         return response()->json([
             'error' => 'Usuario no encontrado o ID no válido.'
         ], 404);
     }
 
     // Buscar al profesor por su ID
     $profesor = User::find($id);
 
     // Verificar si el usuario tiene el rol de profesor
     if (!$profesor->hasRole('profesor')) {
         return response()->json(['error' => 'El usuario no es un profesor.'], 403);
     }
 
     // Obtener los horarios del profesor con paginación usando el valor de .env
     $horarios = $profesor->horarios()->select('id', 'usuario_id', 'dia', 'hora', 'horalibre')
         ->paginate(env('PAGINATION_COUNT', 10));  // 10 es el valor por defecto si no está configurado
 
     // Devolver la respuesta en formato JSON con los horarios obtenidos y paginación
     return response()->json([
         'profesor' => [
             'id' => $profesor->id,
             'name' => $profesor->name,
             'email' => $profesor->email,
         ],
         'horarios' => $horarios,
         'pagination' => [
             'total' => $horarios->total(),
             'per_page' => $horarios->perPage(),
             'current_page' => $horarios->currentPage(),
             'last_page' => $horarios->lastPage(),
         ]
     ]);
 }
 

   
}