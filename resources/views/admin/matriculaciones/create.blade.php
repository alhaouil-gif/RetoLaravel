@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Crear Nueva Matrícula</h1>

    <form action="{{ route('admin.matriculaciones.store') }}" method="POST">
        @csrf

        <!-- Campo oculto para el ID del alumno -->
        <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">

        <!-- Selección de cursos ya matriculados -->
        <div class="form-group">
            <label for="cursosMatriculados">Cursos en los que está matriculado</label>
            @if($cursosMatriculados)
                <ul>
                    @foreach($cursosMatriculados as $cursoId)
                        @php
                            $curso = \App\Models\Curso::find($cursoId);
                        @endphp
                        <li>{{ $curso->nombre }}</li>
                    @endforeach
                </ul>
            @else
                <p>No está matriculado en ningún curso aún.</p>
            @endif
        </div>

        <!-- Selección de cursos disponibles -->
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select class="form-control" name="curso_id" id="curso_id" required>
                <option value="">Seleccione un curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
  <!-- Fecha de matrícula -->
  <div class="form-group">
            <label for="fecha">Fecha de Matrícula</label>
            <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
        <!-- Selección de asignaturas -->
        <div class="form-group">
            <label for="asignaturas">Asignaturas</label>
            @foreach ($asignaturas as $asignatura)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="asignaturas[]" value="{{ $asignatura->nombre }}" id="asignatura-{{ $asignatura->id }}">
                    <label class="form-check-label" for="asignatura-{{ $asignatura->id }}">
                        {{ $asignatura->nombre }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Paginación personalizada -->
        <div class="pagination-custom d-flex justify-content-center">
            @if ($asignaturas->onFirstPage())
                <span class="page-link btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-link btn-sm" href="{{ $asignaturas->appends(['type' => request('type')])->previousPageUrl() }}" rel="prev">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            @foreach ($asignaturas->getUrlRange(1, $asignaturas->lastPage()) as $page => $url)
                <a class="page-link btn-sm {{ $page == $asignaturas->currentPage() ? 'active' : '' }}" 
                   href="{{ $url }}&type={{ request('type') }}">
                    {{ $page }}
                </a>
            @endforeach

            @if ($asignaturas->hasMorePages())
                <a class="page-link btn-sm" href="{{ $asignaturas->appends(['type' => request('type')])->nextPageUrl() }}" rel="next">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="page-link btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>

      

      

        <!-- Botón de envío -->
        <button type="submit" class="btn" style="background-color: #3cb4e5; color: white;">Crear Matrícula</button>
    </form>
</div>
@endsection
