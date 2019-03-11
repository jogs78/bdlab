<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
			$table->integer('lugar_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();
        });
		Schema::table('existencias', function($table) {
	        $table->foreign('lugar_id')->references('id')->on('lugars');
       });

	   Schema::table('existencias', function($table) {
	     $table->foreign('item_id')->references('id')->on('items');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('existencias');
    }
}
