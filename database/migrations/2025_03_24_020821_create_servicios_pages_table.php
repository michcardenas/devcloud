<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosPagesTable extends Migration
{
    public function up()
    {
        Schema::create('servicios_pages', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('titulo_h1')->nullable();
            $table->text('p_contenido')->nullable();
            $table->string('tagline2')->nullable();
            $table->string('sub_h2')->nullable();
            $table->text('contenido_2')->nullable();
            $table->string('tagline3')->nullable();
            $table->string('sub2_h2')->nullable();
            $table->text('contenido_3')->nullable();

            // Atributos bloque 1
            $table->string('titulo_atributo1_1')->nullable();
            $table->text('contenido_atributo1_1')->nullable();
            $table->string('imagen_atributo1_1')->nullable();
            $table->string('titulo_atributo2_1')->nullable();
            $table->text('contenido_atributo2_1')->nullable();
            $table->string('imagen_atributo2_1')->nullable();
            $table->string('titulo_atributo3_1')->nullable();
            $table->text('contenido_atributo3_1')->nullable();
            $table->string('imagen_atributo3_1')->nullable();
            $table->string('titulo_atributo4_1')->nullable();
            $table->text('contenido_atributo4_1')->nullable();
            $table->string('imagen_atributo4_1')->nullable();

            // Atributos bloque 2
            $table->string('titulo_atributo1_2')->nullable();
            $table->text('contenido_atributo1_2')->nullable();
            $table->string('imagen_atributo1_2')->nullable();
            $table->string('titulo_atributo2_2')->nullable();
            $table->text('contenido_atributo2_2')->nullable();
            $table->string('imagen_atributo2_2')->nullable();
            $table->string('titulo_atributo3_2')->nullable();
            $table->text('contenido_atributo3_2')->nullable();
            $table->string('imagen_atributo3_2')->nullable();
            $table->string('titulo_atributo4_2')->nullable();
            $table->text('contenido_atributo4_2')->nullable();
            $table->string('imagen_atributo4_2')->nullable();

            // Atributos bloque 3
            $table->string('titulo_atributo1_3')->nullable();
            $table->text('contenido_atributo1_3')->nullable();
            $table->string('imagen_atributo1_3')->nullable();
            $table->string('titulo_atributo2_3')->nullable();
            $table->text('contenido_atributo2_3')->nullable();
            $table->string('imagen_atributo2_3')->nullable();
            $table->string('titulo_atributo3_3')->nullable();
            $table->text('contenido_atributo3_3')->nullable();
            $table->string('imagen_atributo3_3')->nullable();
            $table->string('titulo_atributo4_3')->nullable();
            $table->text('contenido_atributo4_3')->nullable();
            $table->string('imagen_atributo4_3')->nullable();

            $table->string('sub3_h2')->nullable();
            $table->text('contenido_4')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicios_pages');
    }
}
