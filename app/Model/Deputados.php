<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deputados extends Model
{
    //
    protected $table = 'deputados';
    protected  $primaryKey = 'id';
    protected $fillable = array('id','nome','siglaPartido','uriPartido','siglaUf','idLegislatura','urlFoto');
}
