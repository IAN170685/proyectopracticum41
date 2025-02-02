@extends('layout.app')

@section('title', 'Perfil del Paciente')

@section('content')
<div class="container">
    <h1>Bienvenido, {{ $paciente->user->name }} {{ $paciente->user->apellido }}</h1>
    <p><strong>Correo:</strong> {{ $paciente->user->email }}</p>
    <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
    <p><strong>Sexo:</strong> {{ $paciente->sexo }}</p>
</div>
@endsection

