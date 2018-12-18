<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCandidats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function($table){
            $table->string('contract_type')->nullale();
            $table->string('salary')->nullale();
            $table->string('important_information')->nullale();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function($table){
            $table->dropColumn('contract_type');
            $table->dropColumn('salary');
            $table->dropColumn('important_information');
        });
    }
}
