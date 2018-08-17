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
            ->create('programs_categories', function($table) {
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
                $table->foreign('category_id')->references('id')->on('programs_categories')->onDelete('cascade');

                $table->integer('member_id')->nullable()->unsigned();
                $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            });


        // AGENCIES
        Schema::connection('turisme_external')
            ->create('agencies', function($table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->string('address');
                $table->string('postcode');
                $table->string('city');
                $table->string('country');
                $table->string('phone_number');
                $table->string('fax_number')->nullable();
                $table->string('email');
                $table->string('web')->nullable();

                $table->string('BCB_member')->nullable();
                $table->string('receptive')->nullable();
                $table->string('incentive')->nullable();
                $table->string('congresses')->nullable();
                $table->string('validated')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('agencies_categories', function($table) {
                $table->increments('id');
                $table->string('name');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('agencies_categories_pivot', function($table) {
                $table->integer('agency_id')->nullable()->unsigned();
                $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');

                $table->integer('category_id')->nullable()->unsigned();
                $table->foreign('category_id')->references('id')->on('agencies_categories')->onDelete('cascade');
            });

        // COMPANIES
        Schema::connection('turisme_external')
            ->create('entities', function($table) {
                $table->increments('id');
                $table->integer('company_id')->nullable();
                $table->integer('indicator_id')->nullable();
                $table->string('name');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
                $table->string('address')->nullable();
                $table->string('postcode')->nullable();
                $table->string('web')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('indicators', function($table) {
                $table->increments('id');
                $table->integer('indicator_id')->nullable();
                $table->integer('id_axe');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('axes', function($table) {
                $table->increments('id');
                $table->integer('id_axe');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
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


        Schema::connection('turisme_external')->dropIfExists('programs_categories');
        Schema::connection('turisme_external')->dropIfExists('members');
        Schema::connection('turisme_external')->dropIfExists('programs');
        Schema::connection('turisme_external')->dropIfExists('members_programs');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
