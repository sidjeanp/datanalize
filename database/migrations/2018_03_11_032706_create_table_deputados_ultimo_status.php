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
            $table->integer('idDeputados')->nullable();
            $table->string('uri',250)->nullable();
            $table->string('nome',250)->nullable();
            $table->string('siglaPartido',10)->nullable();
            $table->string('uriPartido',250)->nullable();
            $table->string('siglaUf',2)->nullable();
            $table->integer('idLegislatura')->nullable();
            $table->string('urlFoto',250)->nullable();
            $table->string('data',25)->nullable();
            $table->string('nomeEleitoral',250)->nullable();
            $table->string('situacao',50)->nullable();
            $table->string('condicaoEleitoral',50)->nullable();
            $table->string('descricaoStatus',500)->nullable();

            $table->timestamps();
            $table->softDeletes();
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
