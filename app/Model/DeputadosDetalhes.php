<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeputadosDetalhes extends Model
{
    //
    protected $table = 'deputadosDetalhe';
    protected  $primaryKey = 'id';
    protected $fillable = ['idDeputado','uri','nomeCivil','cpf','sexo','urlWebsite','dataNascimento',
        'dataFalecimento', 'ufNascimento','municipioNascimento'];
}
