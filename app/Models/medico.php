<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';
    protected $primaryKey = 'idMedico';

    protected $fillable = [
        'id_user', 'especialidad', 'telefono', 'email',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info('Creating medico:', ['model' => $model]);
        });

        static::created(function ($model) {
            Log::info('Medico created:', ['model' => $model]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'medico_id', 'idMedico');
    }
    public function citas()
    {
        return $this->hasMany(Cita::class, 'medico_id');
    }
}

