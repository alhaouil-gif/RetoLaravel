@extends('adminlte::page')

@section('content')


<form action="{{ route('asignaturas.update', $asignatura) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $asignatura->nombre) }}" required>
        @error('nombre')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn mb-3" style="background-color: #3cb4e5; color: white;">Actualizar</button>
    <a href="{{ route('admin.asignaturas.index') }}" class="btn mb-3" style="background-color:rgb(96, 98, 99); color: white;">Cancelar</a>
</form>
@endsection
