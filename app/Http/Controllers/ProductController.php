<?php

namespace App\Http\Controllers;

use App\Product;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
            $products=Product::filter($modelFilters)->paginate(20);
        else
            $products=Product::latest()->paginate(20);
        return view('handmade',[
            'products'=>$products,
            'first_product_style'=>"margin-left: 70px",
            'container_style'=>"margin-top: 350px",
            'new_row'=>false
        ]);
    }
    public function show(product $product)
    {
        return view('product_description',['product'=>$product]);
    }
}
