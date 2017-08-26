<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function roles(){
        return $this->belongsToMany(\Models\Role::class);
    }
}
