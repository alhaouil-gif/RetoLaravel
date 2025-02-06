@extends('adminlte::page')

@section('title', 'Horarios')

@section('content_header')
    <h1>Horarios del Profesor</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($hora = 1; $hora <= 6; $hora++)
                        <tr>
                            <td class="fw-bold">Hora {{ $hora }}</td>
                            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                                <td class="{{ $tablaHorarios[$dia][$hora] === 'HORA LIBRE' ? 'table-warning' : '' }}">
                                    {{ $tablaHorarios[$dia][$hora] }}
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop
