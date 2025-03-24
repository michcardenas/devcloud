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
        Schema::table('servicios_pages', function (Blueprint $table) {
            $table->string('tagline4')->nullable();
            $table->string('imagen1')->nullable();
            $table->string('tagline5')->nullable();
            $table->string('imagen2')->nullable();
            $table->string('sub4_h2')->nullable();
            $table->text('contenido_5')->nullable();
            $table->string('tagline6')->nullable();
            $table->string('imagen3')->nullable();
            $table->string('sub5_h2')->nullable();
            $table->text('contenido_6')->nullable(); // corrijo el número
            $table->string('tagline7')->nullable();
            $table->string('imagen4')->nullable();
            $table->string('sub6_h2')->nullable();
            $table->text('contenido_7')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios_pages', function (Blueprint $table) {
            $table->dropColumn([
                'tagline4', 'imagen1',
                'tagline5', 'imagen2',
                'sub4_h2', 'contenido_5',
                'tagline6', 'imagen3',
                'sub5_h2', 'contenido_6',
                'tagline7', 'imagen4',
                'sub6_h2', 'contenido_7',
            ]);
        });
    }
};
