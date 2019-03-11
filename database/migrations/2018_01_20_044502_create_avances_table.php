<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avances', function (Blueprint $table) {
			//$table->increments('id'); se elimina
			$table->integer('user_id')->unsigned();
            $table->integer('suma_horas');
            $table->decimal('porcentaje', 8, 2);
            $table->timestamps();
        });
		Schema::table('avances', function($table) {
       $table->foreign('user_id')->references('id')->on('users');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avances');
    }
}
