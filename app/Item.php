<?php

namespace App;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\filter_traits\ItemsFilter;
use App\Deal;

class Item extends Model
{
    use Filterable,ItemsFilter;
    private static $whiteListFilter =[
        'price',
        'title',
        'created_at'
        ];

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reports(){
        return $this->morphMany(Report::class,'reportable');
    }
    public function deals(){
        return $this->morphMany(Deal::class,'deal');
    }
}
