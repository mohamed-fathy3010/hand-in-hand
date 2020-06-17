<?php

namespace App\Http\Controllers\API;

use App\Deal;
use App\Events\ElementWasInterested;
use App\Events\NotificationWasPushed;
use App\Events\Test;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Report;
use App\Item;
use App\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function create(Request $request){
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
        $imagePath='default.png';
       if($request->has('image'))
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
        return $this->apiResponse('create_item','item created');
    }
    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
            $items=Item::filter($modelFilters)->where('is_canceled',0)->paginate(16);
        else
            $items=Item::latest()->where('is_canceled',0)->paginate(16);
        return $this->apiResponse('items',$items);
    }

    public function report(Request $request, Item $item){

        $validator= Validator::make($request->all(), [
            'reason' => 'required|in:spam,inappropriate'
        ]);
        if($validator->fails())
        {
            return $this->apiResponse('item_report',null,$validator->errors(),401);
        }
                if ($this->isReported($item->id))
                {
                    return $this->apiResponse('item_report',null,'this item is already reported',401);
                }
                $item->reports()->create([
                    'user_id'=>auth()->id(),
                    'reason'=>$request->reason
                ]);
                $item->increment('reports');
                return $this->apiResponse('item_report','reported!!!');
    }
    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','items')
            ->where('user_id',auth()->id())->exists();
    }

    public function destroy(Item $item){
        if(auth()->id()!=$item->user_id)
          {
              return $this->apiResponse('item_delete',null,'Unauthorized action',401);
          }

            $item->delete();
            return $this->apiResponse('item_delete','item deleted!!!');

    }
    public function update(Request $request,Item $item)
    {
        if(auth()->id()!=$item->user_id) {
            return $this->apiResponse('item_update', null, 'Unauthorized action', 401);
        }
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
    public function show(Item $item)
    {
        return $this->apiResponse('item',$item);
    }

    public function request(Item $item)
    {
        $sender = User::with('info')->find(auth()->id());
        $itemInfo = $item->load('user.info');

        if($this->hasDeal($itemInfo,$sender->id)) {
            return $this->apiResponse('item_deal', null, 'already requested', 401);
        }
        $deal = $item->deals()->create([
            'buyer_id' =>$sender->id,
            'owner_id' => $itemInfo->user->id
        ]);
        $notification = $this->makeNotification($sender,$itemInfo->user,$deal,'is interested in one of your items');
        NotificationWasPushed::dispatch($notification);
        return $this->apiResponse('item_deal','requested');

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

    public function cancel(Item $item){
        if(auth()->id()!=$item->user_id) {
            return $this->apiResponse('item_update', null, 'Unauthorized action', 401);
        }
        $item->update(['is_canceled' => 1]);
        return $this->apiResponse('item_cancel','canceled');
    }


}
