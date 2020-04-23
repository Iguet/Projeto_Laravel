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

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user_table', 'user_id', 'role_id');
    }

}
