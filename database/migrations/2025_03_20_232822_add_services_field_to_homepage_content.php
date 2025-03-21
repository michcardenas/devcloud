<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicesFieldToHomepageContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage_content', function (Blueprint $table) {
            // Agregar campo services como JSON si no existe
            if (!Schema::hasColumn('homepage_content', 'services')) {
                $table->json('services')->nullable()->after('services_description');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage_content', function (Blueprint $table) {
            // Eliminar campo si existe
            if (Schema::hasColumn('homepage_content', 'services')) {
                $table->dropColumn('services');
            }
        });
    }
}