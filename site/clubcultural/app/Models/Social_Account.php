<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Social_Account extends Model
{
    protected $table = 'social_accounts';
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo('Models\User');
    }
}
