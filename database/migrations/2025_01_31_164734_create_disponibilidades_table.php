<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadesTable extends Migration
{
    public function up()
    {
        Schema::create('disponibilidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_id');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();

            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('disponibilidades');
    }
}

