<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\AltaGerenciaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistorialMedicoController;
Route::get('/', function () {
   return view('inicio.login'); 
});

// Rutas para médicos
Route::get('/medico', [MedicoController::class, 'index'])->name('medico.index');
Route::post('medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');
Route::post('medico/paciente/{paciente}/prescripcion', [MedicoController::class, 'generarPrescripcionMedica'])->name('medico.generarPrescripcionMedica');
Route::get('/medico/citas', [MedicoController::class, 'showCitas'])->name('medico.citas');
Route::post('medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.historial');
Route::get('/medico/citas', [MedicoController::class, 'showCitas'])->name('medico.citas');
Route::get('/medico/citas', [MedicoController::class, 'showCitas'])->name('medico.citas');
Route::get('/medico/horarios', [MedicoController::class, 'showHorarios'])->name('medico.horarios');
Route::post('/medico/storeHorario', [MedicoController::class, 'storeHorario'])->name('medico.storeHorario');
// Rutas para pacientes
Route::get('/paciente/index', [PacienteController::class, 'index'])->name('paciente.index');
Route::get('/paciente', [PacienteController::class, 'index'])->name('pacientes.index'); // Elimina esta si es redundante
Route::get('paciente/recetas', [PacienteController::class, 'recetas'])->name('paciente.recetas');
Route::get('paciente/examen', [PacienteController::class, 'examen'])->name('paciente.examen');
Route::get('/paciente/agendar_cita', [CitaController::class, 'showForm'])->name('paciente.agendar_cita');
Route::post('/paciente/get_medicos', [CitaController::class, 'getMedicos'])->name('paciente.get_medicos');
Route::post('/paciente/storeCita', [CitaController::class, 'store'])->name('paciente.storeCita');
Route::post('/paciente', [PacienteController::class, 'store'])->name('paciente.store');
Route::get('/paciente/{paciente}', [PacienteController::class, 'show'])->name('paciente.show');
Route::get('/paciente/{paciente}/edit', [PacienteController::class, 'edit'])->name('paciente.edit');
Route::put('/paciente/{paciente}', [PacienteController::class, 'update'])->name('paciente.update');
Route::get('paciente/{paciente}/edit_cita', [PacienteController::class, 'editCita'])->name('paciente.edit_cita');
Route::post('/paciente/get_horarios', [CitaController::class, 'getHorarios'])->name('paciente.get_horarios');
Route::post('medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');
Route::middleware(['auth'])->group(function () {
   Route::get('/medico/horarios', [MedicoController::class, 'showHorarios'])->name('medico.horarios');
   Route::post('/medico/storeHorario', [MedicoController::class, 'storeHorario'])->name('medico.storeHorario');
});
Route::get('medico/paciente/{paciente}/ver_historial', [MedicoController::class, 'verHistorial'])->name('medico.verHistorial');

// Ruta para actualizar el historial médico del paciente
Route::post('medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');
// Rutas para secretarias
Route::get('/secretaria', [SecretariaController::class, 'index'])->name('secretaria.index');

// Rutas para alta gerencia
Route::get('alta_gerencia', [AltaGerenciaController::class, 'index'])->name('alta_gerencia.index');
Route::get('alta_gerencia/dashboard', [AltaGerenciaController::class, 'dashboard'])->name('alta_gerencia.dashboard');
Route::get('alta_gerencia/reportes', [AltaGerenciaController::class, 'reportes'])->name('alta_gerencia.reportes');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
Route::post('/registro', [AuthController::class, 'registro']);

Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/medico/horario', [MedicoController::class, 'showHorarios'])->name('medico.horario');
Route::post('/medico/storeHorario', [MedicoController::class, 'storeHorario'])->name('medico.storeHorario');
Route::get('/paciente/agendar', [CitaController::class, 'showForm'])->name('paciente.showForm');
Route::post('/paciente/get_medicos', [CitaController::class, 'getMedicos'])->name('paciente.get_medicos');
Route::post('/paciente/get_horario', [CitaController::class, 'getHorarios'])->name('paciente.get_horarios');
Route::post('/paciente/storeCita', [CitaController::class, 'store'])->name('paciente.storeCita');
Route::get('/medico/horario', [MedicoController::class, 'showHorarioForm'])->name('medico.horario');
Route::post('/medico/storeHorarios', [MedicoController::class, 'storeHorarios'])->name('medico.storeHorarios');
Route::get('medico/paciente/{paciente}/ver_historial', [MedicoController::class, 'verHistorial'])->name('medico.verHistorial');
Route::get('secretaria/paciente/{paciente}/ver_historial', [SecretariaController::class, 'verHistorial'])->name('secretaria.verHistorial');

// Ruta para que el médico o la secretaria actualicen el historial médico del paciente
Route::match(['get', 'post'], 'medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');
Route::match(['get', 'post'], 'secretaria/paciente/{paciente}/historial', [SecretariaController::class, 'actualizarHistorialMedico'])->name('secretaria.actualizarHistorialMedico');
Route::get('medico/paciente/{paciente}/ver_historial', [MedicoController::class, 'verHistorial'])->name('medico.verHistorial');
Route::get('secretaria/paciente/{paciente}/ver_historial', [SecretariaController::class, 'verHistorial'])->name('secretaria.verHistorial');
Route::post('medico/paciente/{paciente}/historial', [MedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');
Route::post('secretaria/paciente/{paciente}/historial', [SecretariaController::class, 'actualizarHistorialMedico'])->name('secretaria.actualizarHistorialMedico');
Route::get('medico/paciente/{paciente}/historial', [HistorialMedicoController::class, 'verHistorial'])->name('medico.verHistorial');
// Ruta para mostrar el historial médico del paciente
Route::get('paciente/{paciente}/historial', [HistorialMedicoController::class, 'verHistorial'])->name('historial.ver');
Route::get('medico/paciente/{paciente}/historial', [HistorialMedicoController::class, 'verHistorial'])->name('medico.verHistorial');
Route::put('/medico/actualizarHistorial/{pacienteId}', [HistorialMedicoController::class, 'actualizarHistorialMedico'])->name('medico.actualizarHistorialMedico');

Route::get('/medico/editarHistorial/{pacienteId}', [HistorialMedicoController::class, 'editarHistorial'])->name('medico.editarHistorial');


// Ruta para actualizar el historial médico del paciente
Route::post('paciente/{paciente}/historial', [HistorialMedicoController::class, 'actualizarHistorialMedico'])->name('historial.actualizar');