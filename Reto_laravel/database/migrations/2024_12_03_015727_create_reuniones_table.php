<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_reuniones_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionesTable extends Migration
{
    public function up(): void
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');   
            $table->unsignedBigInteger('profesor_id'); 
            $table->dateTime('fecha');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reuniones');
    }
}
