<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCaso extends Model
{
    protected $fillable = ['caso_ficha','agresor_dni','vinculo','comentario','letra_asignada','tipos_violacion'];

    protected $casts = [
        'tipos_violacion' => 'array',
    ];

    public function caso()
    {
        return $this->belongsTo('App\Caso','caso_ficha','ficha');
    }

    public function agresor()
    {
        return $this->belongsTo('App\Persona','agresor_dni','dni');
    }

    public function seguimiento()
    {
        return $this->hasMany('App\Seguimiento');
    }
}
