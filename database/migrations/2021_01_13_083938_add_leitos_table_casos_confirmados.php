<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeitosTableCasosConfirmados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
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
        Schema::table('casos_confirmados', function (Blueprint $table) {
            //
        });
    }
}
