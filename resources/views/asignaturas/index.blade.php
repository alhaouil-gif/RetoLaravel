@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Lista de Asignaturas</h2>

    <a href="{{ route('asignaturas.create') }}" class="btn mb-3" style="background-color: #3cb4e5; color: white;">Nueva Asignatura</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead style="background-color: #211261; color: white;">
            <tr>
                <th>Asignatura</th>
                <th>Cursos Asociados</th>
                <th>Común</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($asignaturasPaginadas as $asignatura)
    <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
        <td>{{ $asignatura['nombre'] }}</td>
        <td>
            <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#cursos-{{ $asignatura['id'] }}" aria-expanded="false" aria-controls="cursos-{{ $asignatura['id'] }}" style="display: block; margin: 0 auto;">
                Ver Cursos
            </button>
            <div class="collapse" id="cursos-{{ $asignatura['id'] }}">
                <ul>
                    @foreach ($asignatura['cursos_asociados'] as $curso)
                        <li>{{ $curso }}</li>
                    @endforeach
                </ul>
            </div>
        </td>
        <td class="text-center">{{ $asignatura['es_comun'] ? 'Sí' : 'No' }}</td>
        <td class="text-center">
            <a href="{{ route('asignaturas.show', $asignatura['id']) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('asignaturas.edit', $asignatura['id']) }}" class="btn btn-warning btn-sm btn-edit">
                <i class="fas fa-pen"></i>
            </a>
            <form action="{{ route('asignaturas.destroy', $asignatura['id']) }}" method="POST" style="display:inline;">
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

    <!-- Paginación personalizada -->
    <div class="pagination-custom d-flex justify-content-center">
        @if ($asignaturasPaginadas->onFirstPage())
            <span class="page-link btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a class="page-link btn-sm" href="{{ $asignaturasPaginadas->previousPageUrl() }}" rel="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @foreach ($asignaturasPaginadas->getUrlRange(1, $asignaturasPaginadas->lastPage()) as $page => $url)
            <a class="page-link btn-sm {{ $page == $asignaturasPaginadas->currentPage() ? 'active' : '' }}" 
               href="{{ $url }}">
                {{ $page }}
            </a>
        @endforeach

        @if ($asignaturasPaginadas->hasMorePages())
            <a class="page-link btn-sm" href="{{ $asignaturasPaginadas->nextPageUrl() }}" rel="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="page-link btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
</div>
@endsection

@push('js')
<!-- Necesario para el despliegue del contenido (collapse) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@endpush