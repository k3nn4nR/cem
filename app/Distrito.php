<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id_provincia','id_departamento','descripcion'];
    public $timestamps = false;

    public function distritos()
    {
        return $this->HasOne('App\Provincia','id_provincia','id');
    }
}
