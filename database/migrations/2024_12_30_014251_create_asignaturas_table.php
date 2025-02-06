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
        Schema::create('asignaturas', function (Blueprint $table) {

            $table->id();
           // $table->foreignId('ciclo_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->unsignedBigInteger('curso_id');  

            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->tinyInteger('es_comun')->default(0);
            $table->timestamps();
           // $table->string('nomb_asignatura');
           // $table->timestamps();
          //$table->foreign('ciclo_id')->references('id')->on('ciclos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};
