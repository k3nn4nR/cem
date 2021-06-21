<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['descripcion'];
    public $timestamps = false;

    public function provincias()
    {
        return $this->hasMany('App\Provincia','id_departamento','id');
    }
}
