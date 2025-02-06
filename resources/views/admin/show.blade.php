@extends('adminlte::page')

@section('title', 'Detalles del Usuario')

@section('content')
<style>
  /* Estilos personalizados para los acordeones */
.accordion {
    border: none;
    box-shadow: 2px 1px 1px;
}

.accordion-item {
    border: none;
    margin-bottom: 30px;
}

.accordion-button {
    width: 100%;
    background-color: #3cb4e5;
    color: #000;
    border: none;
    box-shadow: none;
    text-align: left; /* Alinea el texto a la izquierda */
    justify-content: flex-start; /* Asegura que el texto se mantenga alineado a la izquierda */
}

.accordion-button:not(.collapsed) {
    background-color: #3cb4e5;
    color: #000;
}

.accordion-body {
    text-align: start;
    background-color: #fff;
    border: none;
}

</style>

<div class="container">
    <h1>Detalles del Usuario</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }} {{ $user->apellido }}</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr class="bg-light">
                        <td><strong>Email</strong></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr class="bg-secondary text-white">
                        <td><strong>Apellido</strong></td>
                        <td>{{ $user->apellido }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>DNI</strong></td>
                        <td>{{ $user->dni }}</td>
                    </tr>
                    <tr class="bg-secondary text-white">
                        <td><strong>Dirección</strong></td>
                        <td>{{ $user->direccion }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if (!empty($datosAgrupados))
        <div class="accordion" id="accordionCiclos">
            @foreach ($datosAgrupados as $cicloNombre => $cursos)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ Str::slug($cicloNombre) }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($cicloNombre) }}" aria-expanded="true" aria-controls="collapse-{{ Str::slug($cicloNombre) }}">
                            Ciclo: {{ $cicloNombre }}
                        </button>
                    </h2>
                    <div id="collapse-{{ Str::slug($cicloNombre) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($cicloNombre) }}" data-bs-parent="#accordionCiclos">
                        <div class="accordion-body">
                            <div class="accordion" id="accordionCursos-{{ Str::slug($cicloNombre) }}">
                                @foreach ($cursos as $cursoNombre => $asignaturas)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingCurso-{{ Str::slug($cursoNombre) }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCurso-{{ Str::slug($cursoNombre) }}" aria-expanded="false" aria-controls="collapseCurso-{{ Str::slug($cursoNombre) }}">
                                                Curso: {{ $cursoNombre }}
                                            </button>
                                        </h2>
                                        <div id="collapseCurso-{{ Str::slug($cursoNombre) }}" class="accordion-collapse collapse" aria-labelledby="headingCurso-{{ Str::slug($cursoNombre) }}" data-bs-parent="#accordionCursos-{{ Str::slug($cicloNombre) }}">
                                            <div class="accordion-body">
                                                <h5>Asignaturas:</h5>
                                                <form action="{{ route('admin.matriculaciones.borrarAsignaturas', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <ul class="list-group">
                                                        @forelse ($asignaturas as $asignatura)
                                                            <li class="list-group-item">
                                                                <input type="checkbox" name="asignaturas[]" value="{{ $asignatura }}" id="asignatura-{{ Str::slug($asignatura) }}">
                                                                <label for="asignatura-{{ Str::slug($asignatura) }}">{{ $asignatura }}</label>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">No hay asignaturas para este curso.</li>
                                                        @endforelse
                                                    </ul>
                                                    <button type="submit" class="btn btn-danger mt-3">Borrar Asignaturas Seleccionadas</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No hay ciclos, cursos o asignaturas registradas para este usuario.</p>
    @endif

    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn mb-3" style="background-color: rgb(96, 98, 99); color: white;">Volver</a>
        
        {{-- Mostrar el botón para crear matrícula si el usuario es alumno --}}
        @if($user->hasRole('alumno'))
            <a href="{{ route('admin.matriculaciones.create', $user->id) }}" class="btn mb-3" style="background-color: #3cb4e5; color: white;">
                <i class="fas fa-plus"></i> Crear Matrícula
            </a>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
