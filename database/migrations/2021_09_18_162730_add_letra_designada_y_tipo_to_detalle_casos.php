<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLetraDesignadaYTipoToDetalleCasos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_casos', function (Blueprint $table) {
            $table->string('letra_asignada');
            $table->json('tipos_violacion');
        });
        Schema::table('casos', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_casos', function (Blueprint $table) {
            $table->dropColumn('letra_asignada');
            $table->dropColumn('tipos_violacion');
        });
        Schema::table('casos', function (Blueprint $table) {
            $table->string('tipo');
        });
    }
}
