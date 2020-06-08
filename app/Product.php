<?php

namespace App;

use App\filter_traits\ProductsFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Deal;


class Product extends Model
{
    //
    use Filterable,ProductsFilter;
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

    public function deals(){
        return $this->morphMany(Deal::class,'deal');
    }
}
