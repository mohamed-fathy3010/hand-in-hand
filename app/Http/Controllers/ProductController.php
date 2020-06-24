<?php

namespace App\Http\Controllers;

use App\Product;
use App\Report;
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
        return view('handmade_description',['product'=>$product]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|string|max:256',
            'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        $imagePath='default.png';
        if($request->hasFile('image'))
        {
            $imagePath= time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('products',$imagePath);
        }
        auth()->user()->products()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return redirect('/products');
    }
    public function update(Request $request,Product $product)
    {
        if(auth()->id()!=$product->user_id) {
            abort(404);
        }

        $validated = $this->validate($request,[
            'title'=>'required|string|max:256',
            'image'=>'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        $imagePath=$product->image;
        if($request->hasFile('image'))
        {
            $imagePath= time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('products',$imagePath);
        }

        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imagePath
        ]);
        return redirect('/products/'.$product->id);
    }

    public function destroy(Product $product){
        if(auth()->id()!=$product->user_id)
        {
            abort(404);
        }

        $product->delete();
        return redirect('/products');

    }


    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','products')
            ->where('user_id',auth()->id())->exists();
    }
    public function report(Request $request, Product $product){

        $this->validate($request, [
            'reason' => 'required|in:spam,inappropriate'
        ]);
        if ($this->isReported($product->id))
        {
            abort(401);
        }
        $product->reports()->create([
            'user_id'=>auth()->id(),
            'reason'=>$request->reason
        ]);
        $product->increment('reports');
        return redirect('/products/'.$product->id);
    }

}
