<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenuOrderSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
          $table->longText('settings')->nullable()->default('NULL');
        });

        Schema::table('menus_elements', function (Blueprint $table) {
          $table->longText('settings')->nullable()->default('NULL');
          $table->integer('order')->nullable()->default('NULL');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function($table){
            $table->dropColumn('settings');
        });

        Schema::table('menus_elements', function($table){
          $table->dropColumn('settings');
          $table->dropColumn('order');
        });
    }
}
