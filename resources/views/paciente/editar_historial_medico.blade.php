@extends('layout.medicos')


@section('title', 'Editar Historial Médico')

@section('content')
<div class="container">
    <h1>Editar Historial Médico del Paciente</h1>

    <!-- Información del paciente -->
    <p>Nombre Completo: {{ $historial->nombre_completo }}</p>
    <p>Fecha de Nacimiento: {{ $historial->fecha_nacimiento }}</p>
    <p>Sexo: {{ $historial->sexo }}</p>
    <p>Número de Identificación: {{ $historial->numero_identificacion }}</p>
    <p>Teléfono: {{ $historial->telefono }}</p>
    <p>Email: {{ $historial->email }}</p>
    <p>Dirección: {{ $historial->direccion }}</p>

    <!-- Formulario para editar el historial médico -->
    <form method="POST" action="{{ route('medico.actualizarHistorialMedico', ['pacienteId' => $historial->idPaciente]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="contacto_emergencia" class="form-label">Contacto de Emergencia</label>
            <input type="text" id="contacto_emergencia" name="contacto_emergencia" class="form-control" value="{{ $historial->contacto_emergencia }}">
        </div>

        <div class="mb-3">
            <label for="telefono_emergencia" class="form-label">Teléfono de Emergencia</label>
            <input type="text" id="telefono_emergencia" name="telefono_emergencia" class="form-control" value="{{ $historial->telefono_emergencia }}">
        </div>

        <div class="mb-3">
            <label for="enfermedades_previas" class="form-label">Enfermedades Previas</label>
            <textarea id="enfermedades_previas" name="enfermedades_previas" class="form-control">{{ $historial->enfermedades_previas }}</textarea>
        </div>

        <div class="mb-3">
            <label for="intervenciones_quirurgicas" class="form-label">Intervenciones Quirúrgicas</label>
            <textarea id="intervenciones_quirurgicas" name="intervenciones_quirurgicas" class="form-control">{{ $historial->intervenciones_quirurgicas }}</textarea>
        </div>

        <div class="mb-3">
            <label for="alergias" class="form-label">Alergias</label>
            <textarea id="alergias" name="alergias" class="form-control">{{ $historial->alergias }}</textarea>
        </div>

        <div class="mb-3">
            <label for="medicamentos_en_uso" class="form-label">Medicamentos en Uso</label>
            <textarea id="medicamentos_en_uso" name="medicamentos_en_uso" class="form-control">{{ $historial->medicamentos_en_uso }}</textarea>
        </div>

        <div class="mb-3">
            <label for="antecedentes_familiares" class="form-label">Antecedentes Familiares</label>
            <textarea id="antecedentes_familiares" name="antecedentes_familiares" class="form-control">{{ $historial->antecedentes_familiares }}</textarea>
        </div>

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <textarea id="diagnostico" name="diagnostico" class="form-control">{{ $historial->diagnostico }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tratamiento_indicado" class="form-label">Tratamiento Indicado</label>
            <textarea id="tratamiento_indicado" name="tratamiento_indicado" class="form-control">{{ $historial->tratamiento_indicado }}</textarea>
        </div>

        <div class="mb-3">
            <label for="medico" class="form-label">Médico</label>
            <input type="text" id="medico" name="medico" class="form-control" value="{{ $historial->medico }}">
        </div>

        <div class="mb-3">
            <label for="recomendaciones" class="form-label">Recomendaciones</label>
            <textarea id="recomendaciones" name="recomendaciones" class="form-control">{{ $historial->recomendaciones }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proxima_cita" class="form-label">Próxima Cita</label>
            <input type="date" id="proxima_cita" name="proxima_cita" class="form-control" value="{{ $historial->proxima_cita }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Historial</button>
    </form>
</div>
@endsection
