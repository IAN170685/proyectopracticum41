@extends('layout.medicos')

@section('title', 'Página Principal del Médico')

@section('content')
<div class="container">
    <h1>Bienvenido, Dr. {{ $medico->user->name }} {{ $medico->user->apellido }}</h1>
    <p><strong>Especialidad:</strong> {{ $medico->especialidad }}</p>
    <p><strong>Teléfono:</strong> {{ $medico->telefono }}</p>
    <p><strong>Email:</strong> {{ $medico->user->email }}</p>
  
    
</div>
@endsection

