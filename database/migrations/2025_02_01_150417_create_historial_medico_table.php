<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historialmedico', function (Blueprint $table) {
            $table->id('idHistorial');
            $table->unsignedBigInteger('idPaciente');
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->string('numero_identificacion');
            $table->string('telefono');
            $table->string('correo_electronico');
            $table->string('direccion');
            $table->string('contacto_emergencia');
            $table->string('telefono_emergencia');
            $table->text('enfermedades_previas')->nullable();
            $table->text('intervenciones_quirurgicas')->nullable();
            $table->text('alergias')->nullable();
            $table->text('medicamentos_en_uso')->nullable();
            $table->text('antecedentes_familiares')->nullable();
            $table->date('fecha_cita')->nullable();
            $table->text('motivo_cita')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento_indicado')->nullable();
            $table->string('medico')->nullable();
            $table->string('tipo_examen')->nullable();
            $table->date('fecha_examen')->nullable();
            $table->text('resultado_examen')->nullable();
            $table->date('fecha_nota')->nullable();
            $table->string('medico_nota')->nullable();
            $table->text('notas')->nullable();
            $table->text('diagnostico_actual')->nullable();
            $table->text('objetivos_tratamiento')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->string('firma_paciente')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->timestamps();

            $table->foreign('idPaciente')->references('idPaciente')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_medico');
    }
}

