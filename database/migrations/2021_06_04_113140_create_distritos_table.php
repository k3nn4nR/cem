<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->string('id',6)->primary();
            $table->string('id_provincia',4);
            $table->string('id_departamento',2);
            $table->string('descripcion');
            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_provincia')->references('id')->on('provincias')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distritos');
    }
}
