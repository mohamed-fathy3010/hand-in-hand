<?php

namespace App\Http\Controllers\API;

use App\Deal;
use App\Events\NotificationWasPushed;
use App\Http\Controllers\Controller;
use App\Interest;
use App\Item;
use App\Report;
use App\Service;
use App\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    use ApiResponseTrait;
public function index(ModelFilters $modelFilters)
{
    if (!empty($modelFilters->filters()))
        $services=Service::filter($modelFilters)->paginate(20);
    else
        $services=Service::latest()->paginate(20);
    return $this->apiResponse('services',$services);
}

public function show(Service $service)
{
    $serviceRelations= $service->load('interestable.user.info');
    $interesters=$serviceRelations->interestable->pluck('user.info');
    $service->unsetRelation('interestable');
    $service->interesters =$interesters;
    return $this->apiResponse('service',$service);
}

 public function create(Request $request){
     $validator= Validator::make($request->all(), [
         'title'=>'required|string|max:256',
         'goal'=>'required',
         'description'=>'required',
         'target'=>'required',
         'price'=>'required'
     ]);
     if($validator->fails())
     {
         return $this->apiResponse('create_service',null,$validator->errors(),401);
     }

     auth()->user()->services()->create([
         'title'=>$request->title,
         'description'=>$request->description,
         'price'=>$request->price,
         'goal'=>$request->goal,
         'target'=>$request->target,
     ]);
     return $this->apiResponse('create_service','service created');
 }

  public function report(Request $request, Service $service){

      $validator= Validator::make($request->all(), [
          'reason' => 'required|in:spam,inappropriate'
      ]);
      if($validator->fails())
      {
          return $this->apiResponse('service_report',null,$validator->errors(),401);
      }
      if ($this->isReported($service->id))
      {
          return $this->apiResponse('service_report',null,'this service is already reported',401);
      }
      $service->reports()->create([
          'user_id'=>auth()->id(),
          'reason'=>$request->reason
      ]);
      $service->increment('reports');
      return $this->apiResponse('service_report','reported!!!');
  }
    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','services')
            ->where('user_id',auth()->id())->exists();
    }

    public function destroy(Service $service){
        if(auth()->id()!=$service->user_id)
        {
            return $this->apiResponse('service_delete',null,'Unauthorized action',401);
        }

        $service->delete();
        return $this->apiResponse('service_delete','service deleted!!!');

    }

     public function update(Request $request,Service $service)
     {
         if(auth()->id()!=$service->user_id) {
             return $this->apiResponse('service_update', null, 'Unauthorized action', 401);
         }
         $id = auth()->id();
         $rules =[
             'title'=>'required|string|max:256',
             'goal'=>'required',
             'description'=>'required',
             'target'=>'required',
             'price'=>'required'
         ];

         $validator= Validator::make($request->all(),$rules );

         if($validator->fails())
         {
             return $this->apiResponse('service_update',null,$validator->errors(),401);
         }

         $service->update([
             'title'=>$request->title,
             'description'=>$request->description,
             'price'=>$request->price,
             'goal'=>$request->goal,
             'target'=>$request->target,
         ]);
         return $this->apiResponse('service_update','update succeed!!');
     }

    public function interest(Service $service)
    {
        if ($service->is_interested){
            $service->decrement('interests');
            $service->interestable()->where('user_id',auth()->id())->delete();
            return $this->apiResponse('service_interest','uninterested');
        }
        $sender = User::with('info')->find(auth()->id());
        $serviceInfo = $service->load('user.info');
        $count = $service->interestable()->get()->count();
        switch ($count){
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
            'user_id' =>$sender->id
        ]);
        $notification = $this->makeNotification($sender,$serviceInfo->user,$service,$message);
        NotificationWasPushed::dispatch($notification);
        $service->refresh();
        $this->checkGoal($service,$serviceInfo->user);
        return $this->apiResponse('service_interest','interested');
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
            $url = "/services/{$service->id}";
            $notification = $receiver->notifications()->create([
                'body'=>$body,
                'url'=>$url
            ]);
            NotificationWasPushed::dispatch($notification);
        }
    }
}
