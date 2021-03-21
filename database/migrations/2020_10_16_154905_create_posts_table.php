<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('visitor');
            $table->string('slug');
            $table->text('summery');
            $table->longText('content');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->string('image');
            $table->string('alt');
            $table->string('meta_des');
            $table->string('meta_key');
            $table->string('tag_id');
            $table->integer('status');
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
        Schema::dropIfExists('posts');
    }
}
