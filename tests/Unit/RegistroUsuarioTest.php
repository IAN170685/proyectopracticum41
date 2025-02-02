<?php


namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistroUsuarioTest extends TestCase
{
    use RefreshDatabase; // Refresca la base de datos para cada prueba

    /** @test */
    public function puede_registrar_un_usuario()
    {
        // Datos de ejemplo para el usuario
        $data = [
            'name' => 'Juan Pérez',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'password' => bcrypt('password123'),
            'role' => 'medico',
        ];

        // Crear el usuario
        $user = User::create($data);

        // Verificar que el usuario fue creado
        $this->assertDatabaseHas('users', [
            'email' => 'juan.perez@example.com',
        ]);
    }
}

