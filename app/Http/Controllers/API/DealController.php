<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationWasPushed;
use App\Http\Controllers\Controller;
use App\Deal;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{
    use ApiResponseTrait;
    //
    private function isFinished(Deal $deal):bool{
    return !is_null($deal->owner_status);
    }

    private function isOwner(Deal $deal):bool {
        return auth()->id()=== $deal->owner_id;
    }

    private function isBuyer(Deal $deal){
        return auth()->id()=== $deal->buyer_id;
    }


    private function isAccepted(Deal $deal){
        return $deal->owner_status;
    }

    public function index(){
        $deals = Deal::where('owner_id',auth()->id())->get();
        return $this->apiResponse('deals',$deals);
    }

    public function accept(Deal $deal)
    {
        if ($this->isFinished($deal))
            return $this->apiResponse('deal',null,'this deal is finished',401);

        if(! $this->isOwner($deal))
        {
            return $this->apiResponse('deal',null,'unauthorized action',401);
        }

        $validator = Validator::make(request()->all(),[
            'details' => 'required|string'
        ]);
        if ($validator->fails()){
            return $this->apiResponse('deal',null,$validator->errors(),401);
        }
        $deal->update([
            'details' => request('details'),
            'owner_status' =>true
            ]);
        $sender = User::with('info')->findOrFail($deal->owner_id);
        $receiver = User::findOrFail($deal->buyer_id);

        $notification =$this->makeNotification($sender,$receiver,$deal,'accepted the deal') ;
        NotificationWasPushed::dispatch($notification);
        return $this->apiResponse('deal', 'accepted');
    }

    public function decline(Deal $deal){
        if ($this->isFinished($deal))
            return $this->apiResponse('deal',null,'this deal is finished',401);

        if(! $this->isOwner($deal))
        {
            return $this->apiResponse('deal',null,'unauthorized action',401);
        }

        $deal->update([
            'owner_status' =>false
        ]);

        $sender = User::with('info')->findOrFail($deal->owner_id);
        $receiver = User::findOrFail($deal->buyer_id);

        $notification =$this->makeNotification($sender,$receiver,$deal,'declined the deal') ;
        NotificationWasPushed::dispatch($notification);
        return $this->apiResponse('deal', 'declined');
    }

    public function respond(Deal $deal)
    {
        if (!$this->isAccepted($deal))
        {
        return $this->apiResponse('deal',null,'the owner didn\'t accept the deal ' ,401);
        }

        if(!$this->isBuyer($deal))
            return $this->apiResponse('deal',null,'unauthorized action',401);

        $validator = Validator::make(request()->all(),[
            'buyer_status' => 'required|boolean'
        ]);
        if ($validator->fails()){
            return $this->apiResponse('deal',null,$validator->errors(),401);
        }
        $deal->update(['buyer_status'=> request('buyer_status')]);
        $sender = User::with('info')->findOrFail($deal->buyer_id);
        $receiver = User::findOrFail($deal->owner_id);

        $notification =$this->makeNotification($sender,$receiver,$deal,'responded to the details') ;
        NotificationWasPushed::dispatch($notification);
        return $this->apiResponse('deal','responded');
    }

    private function makeNotification(Model $sender,User $receiver,Deal $deal,$message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/deals/{$deal->id}";
        return $receiver->notifications()->create([
            'body'=>$body,
            'url' => $url
        ]);
    }

    public function show(Deal $deal){
        $dealInfo=$deal->load('buyer.info','owner.info');
        $buyer = $dealInfo->buyer->info;
        $owner = $dealInfo->owner->info;
        $deal->unsetRelation('owner')->unsetRelation('buyer');
        $deal->buyer=$buyer;
        $deal->owner=$owner;
        $dealable = DB::table($deal->deal_type)->find($deal->deal_id);
        $deal->data = $dealable;
        return $this->apiResponse('show_deal',$deal);
    }

}
