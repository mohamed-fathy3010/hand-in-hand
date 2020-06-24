<?php

namespace App;

use App\filter_traits\EventsFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Interest;
use Illuminate\Support\Carbon;


class Event extends Model
{
    use Filterable,EventsFilter;

    protected $guarded = ['interests'];
    protected $appends =['is_interested'];
    private static $whiteListFilter =[
        'title',
        'created_at',
        'interests'
    ];
    //



//    public function getDateAttribute($value)
//    {
//        return $this->asDateTime($value)->format('d-m-Y  -  H:i A');
//    }

    public function getIsInterestedAttribute(){
       return \App\Interest::where('user_id',auth()->id())->
            where('interest_type','events')->where('interest_id',$this->id)->exists();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reports(){
        return $this->morphMany(Report::class,'reportable');
    }

    public function interestable(){
        return $this->morphMany(Interest::class,'interest');
    }
}
