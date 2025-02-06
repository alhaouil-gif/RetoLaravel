<form action="{{ route('admin.matriculaciones.update', $matriculacion->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Alumno -->
    <div class="form-group">
        <label for="alumno_id">Alumno</label>
        <input type="text" class="form-control" value="{{ $matriculacion->alumno->name }}" readonly>
    </div>

    <!-- Curso -->
    <div class="form-group">
        <label for="curso_id">Curso</label>
        <select class="form-control" name="curso_id" id="curso_id">
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $matriculacion->curso_id ? 'selected' : '' }}>
                    {{ $curso->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Asignaturas -->
    <div class="form-group">
        <label for="nombre_asignatura">Asignaturas</label>
        <select class="form-control" name="nombre_asignatura[]" id="nombre_asignatura" multiple>
            @foreach($asignaturas as $asignatura)
                <option value="{{ $asignatura->nombre }}" 
                        @if(in_array($asignatura->nombre, json_decode($matriculacion->nombre_asignatura, true))) 
                            selected 
                        @endif>
                    {{ $asignatura->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Fecha -->
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $matriculacion->fecha }}">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Matrícula</button>
</form>
