<?php

namespace App\Http\Controllers;

use App\Events\NotificationWasPushed;
use App\Report;
use App\Service;
use App\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
public function index(ModelFilters $modelFilters)
{
    if (!empty($modelFilters->filters()))
        $services=Service::filter($modelFilters)->paginate(20);
    else
        $services=Service::latest()->paginate(20);
    return view('services2',[
        'services'=>$services,
        'margin'=>80,
        'margin_counter'=>450
    ]);
}
    public function show(Service $service)
    {
        $serviceRelations= $service->load('interestable.user.info');
        $is_reported=$this->isReported($service->id);
        $interesters=$serviceRelations->interestable->pluck('user.info');
        $service->unsetRelation('interestable');
        $service->interesters =$interesters;
        return view('service_description',['service'=>$service,'is_reported'=>$is_reported]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title'=>'required|string|max:256',
            'goal'=>'required',
            'description'=>'required',
            'target'=>'required',
            'price'=>'required'
        ]);


        auth()->user()->services()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'goal'=>$request->goal,
            'target'=>$request->target,
        ]);
        return redirect('/services');
    }

    public function report(Request $request, Service $service){

        $this->validate($request, [
            'reason' => 'required|in:spam,inappropriate'
        ]);

        if ($this->isReported($service->id))
        {
           abort(401);
        }
        $service->reports()->create([
            'user_id'=>auth()->id(),
            'reason'=>$request->reason
        ]);
        $service->increment('reports');
       return redirect('/services/'.$service->id);
    }
    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','services')
            ->where('user_id',auth()->id())->exists();
    }

    public function destroy(Service $service){
        if(auth()->id()!=$service->user_id)
        {
           abort(404);
        }

        $service->delete();
        return redirect('/services');
    }

    public function update(Request $request,Service $service)
    {
        if(auth()->id()!=$service->user_id) {
            abort(404);
        }
        $rules =[
            'title'=>'required|string|max:256',
            'goal'=>'required',
            'description'=>'required',
            'target'=>'required',
            'price'=>'required'
        ];

       $validator = $this->validate($request,$rules);
        $service->update($validator);
        return redirect('/services/'.$service->id);
    }

    public function interest(Service $service)
    {
        if ($service->is_interested){
            $service->decrement('interests');
            $service->interestable()->where('user_id',auth()->id())->delete();
            return redirect('services/'.$service->id);
        }
        else {
            $sender = User::with('info')->find(auth()->id());
            $serviceInfo = $service->load('user.info');
            $count = $service->interestable()->get()->count();
            switch ($count) {
                case 0:
                    $message = 'is interested in your service';
                    break;
                case 1;
                    $message = 'and one more user are interested in your service';
                    break;
                default:
                    $message = "and ${count} other people are interested in your service";
            }
            $service->increment('interests');
            $service->interestable()->create([
                'user_id' => $sender->id
            ]);
            $notification = $this->makeNotification($sender, $serviceInfo->user, $service, $message);
            NotificationWasPushed::dispatch($notification);
            $service->refresh();
            $this->checkGoal($service, $serviceInfo->user);
            return redirect('services/'.$service->id);
        }
    }


    private function makeNotification($sender, $receiver, $service, $message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/services/{$service->id}";
        return $receiver->notifications()->updateOrCreate([
            'url' => $url
        ],[
            'body' => $body,
            'is_read' => 0
        ]);
    }
    private function checkGoal(Service $service, $receiver)
    {
        if($service->goal !== 0 && $service->interests === $service->goal ){
            $body = 'your goal has been reached';
            $url = "/services/{$service->id}/interests";
            $notification = $receiver->notifications()->create([
                'body'=>$body,
                'url'=>$url
            ]);
            NotificationWasPushed::dispatch($notification);
        }
    }
}
