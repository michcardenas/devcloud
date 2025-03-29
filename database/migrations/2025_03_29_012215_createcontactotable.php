<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->id();
            
            // Sección Hablemos de tu proyecto
            $table->string('contact_tag')->default('Contacto');
            $table->string('contact_title')->default('Hablemos de tu proyecto');
            $table->text('contact_description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();
            
            // Sección Resolvemos tus dudas
            $table->string('faq_button_text')->default('Preguntas frecuentes');
            $table->string('faq_title')->default('Resolvemos tus dudas');
            $table->text('faq_description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacto');
    }
};