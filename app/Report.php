<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded=[
        'created_at',
        'updated_at'
        ];
    //
    public function reportable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
