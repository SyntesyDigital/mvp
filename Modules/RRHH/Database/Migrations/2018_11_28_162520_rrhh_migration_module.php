<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RrhhMigrationModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });


        Schema::create('site_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier');
            $table->string('name');
            $table->string('type');
            $table->text('value')->nullable(); // FIXME : JSON
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->integer('recipient_id')->unsigned();
            $table->timestamps();
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('offers_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('value')->nullable();
            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });

        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('civility');
            $table->text('resume_file')->nullable();
            $table->text('registration_number')->nullable();
            $table->text('number');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('done_at')->nullable();
            $table->integer('offer_id')->unsigned()->nullable();
            $table->integer('candidate_id')->unsigned();
            $table->text('type');
            $table->text('status');
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
        });

        Schema::create('candidates_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags_offers')->onDelete('cascade');
        });
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('recommendation_letter')->after('resume_file')->nullable();
            $table->string('type')->nullable();
            $table->date('registered_at')->after('registration_number')->nullable();
            $table->dropColumn('number');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->after('email')->nullable();
        });

        Schema::create('offers_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags_offers')->onDelete('cascade');
        });
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');

            $table->index(['queue', 'reserved_at']);
        });

        Schema::create('emails_templates', function ($table) {
            $table->increments('id');
            $table->string('identifier');
            $table->text('subject');
            $table->longText('body');
            $table->timestamps();
        });

        Schema::create('alerts_candidates', function ($table) {
            $table->increments('id');

            $table->string('status')->default('PENDING');
            $table->dateTime('sent_at')->nullable();
            $table->integer('offer_id')->unsigned();
            $table->integer('candidate_id')->unsigned();

            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
        });
        Schema::table('candidates', function (Blueprint $table) {
            $table->text('address')->after('type')->nullable();
            $table->string('location')->after('address')->nullable();
            $table->string('postal_code')->after('location')->nullable();
            $table->string('country')->after('postal_code')->nullable();
            $table->date('birthday')->after('country')->nullable();
            $table->text('birthplace')->after('birthday')->nullable();
            $table->longText('message')->after('birthplace')->nullable();
        });
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('job_1')->after('message')->nullable();
            $table->string('job_2')->after('job_1')->nullable();
            $table->string('job_3')->after('job_2')->nullable();
            $table->longText('comment')->after('job_3')->nullable();
        });
        Schema::create('agences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('agence_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('agence_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('agence_id')->references('id')->on('agences')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'agence_id']);
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('contact_firstname')->nullable();
            $table->text('contact_lastname')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('postal_code')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->integer('customer_id')->after('recipient_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
        Schema::table('agences', function (Blueprint $table) {
            $table->renameColumn('title', 'meta_title');
            $table->renameColumn('description', 'meta_description');
            $table->dropColumn('location');
            $table->text('name')->nullable();
            $table->longText('content')->nullable();
        });
        Schema::table('agences', function (Blueprint $table) {
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
        });
        Schema::create('customers_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();

            $table->string('title');
            $table->string('firstname');
            $table->string('lastname')->nullable();

            $table->string('function')->nullable();
            $table->string('service')->nullable();

            $table->string('email')->nullable();
            $table->string('email_2')->nullable();

            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();

            $table->string('fax')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->integer('customer_contact_id')->after('customer_id')->unsigned()->nullable();
            $table->foreign('customer_contact_id')->references('id')->on('customers_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('tags_offers');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('site_lists');
        Schema::dropIfExists('candidates_tags');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('offers_fields');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('offers_tags');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('emails_templates');
        Schema::dropIfExists('alerts_candidates');
        Schema::dropIfExists('agence_user');
        Schema::dropIfExists('agences');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_contacts');
        Schema::enableForeignKeyConstraints();
    }
}
