<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrensaTable2 extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prensa', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->string('categoria');
            $table->string('subtipo')->nullable();
            $table->date('fecha');
            $table->text('descripcion');
            $table->string('url')->nullable();
            $table->string('imagen')->nullable();
            $table->string('pdf_url')->nullable();
            $table->boolean('destacado')->default(false);
            $table->timestamps();
        });

        Schema::create('prensa_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('prensa_subtipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('prensa_categorias')
                ->onDelete('cascade');
        });

        Schema::create('prensa_recursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('formato', 10);
            $table->string('tamano');
            $table->string('url');
            $table->integer('orden')->default(1);
            $table->timestamps();
        });

        Schema::create('prensa_configuracion', function (Blueprint $table) {
            $table->id();
            // Banner principal
            $table->string('banner_etiqueta');
            $table->string('banner_titulo');
            $table->text('banner_subtitulo');
            
            // Sección de recursos
            $table->string('seccion_etiqueta');
            $table->string('seccion_titulo');
            $table->text('seccion_subtitulo');
            
            // Títulos de las secciones
            $table->string('notas_prensa_titulo');
            $table->string('apariciones_titulo');
            $table->string('recursos_titulo');
            
            // Textos de contacto
            $table->string('contacto_titulo');
            $table->text('contacto_descripcion');
            $table->string('contacto_email');
            $table->string('contacto_telefono');
            
            // Textos del formulario de suscripción
            $table->string('suscripcion_titulo');
            $table->text('suscripcion_descripcion');
            $table->string('suscripcion_placeholder');
            $table->text('suscripcion_consentimiento');
            $table->string('suscripcion_boton');
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            $table->timestamps();
        });

        Schema::create('prensa_suscriptores', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->datetime('fecha_suscripcion');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prensa_suscriptores');
        Schema::dropIfExists('prensa_configuracion');
        Schema::dropIfExists('prensa_recursos');
        Schema::dropIfExists('prensa_subtipos');
        Schema::dropIfExists('prensa_categorias');
        Schema::dropIfExists('prensa');
    }
}