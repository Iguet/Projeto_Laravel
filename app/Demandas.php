<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Demandas extends Model
{
    
    use Notifiable;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $filliable = [
        'id',
        'titulo',
        'descricao',
        'estado',
        'projeto_id'
    ];
    
    public function projetos()
    {
        return $this->hasOne('App\Projetos');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function comentarios()
    {
        return $this->belongsToMany('App\Comentarios');
    }

}
