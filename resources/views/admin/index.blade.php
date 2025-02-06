@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>
    @if(request('type') === 'alumnos')
        Listado de Alumnos
    @else
        Listado de Personal
    @endif
</h1>
@stop

@section('content')
<div class="container">

    <!-- Tabla para mostrar los usuarios -->
    <table class="table table-bordered">
        <thead style="background-color: #211261; color: white;">
            <tr>
                 <th>Nombre</th>
                <th>Email</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Foto</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                 <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->dni }}</td>
                <td><img src="{{ asset('storage/'.$user->foto) }}" alt="Foto" width="50" height="50"></td>
                <td>
                    @foreach ($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm btn-edit">
                        <i class="fas fa-pen"></i>
                    </a>

 
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')                  

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                            <i class="fas fa-trash"></i>

                        </button>
                    </form>
 
                </td>
            </tr>
            @endforeach
        </tbody>
  
    </table>
</div>
</br>
</br>
</br>
<!-- Paginación personalizada -->
<div class="pagination-custom d-flex justify-content-center">

    @if ($users->onFirstPage())
        <span class="page-link btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
    @else
        <a class="page-link btn-sm" href="{{ $users->appends(['type' => request('type')])->previousPageUrl() }}" rel="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
    @endif

    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
        <a class="page-link btn-sm {{ $page == $users->currentPage() ? 'active' : '' }}" 
           href="{{ $url }}&type={{ request('type') }}">
            {{ $page }}
        </a>
    @endforeach

    @if ($users->hasMorePages())
        <a class="page-link btn-sm" href="{{ $users->appends(['type' => request('type')])->nextPageUrl() }}" rel="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span class="page-link btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
    @endif

    <div class="d-flex justify-content-start" style="margin-left: 55px;">
    <a href="{{ route('admin.dashboard') }}" class="btn" style="background-color: #3cb4e5; color: white;">Volver</a>
</div>
</div>



@stop

@section('js')
    <script>
        $(document).ready(function() {
            @if(session('success'))
                $('#successModal').modal('show');
            @endif
        });
    </script>
@stop
