<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialMedico;
use App\Models\paciente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class HistorialMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
   // Método para mostrar el historial médico del paciente
     // Método para actualizar el historial médico del paciente
  
    public function verHistorialPaciente()
    {
        $paciente = Auth::user()->paciente;
        $historial = HistorialMedico::where('idPaciente', $paciente->idPaciente)->first();

        return view('paciente.historial_medico', compact('paciente', 'historial'));
    }

    // Método para que el paciente actualice su propio historial médico
    public function actualizarHistorialPaciente(Request $request)
    {
        $paciente = Auth::user()->paciente;
        $historial = HistorialMedico::updateOrCreate(
            ['idPaciente' => $paciente->idPaciente],
            $request->all()
        );

        return redirect()->route('paciente.verHistorial')
                         ->with('success', 'Historial médico actualizado correctamente.');
    }
    public function verHistorial($pacienteId)
    {
        $paciente = paciente::with('User')->findOrFail($pacienteId);
        $historial = HistorialMedico::where('idPaciente', $pacienteId)->first();
        return view('paciente.historial_medico', compact('paciente', 'historial'));
    }

    public function editarHistorial($pacienteId)
    {
        Log::info('Editar Historial: pacienteId = ' . $pacienteId);

        try {
            $paciente = paciente::findOrFail($pacienteId);
            Log::info('Paciente encontrado: ', ['paciente' => $paciente]);

            $historial = HistorialMedico::where('idPaciente', $pacienteId)->first();
            Log::info('Historial médico encontrado: ', ['historial' => $historial]);

            return view('paciente.editar_historial_medico', compact('paciente', 'historial'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la vista de edición de historial: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Hubo un problema al cargar la vista de edición de historial.');
        }
    }



    public function actualizarHistorialMedico(Request $request, $pacienteId)
    {
        Log::info('Actualizar Historial: pacienteId = ' . $pacienteId);
        try {
            $historial = HistorialMedico::where('idPaciente', $pacienteId)->first();
            Log::info('Historial médico encontrado: ', ['historial' => $historial]);
    
            $historial->update($request->only([
                'contacto_emergencia',
                'telefono_emergencia',
                'enfermedades_previas',
                'intervenciones_quirurgicas',
                'alergias',
                'medicamentos_en_uso',
                'antecedentes_familiares',
                'diagnostico',
                'tratamiento_indicado',
                'medico',
                'recomendaciones',
                'proxima_cita'
            ]));
    
            return redirect()->route('medico.verHistorial', ['pacienteId' => $pacienteId])->with('success', 'Historial médico actualizado con éxito');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el historial médico: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el historial médico.');
        }
    }
    
     // Método para que el paciente vea su propio historial médico


    /**
     * Show the form for creating a new resource.
     */
   
}
