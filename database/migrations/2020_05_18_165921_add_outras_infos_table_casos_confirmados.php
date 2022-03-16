<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOutrasInfosTableCasosConfirmados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
            $table->integer('suspeitos');
            $table->integer('testesNegativos');
            $table->integer('exameInconclusivo');
            $table->integer('positivoOutrasCidades');
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
