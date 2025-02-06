@extends('layouts.app')

@section('content')
    <h1>Solicitar Reunión</h1>

    <form action="{{ route('reuniones.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="profesor_id">Profesor:</label>
            <select name="profesor_id" id="profesor_id" class="form-control">
                @foreach ($profesores as $profesor)
                    <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora:</label>
            <select name="hora" class="form-control" required>
                <option value="1">Primera</option>
                <option value="2">Segunda</option>
                <option value="3">Tercera</option>
                <option value="4">Cuarta</option>
                <option value="5">Quinta</option>
                <option value="6">Sexta</option>
            </select>
        </div>

        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Solicitar</button>
    </form>
@endsection
