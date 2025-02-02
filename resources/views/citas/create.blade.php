@extends('layout.app')

@section('title', 'Agendar Cita')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendar Cita</div>
                <div class="card-body">
                    <form action="{{ route('paciente.storeCita') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="paciente_id" class="form-label">Paciente</label>
                            <select class="form-control" id="paciente_id" name="paciente_id" required>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->idPaciente }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="medico_id" class="form-label">Médico</label>
                            <select class="form-control" id="medico_id" name="medico_id" required>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->idMedico }}">{{ $medico->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Agendar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
