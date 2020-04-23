<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usersProjetos extends Model
{

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $filliable = [
        'users_id',
        'projetos_id'
    ];

    public function users()
    {
        return $this->hasOne('App\Users');
    }

    public function projetos()
    {
        return $this->hasOne('App\Projetos');
    }

}
