<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeputados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deputados',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idDeputado')->nullable();
            $table->integer('idLegislatura')->nullable();
            $table->string('nome',250)->nullable();
            $table->string('nomeCivil',250)->nullable();
            $table->string('cpf',20)->nullable();
            $table->string('sexo',1)->nullable();
            $table->string('urlWebsite',250)->nullable();
            $table->string('uri',250)->nullable();
            $table->string('dataNascimento',25)->nullable();
            $table->string('dataFalecimento',25)->nullable();
            $table->string('ufNascimento',2)->nullable();
            $table->string('municipioNascimento',80)->nullable();
            $table->string('escolaridade',250)->nullable();
            $table->string('siglaPartido',30)->nullable();
            $table->string('uriPartido',250)->nullable();
            $table->string('siglaUf',2)->nullable();
            $table->string('urlFoto',250)->nullable();
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
        Schema::dropIfExists('deputados');
    }
}
