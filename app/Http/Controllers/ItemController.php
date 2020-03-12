<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items=Item::latest()->paginate(20);
        return view('items',[
            'items'=>$items,
            'first_item_style'=>"margin-left: 70px",
            'container_style'=>"margin-top: 350px",
            'new_row'=>false
            ]);
    }
    public function show(Item $item)
    {
        return view('item_description',['item'=>$item]);
    }
}
