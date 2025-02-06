@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Reuniones Pendientes</h2>

    <table class="table table-bordered">
        <thead style="background-color: #211261; color: white;">
            <tr>
                <th>Alumno</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reuniones as $reunion)
            <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                <td>{{ $reunion->alumno->name }}</td>
                <td>{{ \Carbon\Carbon::parse($reunion->fecha)->format('d-m-y') }}</td>
                <td>{{ $reunion->hora }}</td>
                <td>
                    <span class="badge {{ $reunion->estado == 'aceptada' ? 'badge-success' : ($reunion->estado == 'rechazada' ? 'badge-danger' : 'badge-warning') }}">
                        {{ ucfirst($reunion->estado) }}
                    </span>
                </td>
                <td>
                    @if($reunion->estado == 'pendiente')
                    <form method="POST" action="{{ route('admin.reuniones.actualizar', $reunion->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" name="estado" value="aceptada" class="btn btn-success btn-sm">Aceptar</button>
                    </form>
                    <form method="POST" action="{{ route('admin.reuniones.actualizar', $reunion->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" name="estado" value="rechazada" class="btn btn-danger btn-sm">Rechazar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
