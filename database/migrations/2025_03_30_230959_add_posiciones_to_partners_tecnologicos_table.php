<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('partner_tecnologicos', function (Blueprint $table) {
            $table->string('posicion1')->nullable();
            $table->string('posicion2')->nullable();
            $table->string('posicion3')->nullable();
            $table->string('posicion4')->nullable();
            $table->string('posicion5')->nullable();
            $table->string('posicion6')->nullable();
            $table->string('posicion7')->nullable();
            $table->string('posicion8')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('partner_tecnologicos', function (Blueprint $table) {
            $table->dropColumn([
                'posicion1', 'posicion2', 'posicion3', 'posicion4',
                'posicion5', 'posicion6', 'posicion7', 'posicion8',
            ]);
        });
    }
    
};
