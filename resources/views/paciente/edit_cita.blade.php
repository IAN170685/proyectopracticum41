<!-- resources/views/pacientes/edit_cita.blade.php -->
@extends('layout.app')

@section('title', 'Editar Cita Médica')

@section('content')
    <div class="container">
        <h1>Editar Cita Médica</h1>
        <form action="{{ route('pacientes.updateCita', $cita->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $cita->fecha }}" required>
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ $cita->hora }}" required>
            </div>
            <div class="form-group">
                <label for="medico">Médico</label>
                <select name="medico_id" id="medico" class="form-control" required>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico->id }}" {{ $cita->medico_id == $medico->id ? 'selected' : '' }}>{{ $medico->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="paciente">Paciente</label>
                <select name="paciente_id" id="paciente" class="form-control" required>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->idPaciente }}" {{ $cita->paciente_id == $paciente->idPaciente ? 'selected' : '' }}>{{ $paciente->nombrePaciente }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
@endsection
