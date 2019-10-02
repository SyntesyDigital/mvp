<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAuthorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('medias', function($table){
            $table->dropForeign('medias_author_id_foreign');
            $table->dropColumn('author_id');
        });

        Schema::table('contents', function($table){
            $table->dropForeign('contents_author_id_foreign');
            $table->dropColumn('author_id');
        });


        Schema::dropIfExists('users');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->text('language')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('medias', function($table){
            $table->integer('author_id')->unsigned()->after('metadata');
            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::table('contents', function($table){
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
        });

    }
}
