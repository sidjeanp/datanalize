<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeputadosLink extends Model
{
    //
    protected $table = 'deputadosLinks';
    protected  $primaryKey = 'id';
    protected $fillable = ['idDeputados','href','rel'];
}
