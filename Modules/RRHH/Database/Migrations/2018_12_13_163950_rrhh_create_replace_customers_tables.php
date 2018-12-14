<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RrhhCreateReplaceCustomersTables extends Migration
{

    public function up()
    {
        $this->down();

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('customers_fields', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->string('name');
            $table->longText('value')->nullable();
            $table->text('relation')->nullable();

            $table->integer('parent_id')->unsigned()->nullable();

            $table->timestamps();
        });
    }


    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_fields');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
