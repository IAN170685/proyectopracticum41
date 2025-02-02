<?php
namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Mostrar una lista de los recursos.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Por favor, inicie sesión para ver su perfil.');
        }

        $user = Auth::user();
        $paciente = paciente::where('user_id', $user->id)->first();

        if (!$paciente) {
            return view('paciente.index')->with('error', 'No se encontró un paciente asociado a este usuario.');
        }

        return view('paciente.index', compact('paciente'));
    }

   
    public function agendar()
    {
        return view('paciente.agendar');
    }

    public function recetas()
    {
        $paciente = Auth::user()->paciente; // Obtener el paciente autenticado a través de la relación
        // Ejemplo: obtener las recetas del paciente
        $recetas = $paciente->recetas; // Ajusta esto según la estructura de tus modelos
        return view('paciente.recetas', compact('paciente', 'recetas'));
    }

    public function examen()
    {
        $paciente = Auth::user()->paciente; // Obtener el paciente autenticado a través de la relación
        $examenes = $paciente->examenes; // Obtener los exámenes del paciente utilizando la relación definida en el modelo
        return view('paciente.examen', compact('paciente', 'examenes'));
    }

    public function create()
    {
        return view('paciente.agendar_cita');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombrePaciente' => 'required',
            'apellidoPaciente' => 'required',
            'fechaNacimiento' => 'required|date',
            'telefono' => 'required',
            'correo' => 'required|email|unique:pacientes,correo',
            'sexo' => 'required',
        ]);

        Paciente::create($request->all());

        return redirect()->route('paciente.index')
            ->with('success', 'Paciente creado exitosamente.');
    }

    public function show(Paciente $paciente)
    {
        return view('paciente.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('paciente.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombrePaciente' => 'required',
            'apellidoPaciente' => 'required',
            'fechaNacimiento' => 'required|date',
            'telefono' => 'required',
            'correo' => 'required|email|unique:pacientes,correo,' . $paciente->idPaciente, // Ajustar idPaciente
            'sexo' => 'required',
        ]);

        $paciente->update($request->all());

        return redirect()->route('paciente.index')
            ->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('paciente.index')
            ->with('success', 'Paciente eliminado exitosamente.');
    }

    public function createCita()
    {
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        return view('paciente.create_cita', compact('medicos', 'pacientes'));
    }

    public function storeCita(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,idPaciente', // Ajustar idPaciente
        ]);

        Cita::create($request->all());

        return redirect()->route('paciente.index')
            ->with('success', 'Cita médica creada exitosamente.');
    }

    public function editCita(Cita $cita)
    {
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        return view('paciente.edit_cita', compact('cita', 'medicos', 'pacientes'));
    }

    public function updateCita(Request $request, Cita $cita)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,idPaciente', // Ajustar idPaciente
        ]);

        $cita->update($request->all());

        return redirect()->route('paciente.index')
            ->with('success', 'Cita médica actualizada exitosamente.');
    }

    public function showCitas()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Por favor, inicie sesión para ver sus citas.');
        }

        $user = Auth::user();
        $medico = Medico::where('id_user', $user->id)->first();

        if (!$medico) {
            return view('medico.citas')->with('error', 'No se encontró un médico asociado a este usuario.');
        }

        $citas = Cita::where('medico_id', $medico->idMedico)->with('paciente')->get();

        return view('medico.citas', compact('citas'));
    }
    public function agendarCita()
    {
        // Lógica para agendar la cita del paciente
        return view('paciente.agendar_cita');
    }
    
}


