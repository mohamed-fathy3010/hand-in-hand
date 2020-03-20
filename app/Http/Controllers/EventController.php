<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index()
    {
        $events =  Event::latest()->paginate(16);
        return view('events',['events'=>$events]);
    }
    public function show(Event $event){
        return view('event_description',['event'=>$event]);
    }
}
