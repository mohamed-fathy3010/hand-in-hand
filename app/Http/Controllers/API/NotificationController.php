<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationWasPushed;
use App\Http\Controllers\Controller;
use App\Deal;
use App\Notification;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    use ApiResponseTrait;
    //
    public function index()
    {
        $notifications = Notification::where('user_id',auth()->id())->latest()->get();
        return $this->apiResponse('notifications',$notifications);
    }

    public function show(Notification $notification){
        if (auth()->id() !== $notification->user_id){
            return $this->apiResponse('show_notification',null,'unauthorized action',401);
        }
        $notification->markAsRead();
        return $this->apiResponse('notification' , $notification);
    }

}
