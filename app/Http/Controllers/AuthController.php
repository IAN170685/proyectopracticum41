<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\user;
use App\Models\medico;
use App\Models\paciente;
use App\Models\HistorialMedico;
use Log;
class AuthController extends Controller
{
    public function index()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de paciente
        if ($user->role !== 'paciente') {
            return redirect('/')->with('error', 'Acceso no autorizado');
        }

        // Obtén la información del paciente asociado al usuario autenticado
        $paciente = Paciente::where('idPaciente', $user->id)->first();

        // Devuelve la vista con los datos del paciente
        return view('paciente.index', compact('paciente'));
    }
    public function showLoginForm()
    {
        return view('inicio.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            switch ($user->role) {
                case 'medico':
                    return redirect()->route('medico.index');
                case 'paciente':
                    return redirect()->route('paciente.index');
                case 'secretaria':
                    return redirect()->route('secretaria.index');
                case 'gerente':
                    return redirect()->route('alta_gerencia.index');
                default:
                    return redirect()->route('index'); // Ajusta esto según tus necesidades
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('inicio.registro'); // Esto debería coincidir con el nombre del archivo de vista
    }
       
    public function registro(Request $request)
    {
        Log::info('Iniciando proceso de registro.');
    
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',
                'fechaNacimiento' => 'required_if:role,paciente|nullable|date',
                'telefonoPaciente' => 'required_if:role,paciente|nullable|string|max:255',
                'sexo' => 'required_if:role,paciente|nullable|string|max:255',
                'especialidad' => 'required_if:role,medico|nullable|string|max:255',
                'telefonoMedico' => 'required_if:role,medico|nullable|string|max:255',
            ]);
    
            Log::info('Validación completada.', ['data' => $validated]);
    
            // Crear el usuario
            try {
                Log::info('Creando usuario.');
                $user = User::create([
                    'name' => $request->nombre,
                    'apellido' => $request->apellido,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
    
                Log::info('Usuario creado.', ['user' => $user]);
    
                // Crear una instancia específica según el rol
                if ($request->role == 'paciente') {
                    Log::info('Creando paciente.');
                    $paciente = Paciente::create([
                        'user_id' => $user->id,
                        'fechaNacimiento' => $request->fechaNacimiento,
                        'telefono' => $request->telefonoPaciente,
                        'sexo' => $request->sexo,
                    ]);
    
                    // Crear automáticamente un historial médico vacío para el nuevo paciente
                    HistorialMedico::create([
                        'idPaciente' => $paciente->idPaciente,
                        'nombre_completo' => $user->name . ' ' . $user->apellido,
                        'fecha_nacimiento' => $paciente->fechaNacimiento,
                        'sexo' => $paciente->sexo,
                        'numero_identificacion' => '',
                        'telefono' => $paciente->telefono,
                        'email' => $user->email,
                        'direccion' => '',
                        'contacto_emergencia' => '',
                        'telefono_emergencia' => '',
                        'enfermedades_previas' => '',
                        'intervenciones_quirurgicas' => '',
                        'alergias' => '',
                        'medicamentos_en_uso' => '',
                        'antecedentes_familiares' => '',
                        'fecha_cita' => null,
                        'motivo_cita' => '',
                        'diagnostico' => '',
                        'tratamiento_indicado' => '',
                        'medico' => '',
                        'tipo_examen' => '',
                        'fecha_examen' => null,
                        'resultado_examen' => '',
                        'diagnostico_actual' => '',
                        'objetivos_tratamiento' => '',
                        'recomendaciones' => '',
                        'proxima_cita' => null,
                       ]);
    
                    Log::info('Paciente y historial médico creados.', ['paciente' => $paciente]);
                } elseif ($request->role == 'medico') {
                    Log::info('Creando médico.');
                    $medico = Medico::create([
                        'id_user' => $user->id,
                        'especialidad' => $request->especialidad,
                        'telefono' => $request->telefonoMedico,
                    ]);
    
                    Log::info('Médico creado.', ['medico' => $medico]);
                }
    
                Log::info('Registro completado exitosamente.');
                return redirect()->route('login')->with('status', 'Registro exitoso. Por favor, inicia sesión.');
            } catch (\Exception $e) {
                Log::error('Error durante la creación de registros.', ['error' => $e->getMessage()]);
                return redirect()->back()->with('error', 'Error durante la creación de registros.');
            }
        } catch (\Exception $e) {
            Log::error('Error durante la validación.', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error durante la validación.');
        }
    }
    


    public function showResetForm()
    {
        return view('inicio.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        Password::sendResetLink($request->only('email'));

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}


