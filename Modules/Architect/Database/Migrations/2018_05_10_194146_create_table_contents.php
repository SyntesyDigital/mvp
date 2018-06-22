<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContents extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('definition')->nullable();
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('typology_id')->nullable()->unsigned();
            $table->foreign('typology_id')->references('id')->on('typologies');

            $table->integer('page_id')->nullable()->unsigned();
            $table->foreign('page_id')->references('id')->on('pages');

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');

            $table->string('status');


            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('contents');
        Schema::dropIfExists('pages');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
