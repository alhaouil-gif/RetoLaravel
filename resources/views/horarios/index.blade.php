@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Horarios</h2>

    @if($horarios->isEmpty())
        <p>No tienes horarios asignados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Asignatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $horario)
                    <tr>
                        <td>{{ ucfirst($horario->dia) }}</td>
                        <td>{{ $horario->hora }}</td>
                        <td>{{ $horario->asignatura->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
