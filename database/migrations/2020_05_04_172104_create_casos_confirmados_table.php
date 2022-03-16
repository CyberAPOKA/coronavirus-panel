<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosConfirmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos_confirmados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->date('dia');
            $table->integer('casos');
            $table->integer('obitos');
            $table->integer('masculino');
            $table->integer('feminino');
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
            $table->bigInteger('bairro_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('bairro_id')
            ->references('id')->on('bairros')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casos_confirmados');
    }
}
