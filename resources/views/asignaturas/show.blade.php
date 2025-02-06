@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles de la Asignatura</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: {{ $asignatura->nombre }}</h5></br></br></br>
            <a href="{{ route('admin.asignaturas.index') }}" class="btn mb-3" style="background-color:rgb(96, 98, 99); color: white;">Volver</a>
            <a href="{{ route('asignaturas.edit', $asignatura->id) }}" class="btn mb-3" style="background-color: #3cb4e5; color: white;">Editar</a>
        </div>
    </div>
</div>
@endsection
