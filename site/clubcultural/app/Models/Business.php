<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = ['company_name', 'email', 'company_location'];

    private $rules = array(
        'company_name'      => 'required|max:255',
        'email'             => 'required|email',
        'company_location'  => 'required|max:255',
    );

    public function validate($data){
        $v = Validator::make($data, $this->rules);
        return $v->passes();
    }
}
