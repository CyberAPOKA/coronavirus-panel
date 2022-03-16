<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaTabelaObitosFaixaEtaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('obitos_faixa_etaria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ate1ano');
            $table->integer('de1a4anos');
            $table->integer('de5a9anos');
            $table->integer('de10a14anos');
            $table->integer('de15a19anos');
            $table->integer('de20a29anos');
            $table->integer('de30a39anos');
            $table->integer('de40a49anos');
            $table->integer('de50a59anos');
            $table->integer('de60a69anos');
            $table->integer('de70a79anos');
            $table->integer('de80oumais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
