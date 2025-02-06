@extends('adminlte::page')

@section('title', isset($user) ? 'Editar Usuario' : 'Crear Usuario')

@section('content_header')
    <h1>{{ isset($user) ? 'Editar Usuario' : 'Crear Nuevo Usuario' }}</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="row">
                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" 
                           value="{{ old('name', $user->name ?? '') }}" required>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="{{ old('email', $user->email ?? '') }}" required>
                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <!-- Contraseña -->
                <div class="col-md-6 mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="form-text text-muted">
                        {{ isset($user) ? 'Deje en blanco si no desea cambiar la contraseña' : 'Predeterminada: 12345678' }}
                    </small>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <!-- Foto -->
                <div class="col-md-6 mb-3">
                    <label for="foto">Foto (Opcional)</label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                    @if(isset($user) && $user->foto)
                        <small class="form-text text-muted">Foto actual: {{ $user->foto }}</small>
                    @endif
                    @error('foto')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <!-- DNI -->
                <div class="col-md-6 mb-3">
                    <label for="dni">DNI (Opcional)</label>
                    <input type="text" id="dni" name="dni" class="form-control" 
                           value="{{ old('dni', $user->dni ?? '') }}">
                    @error('dni')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <!-- Apellido -->
                <div class="col-md-6 mb-3">
                    <label for="apellido">Apellido (Opcional)</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" 
                           value="{{ old('apellido', $user->apellido ?? '') }}">
                    @error('apellido')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <!-- Dirección -->
                <div class="col-md-6 mb-3">
                    <label for="direccion">Dirección (Opcional)</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" 
                           value="{{ old('direccion', $user->direccion ?? '') }}">
                    @error('direccion')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <!-- Rol -->
                <div class="col-md-6 mb-3">
                    <label for="role">Rol</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Seleccione un Rol</option>
                        <option value="alumno" {{ old('role', $user->role ?? '') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                        <option value="profesor" {{ old('role', $user->role ?? '') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                        <option value="administrador" {{ old('role', $user->role ?? '') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Opciones Alumno -->
            <div class="row" id="alumno-options" style="display: {{ isset($user) ? 'none' : (old('role', $user->role ?? '') == 'alumno' ? 'block' : 'none') }};">
                <div class="col-md-6 mb-3">
                    <label for="ciclo_id">Ciclo</label>
                    <select name="ciclo_id" id="ciclo_id" class="form-control">
                        <option value="">Seleccione un Ciclo</option>
                        @foreach($ciclosConNombre as $cicloId => $cicloNombre)
                            <option value="{{ $cicloId }}" {{ old('ciclo_id', $user->ciclo_id ?? '') == $cicloId ? 'selected' : '' }}>{{ $cicloNombre }}</option>
                        @endforeach
                    </select>
                    @error('ciclo_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="curso_id">Curso</label>
                    <select name="curso_id" id="curso_id" class="form-control">
                        <option value="">Seleccione un Curso</option>
                        @foreach($cursosPorCiclo as $cicloId => $cursos)
                            <optgroup label="{{ $ciclosConNombre[$cicloId] }}">
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('curso_id', $user->curso_id ?? '') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('curso_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-{{ isset($user) ? 'primary' : 'success' }}">
                    {{ isset($user) ? 'Actualizar Usuario' : 'Crear Usuario' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        // Mostrar/ocultar los campos de Ciclo y Curso en función del rol y la vista (editar o crear)
        document.getElementById('role').addEventListener('change', function () {
            const alumnoOptions = document.getElementById('alumno-options');
            const isEditView = {!! isset($user) ? 'true' : 'false' !!};  // Evaluar si estamos en la vista de edición
            alumnoOptions.style.display = !isEditView && this.value === 'alumno' ? 'block' : 'none';
        });

        // Ejecutar la función para asegurarnos que el estado inicial es correcto
        document.getElementById('role').dispatchEvent(new Event('change'));
    </script>

    <script>
        document.getElementById('ciclo_id').addEventListener('change', function() {
            var cicloId = this.value;
            var cursosPorCiclo = @json($cursosPorCiclo); // Pasamos los cursos desde PHP a JavaScript

            var cursoSelect = document.getElementById('curso_id');
            cursoSelect.innerHTML = '<option value="">Seleccione un Curso</option>'; // Limpiar cursos previos

            if (cicloId) {
                var cursos = cursosPorCiclo[cicloId];
                if (cursos) {
                    cursos.forEach(function(curso) {
                        var option = document.createElement('option');
                        option.value = curso.id;
                        option.text = curso.nombre;
                        cursoSelect.appendChild(option);
                    });
                }
            }
        });
    </script>
@stop
