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
            $table->string('ficha');
            $table->string('denunciante_dni',8);
            $table->date('fecha_caso');
            $table->string('tipo');
            $table->string('turno');
            $table->string('distrito')->nullable();
            $table->string('lugar');
            $table->string('medida')->nullable();
            $table->string('observacion_abogado')->nullable();
            $table->string('estado')->default('ACTIVO');
            $table->timestamps();
            $table->primary('ficha');
            $table->foreign('denunciante_dni')->references('dni')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('distrito')->references('id')->on('distritos')->onDelete('cascade')->onUpdate('cascade');
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
