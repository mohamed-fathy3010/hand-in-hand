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
    public function index(User $user)
    {
        $notifications = Notification::where('user_id',$user->id)->latest()->get();
        return $this->apiResponse('notifications',$notifications);
    }

}
