<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partner_tecnologicos', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('h2')->nullable();
            $table->text('contenido')->nullable();
            $table->string('posicion')->nullable(); // platinum, gold, silver

            for ($i = 1; $i <= 8; $i++) {
                $table->string("logo{$i}")->nullable();
                $table->string("titulo_tarjeta{$i}")->nullable();
                $table->string("tag{$i}")->nullable();
            }

            $table->string('tagline2')->nullable();
            $table->string('h2_2')->nullable();
            $table->text('contenido2')->nullable();

            for ($j = 1; $j <= 3; $j++) {
                $table->string("titulo_tarjeta_eco{$j}")->nullable();
                $table->string("subtitulo_eco{$j}")->nullable();
                $table->text("lista_tarjeta_eco{$j}")->nullable();
            }

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_tecnologicos');
    }
};
