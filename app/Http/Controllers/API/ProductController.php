<?php

namespace App\Http\Controllers\API;

use App\Deal;
use App\Events\NotificationWasPushed;
use App\Http\Controllers\Controller;
use App\Product;
use App\Report;
use App\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    use ApiResponseTrait;

    public function create(Request $request){
        $validator= Validator::make($request->all(), [
            'title'=>'required|string|max:256',
            'image'=>'image',
            'price'=>'required',
            'phone'=>'max:15'

        ]);
        if($validator->fails())
        {
            return $this->apiResponse('create_product',null,$validator->errors(),401);
        }
        $imagePath='default.png';
        if ($request->hasFile('image'))
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
        return $this->apiResponse('create_product','product created');
    }
    public function index(ModelFilters $modelFilters)
    {
        if (!empty($modelFilters->filters()))
            $products=product::filter($modelFilters)->paginate(16);
        else
            $products=product::latest()->paginate(16);
        return $this->apiResponse('products',$products);
    }

    public function report(Request $request, Product $product){
        $validator= Validator::make($request->all(), [
            'reason' => 'required|in:spam,inappropriate'
        ]);
        if($validator->fails())
        {
            return $this->apiResponse('product_report',null,$validator->errors(),401);
        }
        if ($this->isReported($product->id))
        {
            return $this->apiResponse('product_report',null,'this product is already reported',401);
        }
        $product->reports()->create([
            'user_id'=>auth()->id(),
            'reason'=>$request->reason
        ]);
            $product->increment('reports');
        return $this->apiResponse('product_report','reported!!!');
    }
    private function isReported($id):bool {
        return Report::where('reportable_id',$id)
            ->where('reportable_type','products')
            ->where('user_id',auth()->id())->exists();
    }
    public function destroy(Product $product){
        if(auth()->id()!=$product->user_id)
        {
            return $this->apiResponse('product_delete',null,'Unauthorized action',401);
        }

        $product->delete();
        return $this->apiResponse('product_delete','product deleted!!!');

    }
    public function update(Request $request,Product $product)
    {
        if(auth()->id()!=$product->user_id) {
            return $this->apiResponse('product_update', null, 'Unauthorized action', 401);
        }
        $hasImage=$request->hasFile('image');
        $id = auth()->id();
        $rules =[
            'title'=>'required|string|max:256',
            'price'=>'required',
            'phone'=>'max:15'
        ];
        $imageRules = $rules;
        $imageRules['image']='image';
        if($hasImage) {
            $validator = Validator::make($request->all(), $imageRules);
        }
        else
        {
            $validator= Validator::make($request->all(),$rules );
        }

        if($validator->fails())
        {
            return $this->apiResponse('product_update',null,$validator->errors(),401);
        }
        if($hasImage)
        {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $request->image->storeAs('products', $imageName);
        }
        else {
            $imageName = product::where('user_id', $id)->first()->image;
            if ($request->image !== $imageName) {
                $imageName = 'default.png';
            }
        }

        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'image'=>$imageName
        ]);
        return $this->apiResponse('product_update','update succeed!!');
    }
    public function show(Product $product)
    {
        return $this->apiResponse('product',$product);
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
        return $this->apiResponse('product_deal','requested');

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
