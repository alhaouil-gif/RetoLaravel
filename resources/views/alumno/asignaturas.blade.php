@extends('adminlte::page')

@section('title', 'Asignaturas del Alumno')

@section('content_header')
    <h1>Asignaturas Matriculadas</h1>
@stop

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
    @if ($alumno->matriculaciones->isEmpty())
        <p>No hay matriculaciones registradas.</p>
    @else
        <div class="accordion" id="accordionCiclos">
            @foreach ($alumno->matriculaciones->groupBy('curso.ciclo.nombre') as $cicloNombre => $matriculacionesPorCiclo)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCiclo{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCiclo{{ $loop->index }}" aria-expanded="false">
                            {{ $cicloNombre }}
                        </button>
                    </h2>
                    <div id="collapseCiclo{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionCiclos">
                        <div class="accordion-body">
                            <div class="accordion" id="accordionCursos{{ $loop->index }}">
                                @foreach ($matriculacionesPorCiclo->groupBy('curso.nombre') as $cursoNombre => $matriculacionesPorCurso)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingCurso{{ $loop->parent->index }}{{ $loop->index }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCurso{{ $loop->parent->index }}{{ $loop->index }}" aria-expanded="false">
                                                {{ $cursoNombre }}
                                            </button>
                                        </h2>
                                        <div id="collapseCurso{{ $loop->parent->index }}{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionCursos{{ $loop->parent->index }}">
                                            <div class="accordion-body">
                                                <ul class="list-group">
                                                    @foreach ($matriculacionesPorCurso as $matriculacion)
                                                        @foreach (json_decode($matriculacion->nombre_asignatura, true) as $asignatura)
                                                            <li class="list-group-item">{{ $asignatura }}</li>
                                                        @endforeach
                                                    @endforeach
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
    @endif
</div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop
