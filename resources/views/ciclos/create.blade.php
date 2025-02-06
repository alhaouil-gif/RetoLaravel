@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Crear Nuevo Ciclo</h1>

    <form action="{{ route('admin.ciclos.store') }}" method="POST">
        @csrf

        <!-- Campo para el nombre del ciclo -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Ciclo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <h3>Cursos Asociados</h3>

        <!-- Campos para los cursos -->
        <div class="mb-3">
            <label for="curso_primero" class="form-label">Nombre del Primer Curso</label>
            <input type="text" name="cursos[]" id="curso_primero" class="form-control" value="Primero " required>
        </div>

        <div class="mb-3">
            <label for="curso_segundo" class="form-label">Nombre del Segundo Curso</label>
            <input type="text" name="cursos[]" id="curso_segundo" class="form-control" value="Segundo " required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.ciclos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
