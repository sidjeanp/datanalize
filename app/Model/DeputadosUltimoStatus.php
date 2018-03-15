<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeputadosUltimoStatus extends Model
{
    //
    protected $table = 'deputadosUltimoStatus';
    protected  $primaryKey = 'id';
    protected $fillable = ['idDeputado','uri','nome','siglaPartido','uriPartido','siglaUf','idLegislatura',
        'urlFoto', 'data','nomeEleitoral','situacao','condicaoEleitoral','descricaoStatus'];
}
