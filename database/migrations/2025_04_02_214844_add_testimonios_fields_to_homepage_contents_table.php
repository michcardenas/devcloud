<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestimoniosFieldsToHomepageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->string('testimonios_tag')->nullable();
            $table->string('testimonios_title')->nullable();
            $table->text('testimonios_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->dropColumn('testimonios_tag');
            $table->dropColumn('testimonios_title');
            $table->dropColumn('testimonios_description');
        });
    }
}