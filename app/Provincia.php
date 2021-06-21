<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id_departamento','descripcion'];
    public $timestamps = false;

    public function distritos()
    {
        return $this->hasMany('App\Distrito','id_provincia','id');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Departamento','id_departamento','id_departamento');
    }
}
