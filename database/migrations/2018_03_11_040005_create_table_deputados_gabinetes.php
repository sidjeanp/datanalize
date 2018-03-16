<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeputadosGabinetes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deputadosGabinetes',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idDeputadosStatus');
            $table->string('nome',100)->nullable();
            $table->string('predio',20)->nullable();
            $table->string('sala',20)->nullable();
            $table->string('andar',20)->nullable();
            $table->string('telefone',50)->nullable();
            $table->string('email',250)->nullable();
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
        Schema::dropIfExists('deputadosGabinetes');
    }
}
