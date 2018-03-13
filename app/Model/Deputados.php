<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deputados extends Model
{
    //
    protected $table = 'deputados';
    protected  $primaryKey = 'id';
    protected $fillable = ['id','idLegislatura','nomeCivil','cpf','sexo','urlWebsite','sexo','dataNascimento',
        'dataFalecimento','ufNascimento','municipioNascimento','escolaridade','uri','nome','siglaPartido','uriPartido',
        'siglaUf','urlFoto'];
}
