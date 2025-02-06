@extends('adminlte::page')

@section('title', 'Ciclos')

@section('content_header')
<h1>Listado de Ciclos</h1>
@stop

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo ciclo -->
    <a href="{{ route('admin.ciclos.create') }}" class="btn mb-3" style="background-color: #3cb4e5; color: white;">
        
        <i class="fas fa-plus"></i> Crear Nuevo Ciclo
    </a>

    <table class="table table-bordered">
        <thead style="background-color: #211261; color: white;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciclos as $ciclo)
            <tr class="{{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-secondary text-white' }}">
                <td>{{ $ciclo->id }}</td>
                <td>{{ $ciclo->nombre }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.ciclos.show', $ciclo->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.ciclos.edit', $ciclo->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('admin.ciclos.destroy', $ciclo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este ciclo?')">
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
        @if ($ciclos->onFirstPage())
            <span class="page-link btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a class="page-link btn-sm" href="{{ $ciclos->previousPageUrl() }}" rel="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @foreach ($ciclos->getUrlRange(1, $ciclos->lastPage()) as $page => $url)
            <a class="page-link btn-sm {{ $page == $ciclos->currentPage() ? 'active' : '' }}" 
               href="{{ $url }}">
                {{ $page }}
            </a>
        @endforeach

        @if ($ciclos->hasMorePages())
            <a class="page-link btn-sm" href="{{ $ciclos->nextPageUrl() }}" rel="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="page-link btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>

    <!-- Botón de Volver -->
    <div class="d-flex justify-content-start mt-3" style="margin-left: 55px;">
        <a href="{{ route('admin.dashboard') }}" class="btn" style="background-color: #3cb4e5; color: white;">
            Volver
        </a>
    </div>
</div>
@endsection
