<?php

namespace App\Http\Controllers;

use App\Item;
use App\Notification;
use App\Report;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
        $items=Item::filter($modelFilters)->paginate(20);
        else
            $items=Item::latest()->paginate(20);
        return view('items',[
            'items'=>$items,
            'first_item_style'=>"margin-left: 70px",
            'container_style'=>"margin-top: 350px",
            'new_row'=>false
            ]);
    }
    public function show(Item $item)
    {
        return view('item_description',['item'=>$item]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|string|max:256',
            'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        $imagePath='default.png';
        if($request->hasFile('image'))
        {
            $imagePath= time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('items',$imagePath);
        }
        auth()->user()->items()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return redirect('/items');
    }
    public function update(Request $request,Item $item)
    {
        if(auth()->id()!=$item->user_id) {
            abort(404);
        }

        $validated = $this->validate($request,[
            'title'=>'required|string|max:256',
            'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        $imagePath=$item->image;
        if($request->hasFile('image'))
        {
            $imagePath= time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('items',$imagePath);
        }

        $item->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return redirect('/items/'.$item->id);
    }

    public function destroy(Item $item){
        if(auth()->id()!=$item->user_id)
        {
            abort(404);
        }

        $item->delete();
        return redirect('/items');

    }


    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','items')
            ->where('user_id',auth()->id())->exists();
    }
    public function report(Request $request, Item $item){

        $this->validate($request, [
            'reason' => 'required|in:spam,inappropriate'
        ]);
        if ($this->isReported($item->id))
        {
            abort(401);
        }
        $item->reports()->create([
            'user_id'=>auth()->id(),
            'reason'=>$request->reason
        ]);
        $item->increment('reports');
        return redirect('/items/'.$item->id);
    }

}
