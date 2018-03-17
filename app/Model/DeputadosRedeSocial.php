<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeputadosRedeSocial extends Model
{
    //
    protected $table = 'deputadosRedeSocial';
    protected  $primaryKey = 'id';
    protected $fillable = ['idDeputados','url'];
}
