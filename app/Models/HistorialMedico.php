<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historialmedico';  // Nombre de la tabla

    protected $primaryKey = 'idHistorial';  // Clave primaria

    protected $fillable = [
        'idPaciente',
        'nombre_completo',
        'fecha_nacimiento',
        'sexo',
        'numero_identificacion',
        'telefono',
        'email',
        'direccion',
        'contacto_emergencia',
        'telefono_emergencia',
        'enfermedades_previas',
        'intervenciones_quirurgicas',
        'alergias',
        'medicamentos_en_uso',
        'antecedentes_familiares',
        'fecha_cita',
        'motivo_cita',
        'diagnostico',
        'tratamiento_indicado',
        'medico',
        'tipo_examen',
        'fecha_examen',
        'resultado_examen',
        'fecha_nota',
        'objetivos_tratamiento',
        'recomendaciones',
        'proxima_cita',
        'fecha_registro',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente', 'idPaciente');
    }
}


