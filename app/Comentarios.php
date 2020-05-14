<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'comentario',
        'demanda_id'
    ];

    public function demandas()
    {
        return $this->hasOne('App\Demandas');
    }

}
