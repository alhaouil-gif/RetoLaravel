<?php
// app/Models/Reunione.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunione extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id', 'profesor_id', 'fecha', 'estado'];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
}
