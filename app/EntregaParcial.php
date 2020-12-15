<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaParcial extends Model
{
    //


    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'entregas_parciales';
}
