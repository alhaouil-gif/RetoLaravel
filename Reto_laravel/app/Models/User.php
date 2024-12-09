<?php

// app/Models/User.php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable

{
    use HasRoles;

    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'rol_id'];

    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }
}
