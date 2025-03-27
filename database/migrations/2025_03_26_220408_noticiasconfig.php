<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('noticias_configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_seccion')->default('Últimas noticias y artículos');
            $table->string('etiqueta')->default('Blog y Noticias');
            $table->text('descripcion')->default('Mantente al día con las últimas tendencias y novedades sobre Cloud Computing, DevOps y Telecomunicaciones.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticias_configuracion');
    }
};