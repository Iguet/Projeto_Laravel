<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $filliable = [
        'id',
        'nome',
        'descricao'
    ];

    public function usersProjetos()
    {
        return $this->belongsToMany('App\UsersProjetos');
    }

    public function demandas()
    {
        return $this->belongsToMany('App\Demandas');
    }    
    
}
