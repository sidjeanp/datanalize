<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeputadosGabinete extends Model
{
    //
    protected $table = 'deputadosGabinetes';
    protected  $primaryKey = 'id';
    protected $fillable = ['idDeputadosStatus','nome','predio','sala','andar','telefone','email'];
}
