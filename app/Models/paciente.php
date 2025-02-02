<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $primaryKey = 'idPaciente';

    protected $fillable = [
        'user_id', 'fechaNacimiento', 'telefono', 'sexo',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info('Creating paciente:', ['model' => $model]);
        });

        static::created(function ($model) {
            Log::info('Paciente created:', ['model' => $model]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function citasmedico()
    {
        return $this->hasMany(cita::class, 'paciente_id', 'idPaciente');
    }
    
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'medico_id', 'idMedico');
    }

    public function citas()
    {
        return $this->hasMany(cita::class, 'medico_id', 'idMedico');
    }
    public function historialesMedicos()
    {
        return $this->hasMany(HistorialMedico::class, 'idPaciente', 'idPaciente');
    }
   
}
