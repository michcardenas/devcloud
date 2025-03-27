<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaginaNosotrosTable extends Migration
{
    public function up()
    {
        Schema::create('pagina_nosotros', function (Blueprint $table) {
            $table->id();

            $table->string('tagline1')->nullable();
            $table->string('titulo_h1')->nullable();
            $table->text('contenido1')->nullable();
            $table->string('imagen1')->nullable();

            // Tarjetas 1 a 4
            for ($i = 1; $i <= 4; $i++) {
                $table->string("imagen_tarjeta{$i}")->nullable();
                $table->string("titulo_tarjeta{$i}")->nullable();
                $table->text("contenido_tarjeta{$i}")->nullable();
            }

            $table->string('tagline2')->nullable();
            $table->string('titulo_h2')->nullable();
            $table->text('contenido2')->nullable();
            $table->string('imagen2')->nullable();
            $table->text('contenido_imagen2')->nullable();

            $table->text('mision')->nullable();
            $table->string('imagen_mision')->nullable();
            $table->text('vision')->nullable();
            $table->string('imagen_vision')->nullable();
            $table->text('valores')->nullable();
            $table->string('imagen_valores')->nullable();

            $table->string('tagline3')->nullable();
            $table->string('titulo_h2_principios')->nullable();
            $table->text('contenido_principios')->nullable();

            // Tarjetas 5 a 10
            for ($i = 5; $i <= 10; $i++) {
                $table->string("imagen_tarjeta{$i}")->nullable();
                $table->string("titulo_tarjeta{$i}")->nullable();
                $table->text("contenido_tarjeta{$i}")->nullable();
            }

            $table->string('tagline4')->nullable();
            $table->string('titulo_h2_equipo')->nullable();
            $table->text('contenido_equipo')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagina_nosotros');
    }
}

