<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCaso extends Model
{
    protected $fillable = ['caso_ficha','agresor_dni','vinculo','comentario'];

    public function denuncuante()
    {
        return $this->belongsTo('App\Caso','persona_dni','dni');
    }
}
