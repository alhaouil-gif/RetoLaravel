@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    
    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Apellido</strong></td>
                        <td>{{ $user->apellido }}</td>
                    </tr>
                    <tr>
                        <td><strong>DNI</strong></td>
                        <td>{{ $user->dni }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dirección</strong></td>
                        <td>{{ $user->direccion }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

     <!-- Acordeones de Ciclos y Cursos -->
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
                                                <ul class="list-group">
                                                    @forelse ($asignaturas as $asignatura)
                                                        <li class="list-group-item">{{ $asignatura->nombre }}</li>
                                                    @empty
                                                        <li class="list-group-item">No hay asignaturas para este curso.</li>
                                                   @endforelse
                                                </ul>
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
     </div>
    </div>






<div class="card-footer">
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Volver</a>
  <!-- <a href="{{ route('admin.matriculaciones.index', $user->id) }}" class="btn btn-primary">Ver</a>-->
    <a href="{{ route('admin.matriculaciones.create', $user->id) }}" class="btn btn-primary">Crear</a>
    <a href="{{ route('admin.matriculaciones.edit', $user->id) }}" class="btn btn-primary">Editar</a>    </div>
</div>
<!-- Bootstrap JS (asegúrate de que esté incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

 