<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $fillable = ['detalle_caso_id','fecha'];

    public function detalles()
    {
        return $this->belongsTo('App\DetalleCaso','detalle_caso_id','id');
    }

    public function personal()
    {
        return $this->belongsToMany('App\Personal')->withPivot('comentario');
    }
}
