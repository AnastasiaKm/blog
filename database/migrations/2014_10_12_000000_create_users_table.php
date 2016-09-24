<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('photo_id')->nullable()->unsigned();
            $table->integer('is_active')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('roles', function (Blueprint $table){
          $table->increments('id');
          $table->string('name');
          $table->timestamps();
        });

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

        Schema::table('users', function(Blueprint $table) {
          $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('photo_id')->references('id')->on('photos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('posts', function (Blueprint $table){
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
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('photo_id')->references('id')->on('photos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('post_tag', function(Blueprint $table) {
          $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')->onUpdate('cascade');
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
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
          $table->dropForeign(['role_id']);
          $table->dropForeign(['photo_id']);
        });

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

        Schema::drop('users');
        Schema::drop('roles');
        Schema::drop('categories');
        Schema::drop('photos');
        Schema::drop('posts');
        Schema::drop('tags');
        Schema::drop('post_tag');
        Schema::drop('comments');
    }
}
