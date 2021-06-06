<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ficha')->unique();
            $table->string('denunciante_dni',8);
            $table->date('fecha_caso');
            $table->string('tipo');
            $table->string('vinculo');
            $table->string('lugar');
            $table->string('medida')->nullable();
            $table->string('observacion_abogado')->nullable();
            $table->timestamps();
            $table->foreign('denunciante_dni')->references('dni')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casos');
    }
}
