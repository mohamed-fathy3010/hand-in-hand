<?php
namespace App\Http\Controllers\API;
trait ApiResponseTrait{

    public function apiResponse($name,$data=null,$error=null,$code=200)
    {
        $array=[
            $name => $data,
            'status'=>$code == 200?true:false,
            'error' => $error
        ];
        return response()->json($array,$code);
    }
}