<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCaso extends Model
{
    protected $primaryKey = 'ficha';
    protected $keyType = 'string';
    protected $fillable = ['caso_ficha','agresor_dni','comentario'];

    public function denuncuante()
    {
        return $this->belongsTo('App\Caso','persona_dni','dni');
    }
}
