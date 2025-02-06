<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    /** @use HasFactory<\Database\Factories\AsignaturaFactory> */
    use HasFactory;
    protected $fillable = ['nombre', 'curso_id', 'es_comun'];

    // Relación muchos a muchos con Horario
    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'horarios_asignaturas', 'asignatura_id', 'horario_id');
    }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'asignatura_curso');
    }
}
