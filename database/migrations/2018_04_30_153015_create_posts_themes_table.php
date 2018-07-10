<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_themes', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('theme_id')->unsigned();
        	$table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
        	$table->foreign('theme_id')->references('id')->on('themes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_themes');
    }
}
