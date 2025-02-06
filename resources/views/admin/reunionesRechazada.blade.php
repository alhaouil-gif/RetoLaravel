@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Reuniones Rechazadas</h2>

    <table class="table table-bordered">
        <thead style="background-color: #211261; color: white;">
            <tr>
                <th>Alumno</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reuniones as $reunion)
            <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                <td>{{ $reunion->alumno->name }}</td>
                <td>{{ \Carbon\Carbon::parse($reunion->fecha)->format('d-m-y') }}</td>
                <td>{{ $reunion->hora }}</td>
                <td>
                    <span class="badge badge-danger">
                        {{ ucfirst($reunion->estado) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
