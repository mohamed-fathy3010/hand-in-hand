<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $guarded = [];

    public function markAsRead(){
        return $this->update(['is_read' => 1]) ;
    }

    public function interest(){
        return $this->belongsTo(Interest::class,'interest_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
