<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = ['interests'];

    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reports(){
        return $this->morphMany(Report::class,'reportable');
    }
}
