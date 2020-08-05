@extends('layouts.master')
   @push('css')
    <link rel="stylesheet" href="../css/itemdescription.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/itemdescresponcive.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

   @endpush



<!--start item-->
@section('content')
<div class="item">
    <div class="imge">
        <img src="{{url('storage/items/'.$item->image)}}" id="book" >
        <img src="../images/Rectangle2.png" id="rectangle" >
    </div>
    <div class="ponts">
    </div>
    <div class="words">
        <h5>{{$item->title}}</h5>
        <!-- Trigger/Open The Modal -->
        <button id="myBtn" style="visibility:{{auth()->id() === $item->user_id?"":"hidden" }} " >Edit</button>

        </div>
    </div>

<br>
<div class="description">
    <h1>Description</h1>
    <p>{{$item->description}}</p>
</div>

<span id ="line1">

           </span>

<div class="price">
    <h2>Price</h2>
    <p>{{$item->price>0?$item->price.' LE':"Free"}}</p>
</div>

<span id="line2">

           </span>

<div class="contacts">
    <h3>contacts</h3>
    <p><i class="fa fa-phone" id="phone"></i>{{$item->phone}}</p>
    <p><i class="fa fa-facebook-square" id="facebook" aria-hidden="true"></i>{{$item->facebook}}</p>
</div>

@if(auth()->id() !== $item->user_id)

<div class="butt">
    <form>
    <button type="submit" >Booking Request</button>
    </form>
</div>
@endif
<!--end item-->

<!-- start buttom delete-->
@if(auth()->id() === $item->user_id)
<form method="post" action="{{url('items/'.$item->id)}}">
    @csrf
    @method('delete')
    <input id="myBtndelete" class="login-button" type="submit" value="delete">
</form>
@endif
<!-- end buttom delete-->
<!-- start buttom delete-->
@if(auth()->id() !== $item->user_id)
<button id="myBtnreport">Report</button>
@endif

@endsection
<!-- end buttom delete-->

