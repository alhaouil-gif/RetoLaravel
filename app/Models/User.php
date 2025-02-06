<?php

namespace App\Models;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles; 

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory,HasRoles, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'dni', 'apellido', 'direccion',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'usuario_id');
    }

    public function matriculaciones()
    {
        return $this->hasMany(Matriculacion::class, 'alumno_id');
    }

    public function reuniones()
    {
        return $this->hasMany(Reunion::class, 'alumno_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function adminlte_image(){

        return 'https://picsum.photos/300/300';
    }
    public function adminlte_desc()
{
    // Obtener el rol del usuario
    $role = auth()->user()->role;

    // Definir descripciones para diferentes roles
    switch ($role) {
        case 'administrador':
            return 'Administrador del sistema';
        case 'secretario':
            return 'Personal de secretaria, responsable de gestionar usuarios';
        case 'profesor':
            return 'Profesor, responsable de gestionar clases y horarios';
        case 'alumno':
            return 'Estudiante, usuario que accede a la información académica';
        default:
            return 'Rol desconocido';
    }
}

}
