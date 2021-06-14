<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $primaryKey = 'ficha';
    protected $keyType = 'string';
    protected $fillable = ['ficha','denunciante_dni','fecha_caso','tipo','lugar','medida','observacion_abogado'];

    public function denuncuante()
    {
        return $this->belongsTo('App\Persona','denunciante_dni','dni');
    }

    public function detalles()
    {
        return $this->hasMany('App\DetalleCaso','caso_ficha','ficha');
    }
    
    //agresor
}
