@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Ciclo</h1>

    <form action="{{ route('admin.ciclos.update', $ciclo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Ciclo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $ciclo->nombre }}" required>
        </div>

        <button type="submit" class="btn mb-3" style="background-color: #3cb4e5; color: white;">Actualizar</button>
        <a href="{{ route('admin.ciclos.index') }}" class="btn mb-3" style="background-color:rgb(96, 98, 99); color: white;">Cancelar</a>
    </form>
</div>
@endsection
