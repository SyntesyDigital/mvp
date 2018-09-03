<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactFormTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_contact', function (Blueprint $table) {
          $table->increments('id');
          $table->string('firstname');
          $table->string('lastname');
          $table->string('email');
          $table->string('country');
          $table->string('language')->nullable();
          $table->string('company')->nullable();
          $table->string('company_type')->nullable();
          $table->string('occupation')->nullable();
          $table->text('comment')->nullable();
          $table->boolean('privacity');
          $table->boolean('newsletter')->nullable();
          $table->text('programs')->nullable();
          $table->text('program_values')->nullable();
          $table->string('init_program')->nullable();
          $table->string('init_program_value')->nullable();
          $table->enum('type', ['contact','newsletter']);
          $table->timestamps();
        });

        Schema::create('form_contact_selection', function (Blueprint $table) {
          $table->increments('id');
          $table->string('firstname');
          $table->string('lastname');
          $table->string('email');
          $table->string('country')->nullable();
          $table->string('company')->nullable();
          $table->text('comment')->nullable();
          $table->boolean('privacity');
          $table->boolean('newsletter')->nullable();
          $table->boolean('conditions');
          $table->longText('items');
          $table->timestamps();
        });

        Schema::create('form_press', function (Blueprint $table) {
          $table->increments('id');

          $table->string('media_type')->nullable();
          $table->string('media_name')->nullable();
          $table->string('media_distribution')->nullable();
          $table->string('media_country')->nullable();
          $table->string('media_web')->nullable();
          $table->string('media_email')->nullable();
          $table->text('media_comment')->nullable();

          $table->string('firstname');
          $table->string('lastname');
          $table->string('gender')->nullable();
          $table->string('country')->nullable();
          $table->string('occupation')->nullable();
          $table->string('email');
          $table->string('web')->nullable();
          $table->string('language')->nullable();
          $table->timestamp('dateStart')->nullable();
          $table->timestamp('dateEnd')->nullable();
          $table->text('comment')->nullable();

          $table->boolean('privacity');
          $table->boolean('newsletter')->nullable();

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
        Schema::dropIfExists('form_contact');
        Schema::dropIfExists('form_contact_selection');
        Schema::dropIfExists('form_press');
    }
}
