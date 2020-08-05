<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\NotificationWasPushed;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
    public function index()
    {
        $events =  Event::latest()->paginate(16);
        return view('events2',['events'=>$events]);
    }

    public function show(Event $event){
        $eventRelations= $event->load('interestable.user.info');
        $interesters=$eventRelations->interestable->pluck('user.info');
        $event->unsetRelation('interestable');
        $event->interesters =$interesters;
        return view('event_description',['event' => $event]);
    }

    public function store(Request $request){
       $validator = $this->validate($request, [
            'title'=>'required|string|max:256',
           'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'about'=>'required',
            'location'=>'required',
            'description'=>'required',
            'date'=>'required',

        ]);
        $imagePath ='default.png';
        if ($request->hasFile('image'))
        {
            $imagePath = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('events', $imagePath);
        }
        auth()->user()->events()->create($validator);

        return redirect('/events');
    }

    public function report(Request $request, Event $event){

        $validator= $this->validate($request, [
            'reason' => 'required|in:spam,inappropriate'
        ]);

        if ($this->isReported($event->id))
        {
           abort(401);
        }
        $event->reports()->create([
            'user_id'=>auth()->id(),
           $validator
        ]);
        $event->increment('reports');
        return redirect('/events/'.$event->id);
    }

    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','events')
            ->where('user_id',auth()->id())->exists();
    }

    public function destroy(Event $event){
        if(auth()->id()!=$event->user_id)
        {
           abort(404);
        }

        $event->delete();
        return redirect('/events');



    }

    public function update(Request $request,Event $event)
    {
        if(auth()->id()!=$event->user_id)
        {
            abort(404);
        }
        $rules =[
            'title'=>'required|string|max:256',
            'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'about'=>'required',
            'location'=>'required',
            'description'=>'required',
            'date'=>'required',
        ];
      $validator=$this->validate($request,$rules);
        $imageName = $event->image;
        if($request->hasFile('image'))
        {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $request->image->storeAs('events', $imageName);
        }
        $validator['image'] =$imageName;
        $event->update($validator);
        return redirect('/events/'.$event->id);
    }

    public function interest(Event $event)
    {
        if($event->is_interested){
            $event->decrement('interests');
            $event->interestable()->where('user_id',auth()->id())->delete();
        }
        else {
            $sender = User::with('info')->find(auth()->id());
            $eventInfo = $event->load('user.info');
            $count = $event->interestable()->get()->count();
            switch ($count) {
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
                'user_id' => $sender->id
            ]);
            $notification = $this->makeNotification($sender, $eventInfo->user, $event, $message);
            NotificationWasPushed::dispatch($notification);
        }
    }



    private function makeNotification($sender, $receiver, $event, $message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/events/{$event->id}";
        return $receiver->notifications()->updateOrCreate([
            'url' => $url
        ],[
            'body'=> $body,
            'is_read'=> 0
        ]);
    }

}
