<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->string('email');
            $table->string('nickname');
            $table->string('site');
            $table->integer('like')->default(0)->unsigned();
            $table->integer('comment_id')->default(0)->unsigned();
            $table->integer('article_id')->unsigned();
            $table->timestamps();

            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
