<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioFactory> */
    use HasFactory;
    protected $fillable = ['usuario_id'];

    // Relación con el modelo User (Profesor o Alumno)
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación muchos a muchos con Asignatura
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'horarios_asignaturas', 'horario_id', 'asignatura_id');
    }
}
