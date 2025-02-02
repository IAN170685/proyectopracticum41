<?php

use Illuminate\Database\Seeder;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Cita;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear médicos de prueba si no existen
        if (!Medico::where('correo', 'juan.perez@hospital.com')->exists()) {
            Medico::create([
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'especialidad' => 'Cardiología',
                'telefono' => '123456789',
                'correo' => 'juan.perez@hospital.com',
            ]);
        }

        // Crear pacientes de prueba si no existen
        if (!Paciente::where('correo', 'ana.gomez@gmail.com')->exists()) {
            Paciente::create([
                'nombrePaciente' => 'Ana',
                'apellidoPaciente' => 'Gómez',
                'fechaNacimiento' => '1985-05-20',
                'telefono' => '987654321',
                'correo' => 'ana.gomez@gmail.com',
                'sexo' => 'femenino',
            ]);
        }

        // Crear citas de prueba si no existen
        if (!Cita::where('fecha', '2025-01-20')->where('hora', '10:00')->exists()) {
            Cita::create([
                'paciente_id' => 1,
                'medico_id' => 1,
                'fecha' => '2025-01-20',
                'hora' => '10:00',
            
            ]);
        }
    }
}

