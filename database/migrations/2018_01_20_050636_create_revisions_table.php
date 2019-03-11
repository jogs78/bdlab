<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('lugar_id')->unsigned();
            //$table->timestamp('hora_fecha_revision');
            $table->timestamps();
        });
		Schema::table('revisions', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('revisions', function($table) {
           $table->foreign('lugar_id')->references('id')->on('lugars');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisions');
    }
}
