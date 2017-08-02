<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = array('user_id', 'business_id', 'deal_id', 'price');
    
    public function user()
    {
        return $this->hasOne('Models\User', 'id', 'user_id');
    }

    public function business()
    {
        return $this->hasOne('Models\Business', 'id', 'business_id');
    }

    public function deal()
    {
        return $this->hasOne('Models\Deal', 'id', 'deal_id');
    }
}