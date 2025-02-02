@extends('layout.medicos')

@section('title', 'Ingresar Horarios')

@section('content')
<div class="container">
    <h1>Ingresar Horarios Disponibles</h1>

    <form method="POST" action="{{ route('medico.storeHorarios') }}">
        @csrf
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
            <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de Fin</label>
            <input type="time" id="hora_fin" name="hora_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Horarios</button>
    </form>
</div>
@endsection

