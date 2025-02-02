<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('idCita');
            $table->foreignId('paciente_id')->constrained('pacientes', 'idPaciente')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos', 'idMedico')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('citas');
    }
};

