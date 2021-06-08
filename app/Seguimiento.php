<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $fillable = ['detalle_caso_id','fecha'];

    public function detalle()
    {
        
    }
}
