@extends('layout.app')

@section('title', 'Agendar Cita')

@section('content')
<div class="container">
    <h1>Agendar Cita</h1>

    <form method="POST" action="{{ route('paciente.storeCita') }}">
        @csrf

        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            <select id="especialidad" name="especialidad" class="form-select" required>
                <option value="" selected disabled>Seleccione una especialidad</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->especialidad }}">{{ $especialidad->especialidad }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medico_id" class="form-label">Médico</label>
            <select id="medico_id" name="medico_id" class="form-select" required disabled>
                <option value="" selected disabled>Seleccione un médico</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <select id="hora" name="hora" class="form-select" required>
                <option value="" selected disabled>Seleccione una hora</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
<script nonce="your_nonce_value">
        document.getElementById('especialidad').addEventListener('change', function() {
            var especialidad = this.value;

            fetch('{{ route('paciente.get_medicos') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ especialidad: especialidad })
            })
            .then(response => response.json())
            .then(data => {
                var medicoSelect = document.getElementById('medico_id');
                medicoSelect.innerHTML = '<option value="" selected disabled>Seleccione un médico</option>';

                data.forEach(medico => {
                    var option = document.createElement('option');
                    option.value = medico.idMedico;
                    option.textContent = medico.user.name + ' ' + medico.user.apellido + ' - ' + medico.especialidad;
                    medicoSelect.appendChild(option);
                });

                medicoSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error al obtener los médicos:', error);
            });
        });

        document.getElementById('fecha').addEventListener('change', function() {
            var medico_id = document.getElementById('medico_id').value;
            var fecha = this.value;

            console.log('Fecha seleccionada:', fecha);
            console.log('Medico ID:', medico_id);

            fetch('{{ route('paciente.get_horarios') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ medico_id: medico_id, fecha: fecha })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta de horarios:', data);
                var horaSelect = document.getElementById('hora');
                horaSelect.innerHTML = '<option value="" selected disabled>Seleccione una hora</option>';

                data.forEach(hora => {
                    var option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    horaSelect.appendChild(option);
                });

                horaSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
            });
        });

        document.getElementById('medico_id').addEventListener('change', function() {
            var medico_id = this.value;
            var fecha = document.getElementById('fecha').value;

            console.log('Fecha seleccionada:', fecha);
            console.log('Medico ID:', medico_id);

            fetch('{{ route('paciente.get_horarios') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ medico_id: medico_id, fecha: fecha })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta de horarios:', data);
                var horaSelect = document.getElementById('hora');
                horaSelect.innerHTML = '<option value="" selected disabled>Seleccione una hora</option>';

                data.forEach(hora => {
                    var option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    horaSelect.appendChild(option);
                });

                horaSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
            });
        });
    </script>
    
@endsection

