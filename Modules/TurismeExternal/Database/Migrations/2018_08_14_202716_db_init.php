<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('turisme_external')
            ->create('members', function($table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->string('address');
                $table->string('postcode');
                $table->string('city');
                $table->string('phone_number');
                $table->string('email');
                $table->string('web')->nullable();
                $table->string('logo')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('programs', function($table) {
                $table->increments('id');
                $table->string('code');
                $table->string('description_ca')->nullable();
                $table->string('description_es')->nullable();
                $table->string('description_en')->nullable();
            });


        Schema::connection('turisme_external')
            ->create('categories', function($table) {
                $table->increments('id');
                $table->string('code');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();

                $table->integer('program_id')->unsigned();
                $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            });

        Schema::connection('turisme_external')
            ->create('members_programs', function($table) {
                $table->integer('program_id')->nullable()->unsigned();
                $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');

                $table->integer('category_id')->nullable()->unsigned();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

                $table->integer('member_id')->nullable()->unsigned();
                $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::connection('turisme_external')->dropIfExists('members');
        Schema::connection('turisme_external')->dropIfExists('categories');
        Schema::connection('turisme_external')->dropIfExists('programs');
        Schema::connection('turisme_external')->dropIfExists('members_programs');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
