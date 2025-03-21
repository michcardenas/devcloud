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
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            
            // Sección Hero
            $table->string('hero_tagline')->nullable();
            $table->string('hero_title_1')->nullable();
            $table->string('hero_title_2')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_bg_image')->nullable();
            
            // Estadísticas
            $table->string('stat_projects')->nullable();
            $table->string('stat_clients')->nullable();
            $table->string('stat_experts')->nullable();
            $table->string('stat_years')->nullable();
            
            // Sección Servicios
            $table->string('services_tag')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_description')->nullable();
            $table->json('services')->nullable(); // Almacenará los 3 servicios como JSON
            
            // Sección Contacto
            $table->string('contact_tag')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};