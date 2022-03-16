<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MudarTableCasosConfirmados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
            $table->dropColumn(['exameInconclusivo']);
            $table->integer('hospitalizados');
            $table->integer('analfabeto');
            $table->integer('ensino_fundamental');
            $table->integer('ensino_medio');
            $table->integer('ensino_superior');
            $table->integer('branca');
            $table->integer('parda');
            $table->integer('preta');
            $table->integer('amarela');
            $table->integer('indigena');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
