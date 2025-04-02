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
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_slug', 255)->unique()->comment('Slug o identificador de la página, ej: servicios-cloud');
            
            // Metaetiquetas básicas
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_robots', 100)->default('index, follow');
            
            // Canónica
            $table->string('canonical_url', 255)->nullable();
            
            // Open Graph
            $table->string('og_title', 255)->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image', 255)->nullable();
            $table->string('og_type', 50)->default('website');
            $table->string('og_url', 255)->nullable();
            $table->string('og_site_name', 100)->nullable();
            $table->string('og_locale', 10)->default('es_CO');
            
            // Twitter Card
            $table->string('twitter_card', 50)->default('summary_large_image');
            $table->string('twitter_title', 255)->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image', 255)->nullable();
            $table->string('twitter_image_alt', 255)->nullable();
            $table->string('twitter_site', 100)->nullable();
            $table->string('twitter_creator', 100)->nullable();
            
            // Idioma del contenido
            $table->string('language_code', 10)->default('es');
            
            // Tiempos de auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_metadata');
    }
};