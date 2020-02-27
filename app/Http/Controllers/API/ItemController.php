<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function create(Request $request,User $user){
        $validator= Validator::make($request->all(), [
            'title'=>'required|string|max:256',
            'image'=>'image',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        if($validator->fails())
        {
            return $this->apiResponse('create_item',null,$validator->errors(),401);
        }
        $imagePath= time().'.'.$request->image->getClientOriginalExtension();
        $request->image->storeAs('items',$imagePath);
        $user->items()->create([
           'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return $this->apiResponse('create_item','item created');
    }
}
