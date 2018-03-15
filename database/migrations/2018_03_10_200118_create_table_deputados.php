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
        //'id','uri','nome','siglaPartido','uriPartido','siglaUf','idLegislatura','urlFoto'
        Schema::create('deputados',function(Blueprint $table){
            $table->increments('id');
            $table->string('nome',250)->nullable();
            $table->string('siglaPartido',30)->nullable();
            $table->string('uriPartido',250)->nullable();
            $table->string('siglaUf',2)->nullable();
            $table->integer('idLegislatura')->nullable();
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
