<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Report;
use App\User;
use App\Item;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
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
        auth()->user()->items()->create([
           'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return $this->apiResponse('create_item','item created');
    }
    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
            $items=Item::filter($modelFilters)->paginate(16);
        else
            $items=Item::latest()->paginate(16);
        return $this->apiResponse('items',$items);
    }

    public function report(Request $request, Item $item){
                if ($this->isReported($item->id))
                {
                    return $this->apiResponse('item_report',null,'this item is already reported',401);
                }
                $item->reports()->create([
                    'user_id'=>auth()->id(),
                    'reason'=>$request->reason
                ]);
                return $this->apiResponse('item_report','reported!!!');
    }
    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','App\Item')
            ->where('user_id',auth()->id())->exists();
    }
    public function destroy(Item $item){
        if(auth()->id()==$item->user_id)
        {
            $item->delete();
            return $this->apiResponse('item_delete','item deleted!!!');
        }
        else{
            return $this->apiResponse('item_delete',null,'Unauthorized action',401);
        }

    }
    public function update(Request $request,Item $item)
    {
        $hasImage=$request->hasFile('image');
        $id = auth()->id();
        $rules =[
            'title'=>'required|string|max:256',
            'price'=>'required',
            'phone'=>'max:15'
        ];
        $imageRules = $rules;
        $imageRules['image']='image';
        if($hasImage) {
            $validator = Validator::make($request->all(), $imageRules);
        }
        else
        {
            $validator= Validator::make($request->all(),$rules );
        }

        if($validator->fails())
        {
            return $this->apiResponse('item_update',null,$validator->errors(),401);
        }
        if($hasImage)
        {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $request->image->storeAs('items', $imageName);
        }
        else {
            $imageName = Item::where('user_id', $id)->first()->image;
            if ($request->image !== $imageName) {
                $imageName = 'default.png';
            }
        }

       $item->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imageName
        ]);
        return $this->apiResponse('item_update','update succeed!!');
    }
}
