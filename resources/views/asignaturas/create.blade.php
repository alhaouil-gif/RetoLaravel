@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Crear Nueva Asignatura</h2>

    <form action="{{ route('asignaturas.store') }}" method="POST">
        @csrf

        <!-- Nombre de la asignatura -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <!-- Desplegable para seleccionar el nivel -->
        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel" id="nivel" class="form-control" required>
                <option value="">Selecciona un nivel</option>
                <option value="Primero">Primero</option>
                <option value="Segundo">Segundo</option>
            </select>
        </div>

        <!-- Selector múltiple de Cursos -->
        <div class="mb-3">
            <label for="curso_id" class="form-label">Seleccionar Cursos</label>
            <select name="curso_id[]" id="curso_id" class="form-control select2" multiple="multiple" required>
                @foreach ($cursos as $curso)
                    @php
                        // Se asume que el nombre del curso tiene el formato "Primero ..." o "Segundo ..."
                        $parts = explode(' ', $curso->nombre, 2);
                        $nivelCurso = $parts[0]; // "Primero" o "Segundo"
                        $nombreCompleto = $curso->nombre;
                    @endphp
                    <option value="{{ $curso->id }}" data-nivel="{{ $nivelCurso }}" data-original="{{ $nombreCompleto }}">
                        {{ $nombreCompleto }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Checkbox: ¿Es Común? -->
        <div class="mb-3">
            <label for="es_comun" class="form-label">¿Es Común?</label>
            <input type="checkbox" name="es_comun" id="es_comun" value="1">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@push('css')
    <!-- Incluir CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <!-- Incluir JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en el campo de cursos
            $('#curso_id').select2({
                placeholder: "Selecciona los cursos",
                allowClear: true
            });

            // Cuando el usuario cambie el nivel
            $('#nivel').on('change', function() {
                var selectedNivel = $(this).val(); // "Primero" o "Segundo"
                $('#curso_id option').each(function() {
                    var cursoNivel = $(this).data('nivel'); // Valor "Primero" o "Segundo"
                    var originalText = $(this).data('original'); // Texto completo del curso
                    if (selectedNivel === "" || cursoNivel === selectedNivel) {
                        // Si se selecciona "Primero", quitamos la palabra "Primero " del inicio del texto
                        if (selectedNivel === 'Primero') {
                            var newText = originalText.replace(/^Primero\s+/i, '');
                            $(this).text(newText);
                        } else {
                            // Para "Segundo", mostramos el texto completo
                            $(this).text(originalText);
                        }
                        $(this).prop('disabled', false);
                    } else {
                        // Deshabilitamos las opciones que no correspondan al nivel seleccionado
                        $(this).prop('disabled', true);
                    }
                });
                // Forzamos que Select2 se refresque
                $('#curso_id').select2();
            });
        });
    </script>
@endpush
