<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('contenido');
            $table->string('imagen')->nullable();
            $table->date('fecha_publicacion');
            $table->integer('tiempo_lectura')->default(5); // Tiempo de lectura en minutos
            $table->boolean('publicada')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticias');
    }
};