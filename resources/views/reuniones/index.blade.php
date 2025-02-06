@extends('layouts.app')

@section('content')
    <h1>Listado de Reuniones</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('reuniones.create') }}" class="btn btn-primary">Solicitar Reunión</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Profesor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reuniones as $reunion)
                <tr>
                    <td>{{ $reunion->id }}</td>
                    <td>{{ $reunion->alumno->name }}</td>
                    <td>{{ $reunion->profesor->name }}</td>
                    <td>{{ $reunion->fecha }}</td>
                    <td>{{ $reunion->hora_formatted }}</td>
                    <td>{{ ucfirst($reunion->estado) }}</td>
                    <td>
                        <a href="{{ route('reuniones.edit', $reunion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('reuniones.destroy', $reunion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
