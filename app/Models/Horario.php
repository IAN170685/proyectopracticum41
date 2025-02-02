<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'medico_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id', 'idMedico');
    }
}

