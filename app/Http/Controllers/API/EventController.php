<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\Events\NotificationWasPushed;
use App\Http\Controllers\Controller;
use App\Interest;
use App\Report;
use App\Service;
use App\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
  use ApiResponseTrait;
    public function show(Event $event){
        $eventRelations= $event->load('interestable.user.info');
        $interesters=$eventRelations->interestable->pluck('user.info');
        $event->unsetRelation('interestable');
        $event->interesters =$interesters;
        return $this->apiResponse('event',$event);
    }

    public function create(Request $request){
        $validator= Validator::make($request->all(), [
            'title'=>'required|string|max:256',
            'image'=>'image',
            'about'=>'required',
            'location'=>'required',
            'description'=>'required',
            'date'=>'required',

        ]);
        if($validator->fails())
        {
            return $this->apiResponse('create_event',null,$validator->errors(),401);
        }
        $imagePath= time().'.'.$request->image->getClientOriginalExtension();
        $request->image->storeAs('events',$imagePath);
        auth()->user()->events()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'about'=>$request->about,
            'date'=>$request->date,
            'location'=>$request->location,
            'image'=>$imagePath
        ]);

        return $this->apiResponse('create_event','event created');
    }

    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
            $events=Event::filter($modelFilters)->paginate(16);
        else
            $events=Event::latest()->paginate(16);
        return $this->apiResponse('events',$events);
    }

    public function report(Request $request, Event $event){

        $validator= Validator::make($request->all(), [
            'reason' => 'required|in:spam,inappropriate'
        ]);
        if($validator->fails())
        {
            return $this->apiResponse('event_report',null,$validator->errors(),401);
        }
        if ($this->isReported($event->id))
        {
            return $this->apiResponse('event_report',null,'this event is already reported',401);
        }
        $event->reports()->create([
            'user_id'=>auth()->id(),
            'reason'=>$request->reason
        ]);
        $event->increment('reports');
        return $this->apiResponse('event_report','reported!!!');
    }

    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','events')
            ->where('user_id',auth()->id())->exists();
    }

    public function destroy(Event $event){
        if(auth()->id()!=$event->user_id)
        {
            return $this->apiResponse('event_delete',null,'Unauthorized action',401);
        }

            $event->delete();
            return $this->apiResponse('event_delete','event deleted!!!');



    }

    public function update(Request $request,Event $event)
    {
        if(auth()->id()!=$event->user_id)
        {
            return $this->apiResponse('event_update',null,'Unauthorized action',401);
        }
        $hasImage=$request->hasFile('image');
        $id = auth()->id();
        $rules =[
            'title'=>'required|string|max:256',
            'image'=>'image',
            'about'=>'required',
            'location'=>'required',
            'description'=>'required',
            'date'=>'required',
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
            return $this->apiResponse('event_update',null,$validator->errors(),401);
        }
        if($hasImage)
        {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $request->image->storeAs('events', $imageName);
        }
        else {
            $imageName = Event::where('user_id', $id)->first()->image;
            if ($request->image !== $imageName) {
                $imageName = 'default.png';
            }
        }

        $event->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'about'=>$request->about,
            'date'=>$request->date,
            'location'=>$request->location,
            'image'=>$imageName
        ]);
        return $this->apiResponse('event_update','update succeed!!');
    }

    public function interest(Event $event)
    {
        if($event->is_interested){
            $event->decrement('interests');
            $event->interestable()->where('user_id',auth()->id())->delete();
            return $this->apiResponse('event_interest','uninterested');
        }
        $sender = User::with('info')->find(auth()->id());
        $eventInfo = $event->load('user.info');
        $count = $event->interestable()->get()->count();
        switch ($count){
            case 0:
                $message = 'is interested in your event';
                break;
            case 1;
                $message = 'and one more user are interested in your event';
                break;
            default:
                $message = "and ${count} other people are interested in your event";
        }

        $event->increment('interests');
        $event->interestable()->create([
            'user_id' =>$sender->id
        ]);
        $notification = $this->makeNotification($sender,$eventInfo->user,$event,$message);
        NotificationWasPushed::dispatch($notification);
        return $this->apiResponse('event_interest','interested');
    }



    private function makeNotification($sender, $receiver, $event, $message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/events/{$event->id}/interests";
        return $receiver->notifications()->updateOrCreate([
            'url' => $url
        ],[
            'body'=> $body,
            'is_read'=> 0
            ]);
    }

}
