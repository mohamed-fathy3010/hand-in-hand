<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Events\NotificationWasPushed;
use App\Product;
use App\Report;
use App\User;
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
        $data = array_chunk($products->items(),4);
        return view('handmade',[
            'products'=>$products,
            'data'=>$data
        ]);
//        return view('handmade',[
//            'products'=>$products,
//            'first_product_style'=>"margin-left: 70px",
//            'container_style'=>"margin-top: 350px",
//            'new_row'=>false
//        ]);
    }
    public function show(product $product)
    {
        $is_requested =$this->hasDeal($product,auth()->id());
        $is_reported =$this->isReported($product->id);
        return view('handmade_description',['product'=>$product,'is_requested'=>$is_requested,'is_reported'=>$is_reported]);
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

    public function request(Product $product)
    {
        $sender = User::with('info')->find(auth()->id());
        $productInfo = $product->load('user.info');


        $deal = $product->deals()->create([
            'buyer_id' =>$sender->id,
            'owner_id' => $productInfo->user->id
        ]);
        $notification = $this->makeNotification($sender,$productInfo->user,$deal,'is interested in one of your products');
        NotificationWasPushed::dispatch($notification);
        return redirect('/products/'.$product->id);

    }

    private function hasDeal($product,$buyerId):bool {
        return Deal::where('deal_type','products')
            ->where('deal_id',$product->id)
            ->where('buyer_id',$buyerId)
            ->where('owner_id',$product->user->id)->exists();
    }

    private function makeNotification($sender, $receiver, $deal,$message){
        $first_name = $sender->info->first_name;
        $last_name = $sender->info->last_name;
        $body = "{$first_name} {$last_name} {$message}";
        $url = "/deals/{$deal->id}";
        return $receiver->notifications()->create([
            'body'=>$body,
            'url' => $url
        ]);
    }

}
