<?php
namespace App\filter_traits;
use Illuminate\Database\Eloquent\Builder;

trait EventsFilter{

    public function event_name_Like(Builder $builder, $value)
    {
        return $builder->where('title','like','%'.$value.'%');
    }
}
