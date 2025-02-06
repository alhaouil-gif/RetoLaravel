@extends('adminlte::page')

@section('title', 'Profesores')

@section('content_header')
    <h1>Listado de Profesores</h1>
@stop

@section('content')
<div class="container">
    @if($profesores->isEmpty())
        <p>No hay profesores registrados.</p>
    @else
        <table class="table table-bordered">
            <thead style="background-color: #211261; color: white;">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Foto</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesores as $profesor)
                <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                    <td>{{ $profesor->name }}</td>
                    <td>{{ $profesor->email }}</td>
                    <td>{{ $profesor->apellido }}</td>
                    <td>{{ $profesor->dni }}</td>
                    <td>
                        @if($profesor->foto)
                            <img src="{{ asset('storage/'.$profesor->foto) }}" alt="Foto" width="50" height="50">
                        @else
                            <span>Sin foto</span>
                        @endif
                    </td>
                    <td>
                        @foreach ($profesor->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Paginación personalizada -->
<div class="pagination-custom d-flex justify-content-center">
    @if ($profesores->onFirstPage())
        <span class="page-link btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
    @else
        <a class="page-link btn-sm" href="{{ $profesores->appends(['type' => request('type')])->previousPageUrl() }}" rel="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
    @endif

    @foreach ($profesores->getUrlRange(1, $profesores->lastPage()) as $page => $url)
        <a class="page-link btn-sm {{ $page == $profesores->currentPage() ? 'active' : '' }}" 
           href="{{ $url }}&type={{ request('type') }}">
            {{ $page }}
        </a>
    @endforeach

    @if ($profesores->hasMorePages())
        <a class="page-link btn-sm" href="{{ $profesores->appends(['type' => request('type')])->nextPageUrl() }}" rel="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span class="page-link btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
    @endif
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
