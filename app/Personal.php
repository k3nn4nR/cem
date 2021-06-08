<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personal';
    protected $keyType = 'string';
    protected $fillable = ['persona_dni','cargo'];

    public function persona()
    {
        return $this->hasOne('App\Persona','persona_dni','dni');
    }
}
