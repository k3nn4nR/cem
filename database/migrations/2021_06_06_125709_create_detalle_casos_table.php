<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_casos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agresor_dni',8);
            $table->string('comentario');
            $table->timestamps();
            $table->foreign('agresor_dni')->references('dni')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_casos');
    }
}
