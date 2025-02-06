@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Ciclo</h1>

    <p><strong>ID:</strong> {{ $ciclo->id }}</p>
    <p><strong>Nombre:</strong> {{ $ciclo->nombre }}</p>

    <a href="{{ route('admin.ciclos.index') }}" class="btn mb-3" style="background-color:rgb(96, 98, 99); color: white;">Volver a la lista</a>
    <a href="{{ route('admin.ciclos.edit', $ciclo->id) }}" class="btn mb-3"  style="background-color: #3cb4e5; color: white;">Editar</a>
</div>
@endsection
