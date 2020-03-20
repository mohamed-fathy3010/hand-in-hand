<?php

namespace App;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\filter_traits\ItemsFilter;
class Item extends Model
{
    use Filterable,ItemsFilter;
    protected $guarded = [];

    private static $whiteListFilter =[
        'price',
        'title',
        'created_at'
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reports(){
        return $this->morphMany(Report::class,'reportable');
    }
}
