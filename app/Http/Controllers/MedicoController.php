<?php


namespace App\Http\Controllers;

use App\Models\medico;
use App\Models\paciente;
use App\Models\Horario; 
use App\Models\cita;
use App\Models\HistorialMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    public function index()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de medico
        if ($user->role !== 'medico') {
            return redirect('/')->with('error', 'Acceso no autorizado');
        }

        // Obtén la información del medico asociado al usuario autenticado junto con la relación con el usuario
        $medico = Medico::with('user')->where('id_user', $user->id)->first();

        // Verifica si se encontró el medico
        if (!$medico) {
            return redirect('/')->with('error', 'No se encontró un médico asociado a este usuario.');
        }

        // Devuelve la vista con los datos del medico
        return view('medico.index', compact('medico'));
    }
    // Ver citas agendadas
    public function showCitas()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Por favor, inicia sesión.');
        }

        // Obtén el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de medico
        if ($user->role !== 'medico') { // Asegúrate de que 'role' es el nombre correcto del campo en la tabla de usuarios
            return redirect('/')->with('error', 'Acceso no autorizado.');
        }

        // Obtén la información del medico asociado al usuario autenticado
        $medico = Medico::where('id_user', $user->id)->first();

        // Verifica si se encontró el medico
        if (!$medico) {
            return redirect('/')->with('error', 'No se encontró un médico asociado a este usuario.');
        }

        // Obtener las citas del médico
        $citas = Cita::where('medico_id', $medico->idMedico)->get();

        // Verificar si se obtuvieron las citas correctamente
        if (is_null($citas)) {
            $citas = collect(); // Crear una colección vacía si no se encontraron citas
        }

        // Pasar las citas a la vista
        return view('medico.citas', compact('citas'));
    }

    // Ver historial médico de un paciente
    public function verHistorial($idPaciente)
    {
        $paciente = paciente::findOrFail($idPaciente);
        $historial = HistorialMedico::where('idPaciente', $paciente->idPaciente)->first();

        return view('paciente.historial_medico', compact('paciente', 'historial'));
    }

    // Método para actualizar el historial médico del paciente
    public function actualizarHistorialMedico(Request $request, $pacienteId)
    {
        $historial = HistorialMedico::where('idPaciente', $pacienteId)->firstOrFail();
        $historial->update($request->all());

        return redirect()->route('medico.verHistorial', ['paciente' => $pacienteId])
                         ->with('success', 'Historial médico actualizado correctamente.');
    }

    // Método para actualizar el historial médico del paciente
    
    // Actualizar historial médico de un paciente
    

    // Generar prescripción médica para un paciente
    public function generarPrescripcionMedica(Request $request, Paciente $paciente)
    {
        $request->validate([
            'prescripcion' => 'required|string',
        ]);

        $medico = Medico::find(Auth::id());
        $medico->generarPrescripcionMedica($paciente, $request->prescripcion);

        return redirect()->route('medicos.verHistorialMedico', ['paciente' => $paciente->id])
            ->with('success', 'Prescripción médica generada exitosamente.');
    }    
    // Método en el controlador para almacenar y mostrar los horarios
    public function showHorarioForm()
    {
        return view('medico.horario');
    }

    public function storeHorarios(Request $request)
    {
        // Asegurarse de que el usuario autenticado tiene un registro en `medicos`
        $medico = Auth::user()->medico;
        if (!$medico) {
            return redirect()->route('medico.horario')->with('error', 'No tienes un perfil de médico asociado.');
        }

        // Validar los datos del formulario
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        // Guardar los horarios en la base de datos
        Horario::create([
            'medico_id' => $medico->idMedico, // Usar `idMedico` como la clave primaria
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('medico.index')->with('status', 'Horarios guardados exitosamente.');
    }

    // Método para mostrar el formulario con los horarios configurados
    public function showHorarios()
    {
        $horarios = Horario::where('medico_id', Auth::user()->id)->get();

        return view('medico.horario', compact('horarios'));
    }
    


}