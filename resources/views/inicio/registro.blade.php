@extends('layout.inicio')



@section('title', 'Registrar Usuario')

@section('content')
    <div class="container">
        <h1>Registrar Usuario</h1>
        <form method="POST" action="{{ route('registro') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role" id="role" class="form-control" required onchange="toggleFields()">
                    <option value="">Seleccionar Rol</option>
                    <option value="paciente">Paciente</option>
                    <option value="medico">Médico</option>
                    <option value="secretaria">Secretaria</option>
                    <option value="gerente">Gerente</option>
                </select>
            </div>
            <div id="paciente-fields" style="display:none;">
                <div class="form-group">
                    <label for="fechaNacimientoPaciente">Fecha de Nacimiento</label>
                    <input type="date" name="fechaNacimiento" id="fechaNacimientoPaciente" class="form-control">
                </div>
                <div class="form-group">
                    <label for="telefonoPaciente">Teléfono</label>
                    <input type="text" name="telefonoPaciente" id="telefonoPaciente" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sexoPaciente">Sexo</label>
                    <input type="text" name="sexo" id="sexoPaciente" class="form-control">
                </div>
            </div>
            <div id="medico-fields" style="display:none;">
                <div class="form-group">
                    <label for="especialidadMedico">Especialidad</label>
                    <input type="text" name="especialidad" id="especialidadMedico" class="form-control">
                </div>
                <div class="form-group">
                    <label for="telefonoMedico">Teléfono</label>
                    <input type="text" name="telefonoMedico" id="telefonoMedico" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
        function toggleFields() {
            var role = document.getElementById('role').value;
            var pacienteFields = document.getElementById('paciente-fields');
            var medicoFields = document.getElementById('medico-fields');

            pacienteFields.style.display = role === 'paciente' ? 'block' : 'none';
            medicoFields.style.display = role === 'medico' ? 'block' : 'none';
        }
    </script>
@endsection
