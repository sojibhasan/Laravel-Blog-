<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('meta_key');
            $table->string('copyright');
            $table->string('street');
            $table->integer('post_code');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('header_logo');
            $table->string('footer_logo');
            $table->string('favicon');
            $table->string('preloader');
            $table->string('google_analytics_id');
            $table->string('publisher_id');
            $table->string('google_map');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
