<?php

namespace App\Http\Controllers;

use App\Service;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
public function index(ModelFilters $modelFilters)
{
    if (!empty($modelFilters->filters()))
        $services=Service::filter($modelFilters)->paginate(20);
    else
        $services=Service::latest()->paginate(20);
    return view('services',['services'=>$services]);
}
}
