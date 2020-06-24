<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $guarded =[];

    public function getOwnerStatusAttribute($value){
        return is_null($value)? -1 : $value;
    }
    public function getBuyerStatusAttribute($value){
        return is_null($value)? -1 : $value;
    }
    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }



    public function dealable(){
        return $this->morphTo();
    }


}
