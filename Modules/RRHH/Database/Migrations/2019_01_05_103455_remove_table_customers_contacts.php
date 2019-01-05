<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTableCustomersContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['customer_contact_id']);
            $table->dropColumn('customer_contact_id');
        });

        Schema::dropIfExists('customers_contacts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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
}
