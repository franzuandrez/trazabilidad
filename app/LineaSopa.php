<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaSopa extends Model
{
    //

    protected $table = 'sopas';
    protected $primaryKey = 'id_sopa';
    public $timestamps = false;

    protected $dates = [
        'fecha_hora'
    ];
}
