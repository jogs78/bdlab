<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
			$table->time('hora_llegada');
			$table->time('hora_salida');
			$table->integer('horas_realizadas'); //en este campo realizaria una consulta para sumar las horas
            //$table->timestamps();
        });
		Schema::table('asistencias', function($table) {
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
        Schema::dropIfExists('asistencias');
    }
}
