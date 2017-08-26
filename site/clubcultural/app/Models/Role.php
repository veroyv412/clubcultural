<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function permissions(){
        return $this->belongsToMany(\Models\Permission::class);
    }

    public function givePermissionTo(\Models\Permission $permission){
        return $this->permissions()->save($permission);
    }
}
