<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $response = $this->post('/register', [
            'nombre' => 'John',
            'apellido' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'rol' => 'paciente',
            'fechaNacimiento' => '1990-01-01',
            'telefono' => '1234567890',
            'sexo' => 'M',
        ]);

        $response->assertStatus(302); // Redirige después del registro exitoso
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);
    }

    public function test_login()
    {
        $user = User::create([
            'nombre' => 'John',
            'apellido' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'paciente',
        ]);

        $response = $this->post('/login', [
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302); // Redirige después del inicio de sesión exitoso
        $this->assertAuthenticatedAs($user);
    }
}
