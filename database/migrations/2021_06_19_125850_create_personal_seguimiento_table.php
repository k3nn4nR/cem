<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_seguimiento', function (Blueprint $table) {
            $table->unsignedBigInteger('seguimiento_id');
            $table->string('personal_id');
            $table->string('comentario');
            $table->foreign('seguimiento_id')->references('id')->on('seguimientos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_seguimiento');
    }
}
