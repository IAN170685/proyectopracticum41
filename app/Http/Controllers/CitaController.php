<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medico;
use App\Models\cita;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CitaController extends Controller
{
    public function showForm()
    {
        // Obtener las especialidades únicas
        $especialidades = medico::select('especialidad')->distinct()->get();

        return view('paciente.agendar_cita', compact('especialidades'));
    }

    public function getMedicos(Request $request)
    {
        // Obtener los médicos según la especialidad seleccionada
        $medicos = medico::with('User')
            ->where('especialidad', $request->especialidad)
            ->get();

        return response()->json($medicos);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'medico_id' => 'required|exists:medicos,idMedico',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);
        $paciente = Auth::user()->paciente;
        if (!$paciente) {
            return redirect()->route('paciente.agendar_cita')->with('error', 'No tienes un perfil de paciente asociado.');
        }
        // Crear la cita
        Cita::create([
            'paciente_id' => $paciente->idPaciente, // Usar `idPaciente` como clave primaria
            'medico_id' => $validated['medico_id'],
            'fecha' => $validated['fecha'],
            'hora' => $validated['hora'],
        ]);

        // Redirigir a la página de índice del paciente con un mensaje de éxito
        return redirect()->route('paciente.index')->with('status', 'Cita agendada exitosamente.');
    }
    public function getHorarios(Request $request)
    {
        try {
            // Obtener los horarios disponibles según el médico y la fecha seleccionada
            $horarios = Horario::where('medico_id', $request->medico_id)
                               ->where('fecha', $request->fecha)
                               ->get();

            // Registrar los horarios obtenidos para depuración
            Log::info('Horarios obtenidos:', $horarios->toArray());

            // Generar los horarios entre la hora de inicio y la hora de fin
            $availableTimes = [];
            foreach ($horarios as $horario) {
                $startTime = strtotime($horario->hora_inicio);
                $endTime = strtotime($horario->hora_fin);
                while ($startTime < $endTime) {
                    $availableTimes[] = date('H:i', $startTime);
                    $startTime = strtotime('+30 minutes', $startTime); // Incrementar por intervalos de 30 minutos
                }
            }

            // Devolver la respuesta como JSON
            return response()->json($availableTimes);
        } catch (\Exception $e) {
            Log::error('Error al obtener los horarios:', ['exception' => $e]);
            return response()->json(['error' => 'Error al obtener los horarios'], 500);
        }
    }
    


}