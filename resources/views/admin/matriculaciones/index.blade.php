@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Matriculaciones</h1>

    <!-- Botón para crear una nueva matrícula -->
    <a href="{{ route('admin.matriculaciones.create', ['user' => Auth::id()]) }}" class="btn mb-3" style="background-color: #3cb4e5; color: white;">
        Nueva Matrícula
    </a>

    @if($matriculaciones->isEmpty())
        <p>No hay matriculaciones registradas.</p>
    @else
        <table class="table table-bordered">
            <thead style="background-color: #211261; color: white;">
                <tr>
                    <th>Alumno</th>
                    <th>Curso</th>
                    <th>Asignaturas</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matriculaciones as $matriculacion)
                <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                    <td>{{ $matriculacion->alumno->name ?? 'N/A' }}</td>
                    <td>{{ $matriculacion->curso->nombre ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#asignaturas-{{ $matriculacion->id }}" aria-expanded="false" aria-controls="asignaturas-{{ $matriculacion->id }}" style="display: block; margin: 0 auto;">
                            Ver Asignaturas
                        </button>
                        <div class="collapse" id="asignaturas-{{ $matriculacion->id }}">
                            @php
                                $asignaturas = json_decode($matriculacion->nombre_asignatura, true);
                            @endphp
                            @if(is_array($asignaturas))
                                <ul>
                                    @foreach($asignaturas as $asignatura)
                                        <li>{{ $asignatura }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $matriculacion->nombre_asignatura }}
                            @endif
                        </div>
                    </td>
                    <td>{{ $matriculacion->fecha }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.matriculaciones.show', $matriculacion->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.matriculaciones.edit', $matriculacion->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.matriculaciones.destroy', $matriculacion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar esta matrícula?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="pagination-custom d-flex justify-content-center">
            {{ $matriculaciones->links() }}
        </div>
    @endif
</div>
@endsection

@push('js')
<!-- Necesario para el despliegue del contenido (collapse) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@endpush
