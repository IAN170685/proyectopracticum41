<!-- resources/views/medicos/historial.blade.php -->
@extends('layout.medicos')

@section('title', 'Historial Médico del Paciente')

@section('content')
    <div class="container">
        <h1>Historial Médico de {{ $paciente->nombrePaciente }}</h1>
        <p>{{ $historial }}</p>
        <h3>Actualizar Historial Médico</h3>
        <form method="POST" action="{{ route('medico.actualizarHistorialMedico', ['paciente' => $paciente->id]) }}">
            @csrf
            <div class="form-group">
                <label for="historial">Historial Médico</label>
                <textarea name="historial" id="historial" class="form-control" required>{{ $historial }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Historial</button>
        </form>
    </div>
@endsection
