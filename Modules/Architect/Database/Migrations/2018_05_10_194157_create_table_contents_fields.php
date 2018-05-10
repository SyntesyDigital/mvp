<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContentsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents_fields', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');

            $table->string('name');
            $table->text('value')->nullable();
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
        Schema::dropIfExists('contents_fields');
    }
}
