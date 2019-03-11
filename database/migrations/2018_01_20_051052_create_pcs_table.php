<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcs', function (Blueprint $table) {
			$table->integer('item_id')->unsigned();
            $table->string('num_maquina');
            $table->string('perifericos');
            $table->string('funciona');
            $table->string('num_serie_cpu');
            $table->string('ram');
            $table->string('disco_duro');
            $table->string('sistema_operativo');
            $table->string('sistema_operativo_activado');
            $table->string('cable_vga');
            $table->string('funciona_monitor');
            $table->string('detalle_monitor');
            $table->string('num_serie_monitor');
            $table->string('detalle_teclado');
            $table->string('detalle_raton');
            $table->string('controlador_red');
            $table->string('paq_office_version');
            $table->string('paq_office_activado');
			$table->string('observaciones');
            $table->timestamps();
        });
		Schema::table('pcs', function($table) {
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
        Schema::dropIfExists('pcs');
    }
}
