<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExternalApiDbInit extends Migration
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
                $table->integer('id')->unsigned();
                $table->string('name');
                $table->string('address');
                $table->string('postcode');
                $table->string('city');
                $table->string('country');
                $table->string('phone_number');
                $table->string('fax_number')->nullable();
                $table->string('email');
                $table->string('web')->nullable();

                $table->integer('BCB_member')->nullable();
                $table->string('receptive')->nullable();
                $table->string('incentive')->nullable();
                $table->string('congresses')->nullable();
                $table->string('validated')->nullable();

                $table->primary('id');
            });

        Schema::connection('turisme_external')
            ->create('agencies_categories', function($table) {
                $table->integer('id')->unsigned();
                $table->string('description_ca')->nullable();
                $table->string('description_es')->nullable();
                $table->string('description_en')->nullable();

                $table->primary('id');
            });

        Schema::connection('turisme_external')
            ->create('agencies_categories_pivot', function($table) {
                $table->integer('agency_id')->nullable()->unsigned();
                $table->foreign('agency_id')->references('id')->on('agencies');

                $table->integer('category_id')->nullable()->unsigned();
                $table->foreign('category_id')->references('id')->on('agencies_categories');
            });

        // COMPANIES
        Schema::connection('turisme_external')
            ->create('companies', function($table) {
                $table->integer('id')->unique();
                $table->primary('id');
                $table->integer('indicator_id')->nullable();
                $table->string('name');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('postcode')->nullable();
                $table->string('web')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('indicators', function($table) {
                $table->integer('id')->unique();
                $table->primary('id');
                $table->integer('axe_id');
                $table->longText('description_ca')->nullable();
                $table->longText('description_es')->nullable();
                $table->longText('description_en')->nullable();
            });

        Schema::connection('turisme_external')
            ->create('axes', function($table) {
                $table->integer('id')->unique();
                $table->primary('id');
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
        Schema::connection('turisme_external')->disableForeignKeyConstraints();

        Schema::connection('turisme_external')->dropIfExists('members');
        Schema::connection('turisme_external')->dropIfExists('programs');
        Schema::connection('turisme_external')->dropIfExists('programs_categories');
        Schema::connection('turisme_external')->dropIfExists('members_programs');

        Schema::connection('turisme_external')->dropIfExists('agencies');
        Schema::connection('turisme_external')->dropIfExists('agencies_categories');
        Schema::connection('turisme_external')->dropIfExists('agencies_categories_pivot');

        Schema::connection('turisme_external')->dropIfExists('axes');
        Schema::connection('turisme_external')->dropIfExists('indicators');
        Schema::connection('turisme_external')->dropIfExists('companies');

        Schema::connection('turisme_external')->enableForeignKeyConstraints();
    }
}
