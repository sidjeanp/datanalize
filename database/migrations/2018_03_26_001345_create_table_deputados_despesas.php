<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeputadosDespesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deputadosDespesas',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idDeputados');
            $table->integer('nuCarteiraParlamentar')->nullable();
            $table->integer('idLegislatura')->nullable();
            $table->integer('idDeputadosSubCotas')->nullable();
            $table->integer('idDeputadosEspecificacaoSubCotas')->nullable();
            $table->integer('idDeputadosFornecedor')->nullable();
            $table->string('txtNumero',80)->nullable();
            $table->string('indTipoDocumento',80)->nullable();
            $table->string('datEmissao',25)->nullable();
            $table->string('vlrDocumento',30)->nullable();
            $table->string('vlrGlossa',30)->nullable();
            $table->string('vlrLiquido',30)->nullable();
            $table->integer('numMes')->nullable();
            $table->integer('numAno')->nullable();
            $table->integer('numParcela')->nullable();
            $table->string('txtPassageiro',250)->nullable();
            $table->string('txtTrecho',100)->nullable();
            $table->string('numLote',80)->nullable();
            $table->string('numRessarcimento',80)->nullable();
            $table->string('vlrRestituicao',30)->nullable();
            $table->string('ideDocumento',30)->nullable();
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
        Schema::dropIfExists('deputadosDespesas');
    }
}
