<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    //
    protected $fillable =['body','image'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
