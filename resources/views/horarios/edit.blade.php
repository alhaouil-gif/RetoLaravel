@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Horario</h2>
    <form action="{{ route('horarios.update') }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Hora/Día</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                @foreach(range(1, 6) as $hora)
                    <tr>
                        <td>Hora {{ $hora }}</td>
                        @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes'] as $dia)
                            <td>
                                <select name="horario[{{ $dia }}][{{ $hora }}]" class="form-control">
                                    <option value="">-- Seleccionar --</option>
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{ $asignatura }}">{{ $asignatura }}</option>
                                    @endforeach
                                    <option value="Tutoria">Tutoría</option>
                                    <option value="Reunion">Reunión</option>
                                </select>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection
