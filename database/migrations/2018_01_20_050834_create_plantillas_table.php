<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas', function (Blueprint $table) {
			$table->integer('lugar_id')->unsigned();
            $table->string('clasificacion');
            $table->integer('cantidad');
            $table->timestamps();
        });
		Schema::table('plantillas', function($table) {
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
        Schema::dropIfExists('plantillas');
    }
}
