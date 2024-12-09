<?php

// app/Models/Matriculacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriculacion extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id', 'curso_id', 'fecha'];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
