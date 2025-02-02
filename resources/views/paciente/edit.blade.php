<!-- resources/views/pacientes/edit.blade.php -->
@extends('layout.app')

@section('title', 'Editar Paciente')

@section('content')
    <div class="container">
        <h1>Editar Paciente</h1>
        <form action="{{ route('pacientes.update', $paciente->idPaciente) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombrePaciente">Nombre</label>
                <input type="text" name="nombrePaciente" id="nombrePaciente" class="form-control" value="{{ $paciente->nombrePaciente }}" required>
            </div>
            <div class="form-group">
                <label for="apellidoPaciente">Apellido</label>
                <input type="text" name="apellidoPaciente" id="apellidoPaciente" class="form-control" value="{{ $paciente->apellidoPaciente }}" required>
            </div>
            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" value="{{ $paciente->fechaNacimiento }}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $paciente->telefono }}" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ $paciente->correo }}" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" required>
                    <option value="masculino" {{ $paciente->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ $paciente->sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ $paciente->sexo == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
@endsection

