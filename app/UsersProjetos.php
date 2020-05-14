<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProjetos extends Model
{

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
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
