<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    protected $fillable = ['dni','ape_paterno','ape_materno','nombres','edad','celular','nivel_riesgo'];

    //denuncias

    public function ubicaciones()
    {
        return $this->hasMany('App\Ubicacion');
    }

    public function contactos()
    {
        return $this->hasMany('App\Contacto');
    }
}
