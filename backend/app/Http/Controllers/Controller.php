<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected static function success($message = 'Success', $data = [], $code = 200){
        return response()->json(['status'=>'success', 'message'=> $message, 'data'=>$data], $code);
    }

    protected function error($message = 'An error occured', $code = 400){
        return response()->json(['status'=>'failed', 'message'=> $message], $code);
    }
    
    protected static function not_found($message = 'Not found', $code = 404){
        return response()->json(['status'=>'not found', 'message'=> $message], $code);
    }

}
