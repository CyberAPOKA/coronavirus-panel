<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeitosUpaToCasosConfirmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casos_confirmados', function (Blueprint $table) {
            $table->integer('total_leitos_upa');
            $table->integer('leitos_upa_em_uso');
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
