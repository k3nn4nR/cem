<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    protected $fillable = ['dni','ape_paterno','ape_materno','nombres','edad','celular','nivel_riesgo'];

    public function casos()
    {
        return $this->hasMany('App\Caso','denunciante_dni','dni');
    }

    public function ubicaciones()
    {
        return $this->hasMany('App\Ubicacion','persona_dni','dni');
    }

    public function contactos()
    {
        return $this->hasMany('App\Contacto','persona_dni','dni');
    }
}
