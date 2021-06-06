<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('dni',8)->unique();
            $table->string('ape_paterno');
            $table->string('ape_materno');
            $table->string('nombres');
            $table->integer('edad');
            $table->string('celular',9)->unique()->nullable();
            $table->string('nivel_riesgo')->nullable();
            $table->timestamps();
            $table->primary('dni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
