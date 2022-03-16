<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoverSuspeitosEHospitalizadosTableCasosConfirmados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
            $table->dropColumn(['hospitalizados']); 
            $table->dropColumn(['suspeitos']); 
            $table->integer('nao_aplicado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
            //
        });
    }
}
