@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Solicitar Reunión</h2>

    <form method="POST" action="{{ route('alumno.solicitar_reunion.post') }}">
        @csrf
        <label for="profesor_id">Selecciona un profesor:</label>
        <select name="profesor_id" required>
            @foreach($profesores as $profesor)
                <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
            @endforeach
        </select>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="hora">Hora (1-6):</label>
        <input type="number" name="hora" min="1" max="6" required>

        <button type="submit">Solicitar</button>
    </form>
</div>
@endsection
