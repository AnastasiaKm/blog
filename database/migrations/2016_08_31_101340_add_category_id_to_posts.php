<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('category_id')->nullable()
                  ->after('slug')->unsigned();
            // Because our database system type is InnoDb we dont use foreign key
            // since this type doesnt support it. We will hard code the relations
            // via Laravel and PHP

            // $table    ->foreign('category_id')->references('id')
            //           ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
