<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosAsignatura extends Model
{
    /** @use HasFactory<\Database\Factories\HorariosAsignaturaFactory> */
    use HasFactory;

    protected $table = 'horarios_asignaturas';
    protected $fillable = ['horario_id', 'asignatura_id'];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
