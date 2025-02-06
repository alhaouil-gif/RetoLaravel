<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturaCurso extends Model
{
    /** @use HasFactory<\Database\Factories\AsignaturaCicloFactory> */
    use HasFactory;
    protected $fillable = ['asignatura_id', 'curso_id'];
 
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    } 
}
/****** */
