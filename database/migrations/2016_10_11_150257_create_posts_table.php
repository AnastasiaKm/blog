<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table){
          $table->increments('id');
          $table->string('name');
          $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table){
          $table->increments('id');
          $table->string('file');
          $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('category_id')->unsigned()->nullable();
          $table->integer('photo_id')->unsigned()->nullable();
          $table->string('slug');
          $table->string('title');
          $table->text('body');
          $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table){
          $table->increments('id');
          $table->string('name');
          $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table){
          $table->increments('id');
          $table->integer('post_id')->unsigned();
          $table->integer('tag_id')->unsigned();
          $table->timestamps();
        });

        Schema::table('posts', function(Blueprint $table) {
          $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
          $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('restrict');
          $table->foreign('photo_id')->references('id')->on('photos')
                ->onDelete('restrict');
        });

        Schema::table('post_tag', function(Blueprint $table) {
          $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
          $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table){
          $table->increments('id');
          $table->text('comment');
          $table->boolean('approved')->nullable();
          $table->integer('post_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->timestamps();
        });

        Schema::table('comments', function(Blueprint $table) {
          $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

      Schema::table('posts', function(Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['category_id']);
        $table->dropForeign(['photo_id']);
      });

      Schema::table('post_tag', function(Blueprint $table) {
        $table->dropForeign(['post_id']);
        $table->dropForeign(['tag_id']);
      });

      Schema::table('comments', function(Blueprint $table) {
        $table->dropForeign(['post_id']);
        $table->dropForeign(['user_id']);
      });

      Schema::drop('categories');
      Schema::drop('photos');
      Schema::drop('posts');
      Schema::drop('tags');
      Schema::drop('post_tag');
      Schema::drop('comments');
    }
}
