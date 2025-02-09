<?php

namespace App\Http\Controllers\API;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\Reunion;
use Illuminate\Http\Request;

class ReunionController extends Controller
{
/*http://localhost/api/reunion/1/estado usa pach porque es un modificacion partcial */ 
/**
 * @OA\Patch(
 *     path="/api/reunion/{id}/estado",
 *     summary="Actualizar estado de la reunión",
 *     operationId="actualizarEstadoReunion",
 *     tags={"Reuniones"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la reunión a actualizar",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Estado de la reunión",
 *         @OA\JsonContent(
 *             required={"estado"},
 *             @OA\Property(
 *                 property="estado",
 *                 type="string",
 *                 enum={"pendiente", "aceptada", "rechazada"},
 *                 description="Estado al que se cambiará la reunión"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estado de la reunión actualizado correctamente"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud incorrecta (estado no válido)"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Reunión no encontrada"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     )
 * )
 */
    public function actualizarEstado(Request $request, $id)
    {
        // Validar la entrada
        $request->validate([
            'estado' => 'required|in:pendiente,aceptada,rechazada',
        ]);
    
        // Buscar la reunión
        $reunion = Reunion::findOrFail($id);
         // Actualizar el estado
        $reunion->estado = $request->estado;
        $reunion->save();
    
        return response()->json(['message' => 'Estado actualizado correctamente']);
    }
    

}