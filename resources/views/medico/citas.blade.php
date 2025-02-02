@extends('layout.medicos')

@section('title', 'Citas Agendadas')

@section('content')
<div class="container">
    <h1>Citas Agendadas</h1>
    @if($citas->isEmpty())
        <p>No hay citas agendadas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Historial Médico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->paciente->user->name }} {{ $cita->paciente->user->apellido }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>
                        <a href="{{ route('medico.verHistorial', $cita->paciente->idPaciente) }}" class="btn btn-info">Ver Historial</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
