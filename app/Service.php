<?php

namespace App;

use App\filter_traits\ServicesFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Interest;

class Service extends Model
{
    //
    use Filterable,ServicesFilter;
    private static $whiteListFilter =[
        'price',
        'title',
        'created_at'
    ];
    protected $guarded=['interests'];
    protected $dates=['created_at','updated_at'];
    protected $appends=['is_interested'];

    public function getIsInterestedAttribute(){
        return Interest::where('user_id',auth()->id())
            ->where('interest_type','services')
            ->where('interest_id',$this->id)->exists();
    }

    public function user(){
       return $this->belongsTo(User::class,'user_id');
    }
    public function reports(){
        return $this->morphMany(Report::class,'reportable');
    }
    public function interestable(){
        return $this->morphMany(Interest::class,'interest');
    }
}

