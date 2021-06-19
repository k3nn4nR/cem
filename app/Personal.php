<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;
    protected $table = 'personal';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['id','persona_dni','cargo'];

    public function persona()
    {
        return $this->hasOne('App\Persona','dni','persona_dni');
    }

    public function seguimientos()
    {
        return $this->belongsToMany('App\Seguimiento')->withPivot('comentario');
    }
}
