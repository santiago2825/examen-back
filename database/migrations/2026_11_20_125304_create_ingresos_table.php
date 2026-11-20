<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string("codigo_ingreso");
            $table->string("habitacion");
            $table->date("fecha");
            $table->timestamps();
            //llave foranea de medico
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')
            ->references('id')
            ->on('medicos')
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ;
            //llave foranea de modulo
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')
            ->references('id')
            ->on('pacientes')
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
