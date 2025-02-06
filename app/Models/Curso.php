<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ciclo_id'];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_curso');
    }
    public function matriculaciones()
    {
        return $this->hasMany(Matriculacion::class);
    }
    
}
