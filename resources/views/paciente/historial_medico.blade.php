@extends('layout.medicos')


@section('title', 'Historial Médico de ' . $paciente->user->name . ' ' . $paciente->user->apellido)

@section('content')
    <div class="container">
        <h1>Historial Médico de {{ $paciente->user->name }} {{ $paciente->user->apellido }}</h1>
        
        <!-- Mostrar los datos del paciente y el historial médico -->
        <div class="form-group">
            <label for="nombre_completo">Nombre completo</label>
            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ $paciente->user->name }} {{ $paciente->user->apellido }}" readonly>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $paciente->fecha_nacimiento }}" readonly>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo</label>
            <input type="text" name="sexo" id="sexo" class="form-control" value="{{ $paciente->sexo }}" readonly>
        </div>
        <div class="form-group">
            <label for="numero_identificacion">Número de identificación</label>
            <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control" value="{{ $paciente->numero_identificacion }}" readonly>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $paciente->telefono }}" readonly>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo electrónico</label>
            <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="{{ $paciente->correo_electronico }}" readonly>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $paciente->direccion }}" readonly>
        </div>
        <div class="form-group">
            <label for="contacto_emergencia">Contacto de emergencia</label>
            <input type="text" name="contacto_emergencia" id="contacto_emergencia" class="form-control" value="{{ $paciente->contacto_emergencia }}" readonly>
        </div>
        <div class="form-group">
            <label for="telefono_emergencia">Teléfono de emergencia</label>
            <input type="text" name="telefono_emergencia" id="telefono_emergencia" class="form-control" value="{{ $paciente->telefono_emergencia }}" readonly>
        </div>
        <div class="form-group">
            <label for="enfermedades_previas">Enfermedades previas</label>
            <textarea name="enfermedades_previas" id="enfermedades_previas" class="form-control" readonly>{{ $historial->enfermedades_previas }}</textarea>
        </div>
        <div class="form-group">
            <label for="intervenciones_quirurgicas">Intervenciones quirúrgicas</label>
            <textarea name="intervenciones_quirurgicas" id="intervenciones_quirurgicas" class="form-control" readonly>{{ $historial->intervenciones_quirurgicas }}</textarea>
        </div>
        <div class="form-group">
            <label for="alergias">Alergias</label>
            <textarea name="alergias" id="alergias" class="form-control" readonly>{{ $historial->alergias }}</textarea>
        </div>
        <div class="form-group">
            <label for="medicamentos_en_uso">Medicamentos en uso</label>
            <textarea name="medicamentos_en_uso" id="medicamentos_en_uso" class="form-control" readonly>{{ $historial->medicamentos_en_uso }}</textarea>
        </div>
        <div class="form-group">
            <label for="antecedentes_familiares">Antecedentes familiares de enfermedades</label>
            <textarea name="antecedentes_familiares" id="antecedentes_familiares" class="form-control" readonly>{{ $historial->antecedentes_familiares }}</textarea>
        </div>
        <div class="form-group">
            <label for="fecha_cita">Fecha de cita</label>
            <input type="date" name="fecha_cita" id="fecha_cita" class="form-control" value="{{ $historial->fecha_cita }}" readonly>
        </div>
        <div class="form-group">
            <label for="motivo_cita">Motivo de la cita</label>
            <textarea name="motivo_cita" id="motivo_cita" class="form-control" readonly>{{ $historial->motivo_cita }}</textarea>
        </div>
        <div class="form-group">
            <label for="diagnostico">Diagnóstico</label>
            <textarea name="diagnostico" id="diagnostico" class="form-control" readonly>{{ $historial->diagnostico }}</textarea>
        </div>
        <div class="form-group">
            <label for="tratamiento_indicado">Tratamiento indicado</label>
            <textarea name="tratamiento_indicado" id="tratamiento_indicado" class="form-control" readonly>{{ $historial->tratamiento_indicado }}</textarea>
        </div>
        <div class="form-group">
            <label for="tipo_examen">Tipo de examen</label>
            <input type="text" name="tipo_examen" id="tipo_examen" class="form-control" value="{{ $historial->tipo_examen }}" readonly>
        </div>
        <div class="form-group">
            <label for="fecha_examen">Fecha del examen</label>
            <input type="date" name="fecha_examen" id="fecha_examen" class="form-control" value="{{ $historial->fecha_examen }}" readonly>
        </div>
        <div class="form-group">
            <label for="resultado_examen">Resultado del examen</label>
            <textarea name="resultado_examen" id="resultado_examen" class="form-control" readonly>{{ $historial->resultado_examen }}</textarea>
        </div>
        <div class="form-group">
            <label for="fecha_nota">Fecha de la nota</label>
            <input type="date" name="fecha_nota" id="fecha_nota" class="form-control" value="{{ $historial->fecha_nota }}" readonly>
        </div>
        <div class="form-group">
            <label for="medico_nota">Médico de la nota</label>
            <input type="text" name="medico_nota" id="medico_nota" class="form-control" value="{{ $historial->medico_nota }}" readonly>
        </div>
        <div class="form-group">
            <label for="notas">Notas</label>
            <textarea name="notas" id="notas" class="form-control" readonly>{{ $historial->notas }}</textarea>
        </div>
        <div class="form-group">
            <label for="diagnostico_actual">Diagnóstico actual</label>
            <textarea name="diagnostico_actual" id="diagnostico_actual" class="form-control" readonly>{{ $historial->diagnostico_actual }}</textarea>
        </div>
        <div class="form-group">
            <label for="objetivos_tratamiento">Objetivos del tratamiento</label>
            <textarea name="objetivos_tratamiento" id="objetivos_tratamiento" class="form-control" readonly>{{ $historial->objetivos_tratamiento }}</textarea>
        </div>
        <div class="form-group">
            <label for="recomendaciones">Recomendaciones</label>
            <textarea name="recomendaciones" id="recomendaciones" class="form-control" readonly>{{ $historial->recomendaciones }}</textarea>
        </div>
        <div class="form-group">
            <label for="proxima_cita">Próxima cita</label>
            <input type="date" name="proxima_cita" id="proxima_cita" class="form-control" value="{{ $historial->proxima_cita }}" readonly>
        </div>
        <div class="form-group">
            <label for="firma_paciente">Firma del paciente</label>
            <input type="text" name="firma_paciente" id="firma_paciente" class="form-control" value="{{ $historial->firma_paciente }}" readonly>
        </div>

        <a href="{{ route('medico.editarHistorial', ['pacienteId' => $paciente->user_id]) }}">Editar Historial</a>



    </div>
@endsection