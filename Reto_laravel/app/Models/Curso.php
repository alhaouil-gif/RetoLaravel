<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'usuario_id'];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'curso_id');
    }
}
