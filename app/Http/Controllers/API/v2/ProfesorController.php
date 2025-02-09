<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfesorController extends Controller




/**
 * @OA\Get(
 *     path="/api/v2.0/profesor/{id}/horario",
 *     summary="Obtener el horario de un profesor (versión 2.0)",
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

{
    public function obtenerVersion()
    {
        return response()->json([
            'message' => 'Estamos en la versión 2.0',' se podria implimentar el mismo metodo aqui que el controlador vesion 1'
        ]);
    }
}
