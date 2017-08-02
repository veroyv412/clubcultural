<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deal extends Model
{
    protected $table = 'deals';


    public function category()
    {
        return $this->hasOne('Models\Category', 'id', 'category_id');
    }
    
    public function business()
    {
        return $this->hasOne('Models\Business', 'id', 'business_id');
    }
    
    public function images()
    {
        return $this->hasMany('Models\Deal_Images', 'deal_id', 'id');
    }
}
