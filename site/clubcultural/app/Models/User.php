<?php

namespace Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'name', 'last_name', 'avatar'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(\Models\Role::class);
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MailResetPasswordToken($token));
    }

    public function hasRole($role){
        if (is_string($role)){
            return $this->roles->contains('name', $role);
        }

        //it compares the role with the list of roles
        return !! $role->intersect($this->roles)->count();
    }
}
