<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->boolean('success');
            $table->text('error_message')->nullable();
            $table->string('facebook_id', 50)->nullable();
            $table->dateTime('published_at')->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
			$table->foreign('channel_id')->references('id')->on('channels')->onDelete('CASCADE');
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
        Schema::dropIfExists('publications');
    }
}
