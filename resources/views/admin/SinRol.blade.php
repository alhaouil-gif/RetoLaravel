@extends('adminlte::page')

@section('title', 'Usuarios sin Rol')

@section('content_header')
    <h1>Usuarios sin Rol</h1>
@stop

@section('content')
    <div class="container">
        <h3>Total de usuarios sin rol: {{ $usersWithoutRoleCount }}</h3>
    </div>
@stop
