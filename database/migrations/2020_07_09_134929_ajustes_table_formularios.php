<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AjustesTableFormularios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formularios', function (Blueprint $table) {
            $table->dropColumn(['hospitalizados']); 
            $table->dropColumn(['testesRealizados']); 
            $table->integer('testesRapidoRealizados');
            $table->integer('testesPcrRealizados');
            $table->integer('total_leitos_clinicos');
            $table->integer('leitos_clinicos_em_uso');
            $table->integer('total_leitos_uti');
            $table->integer('leitos_uti_em_uso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formularios', function (Blueprint $table) {
            //
        });
    }
}
