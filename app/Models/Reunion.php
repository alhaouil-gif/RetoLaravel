<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id', 'profesor_id', 'estado', 'fecha', 'hora'];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function getHoraFormattedAttribute()
    {
        $horas = [
            1 => 'Primera',
            2 => 'Segunda',
            3 => 'Tercera',
            4 => 'Cuarta',
            5 => 'Quinta',
            6 => 'Sexta',
        ];
        return $horas[$this->hora] ?? 'Desconocida';
    }
}
