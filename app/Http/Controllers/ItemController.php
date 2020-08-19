<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Events\NotificationWasPushed;
use App\Item;
use App\Notification;
use App\Report;
use App\User;
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
       $data = array_chunk($items->items(),4);
       return view('items',[
           'items'=>$items,
           'data'=>$data
       ]);
//       foreach ($data as $collection){
//           foreach ($collection as $item)
//           {
//               dd($item);
//           }
//       }
        //dd(array_chunk($items,4));
//        return view('items',[
//            'items'=>$items,
//            'first_item_style'=>"margin-left: 70px",
//            'container_style'=>"margin-top: 350px",
//            'new_row'=>false
//        ]);
    }
    public function show(Item $item)
    {
        $is_requested =$this->hasDeal($item,auth()->id());
        $is_reported =$this->isReported($item->id);
        return view('item_description',['item'=>$item,'is_requested'=>$is_requested,'is_reported'=>$is_reported]);
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
    public function request(Item $item)
    {
        $sender = User::with('info')->find(auth()->id());
        $itemInfo = $item->load('user.info');

        if($this->hasDeal($itemInfo,$sender->id)) {
            return redirect('/items/'.$item->id);
        }
        $deal = $item->deals()->create([
            'buyer_id' =>$sender->id,
            'owner_id' => $itemInfo->user->id
        ]);
        $notification = $this->makeNotification($sender,$itemInfo->user,$deal,'is interested in one of your items');
        NotificationWasPushed::dispatch($notification);
        return redirect('/items/'.$item->id);

    }

    private function hasDeal($item,$buyerId):bool {
        return Deal::where('deal_type','items')
            ->where('deal_id',$item->id)
            ->where('buyer_id',$buyerId)
            ->where('owner_id',$item->user->id)->exists();
    }
    private function makeNotification($sender, $receiver, $deal,$message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/deals/{$deal->id}";
        return $receiver->notifications()->create([
            'body'=>$body,
            'url' => $url
        ]);
    }
}
