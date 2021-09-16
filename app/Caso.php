<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $primaryKey = 'ficha';
    protected $keyType = 'string';
    protected $fillable = ['ficha','denunciante_dni','fecha_caso','tipo','turno','lugar','medida','estado','observacion_abogado'];

    public function denunciante()
    {
        return $this->belongsTo('App\Persona','denunciante_dni','dni');
    }

    public function detalles()
    {
        return $this->hasMany('App\DetalleCaso','caso_ficha','ficha');
    }

    // public function seguimientos()
    // {
    //     return $this->hasManyThrough('App\Seguimiento', 'App\DetalleCaso');
    // }
}
