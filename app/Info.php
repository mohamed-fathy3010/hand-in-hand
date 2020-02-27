<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table='info';
    //
    protected $fillable=[
        'first_name','last_name'
        ,'grade','user_id','gender','avatar'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
