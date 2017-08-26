<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        
    }
    
    protected function responseError($message, $code = null){
        return response()->json([
            'code'      => !empty($code) ? $code : '500', 
            'status'    => 'error',
            'message'   => $message
        ]);
    }

    protected function responseSuccess($data){
        return response()->json([
            'code'      => '200',
            'status'    => 'success',
            'data'      => $data
        ]);
    }
}
