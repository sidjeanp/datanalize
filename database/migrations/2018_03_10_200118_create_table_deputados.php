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
            $table->integer('id');
            $table->integer('idLegislatura');
            $table->string('nomeCivil',250);
            $table->string('cpf',20);
            $table->string('sexo',1);
            $table->string('urlWebsite',250);
            $table->string('dataNascimento',25);
            $table->string('dataFalecimento',25);
            $table->string('ufNascimento',2);
            $table->string('municipioNascimento',80);
            $table->string('escolaridade',250);

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
