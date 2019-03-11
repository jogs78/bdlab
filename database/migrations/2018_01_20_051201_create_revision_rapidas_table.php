<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionRapidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_rapidas', function (Blueprint $table) {
			$table->integer('revision_id')->unsigned();
            $table->string('clasificacion');
            $table->integer('cantidad');
			$table->string('observaciones');
            $table->timestamps();
        });
		Schema::table('revision_rapidas', function($table) {
            $table->foreign('revision_id')->references('id')->on('revisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision_rapidas');
    }
}
