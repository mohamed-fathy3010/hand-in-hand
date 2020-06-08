<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    use ApiResponseTrait;
    //
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'body'=>'string|required',
            'image'=> 'image'
        ]);
        if($validator->fails()){
            return $this->apiResponse('validation',null,$validator->errors(),403);
        }
        $imagePath = time() . '.' . request()->image->getClientOriginalExtension();
        $request->image->storeAs('ssn', $imagePath);
        auth()->user()->validation()->create([
            'body'=>$request->body,
            'image' =>$imagePath
        ]);
    }
}
