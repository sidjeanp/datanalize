<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeputadosUltimoStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deputadosUltimoStatus',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idDeputados');
            $table->boolean('flgAtivo');
            $table->integer('idLegislatura');
            $table->string('nome',250);
            $table->string('siglaPartido',10);
            $table->string('siglaUf',2);
            $table->string('uriPartido',250);
            $table->string('urlFoto',250);
            $table->string('data',25);
            $table->string('situacao',50);
            $table->string('condicaoEleitoral',50);
            $table->string('descricaoStatus',500);
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
        Schema::dropIfExists('deputadosUltimoStatus');
    }
}
