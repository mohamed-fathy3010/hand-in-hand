<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hand in hand</title>
    <link rel="shortcut icon" href="{{asset('images/HandInHand.png')}} " type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('bootstrab/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/handemade.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrab/bootstrap.min.js')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>

    </style>
    <script>
        /*global $, alert, console*/

        $(".toggle").click(function () {

            'use strict';

            $(".navlist").toggleClass("show");

        });
    </script>
</head>
<body>

<!-- Start Navbar -->
<div class="navbar elem-center">
    <div class="container">
        <div class="parent left-right">
            <div class="navbar-header">
                <button class="toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a href="/" class="navbar-brand"><img src="{{asset('images/HandInHand.png')}}"></a>
            </div>
            <ul class="nav navlist" id="links" style="margin-left:450px;margin-top: 10px;position: absolute;">
                <li class="active">
                    <a href="{{url('/products')}}" data-value="about" class="effect">products</a></li>
                <li><a href="#" data-value="port" class="effect">Services</a></li>
                <li><a href="#" data-value="foll" class="effect">Events</a></li>
                <li><a href="#" data-value="cont" class="effect">Handmade</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </form>
            <div class="menu">
                <button class="toggl">
                    <ul>
                        <li><span></span>
                            <span></span>
                            <span></span>
                            <ul>
                                <li>
                                    @guest
                                        <a href="{{url('/login')}}">login</a>
                                        <a href="{{url('/register')}}">Register</a>
                                    @endguest
                                    @auth
                                        <a href="{{url('/profile/'.auth()->id())}}">profile</a>
                                    @endauth
                                </li>
                            </ul>
                        </li>
                    </ul>

                </button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<!-- End Navbar -->

<div class="cotainer">
    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            <div class="items">
                <div class="image">
                    <img src="{{asset('images/undraw_good_team_m7uu.png')}}" style="width: 40%;height: 100%;transform: rotateY(180deg);position: absolute;margin: 0px 10px 10px 0px;" >
                    <h3>HANDMADE</h3>
                </div>
                <img src="{{asset('images/Path2.png')}}" style="width: 1300px; height: 315px;position: relative">
                <div class="paragrph">
                    <p class="paragrph1">Share your handmade works in our website to get more sales from your university students.</p>
                </div>

            </div>
        </div>
    </div>
</div>



<!--start fileter-->
<div class="filter">
    <button><i class="fa fa-filter"></i>Filter</button>
</div>
<!--end fileter-->


<!--start products-->
@foreach($products as $product)
    @if($loop->first||$new_row)
        <div class="cotainer" @if($new_row)
        @php($new_row=false)
        style="{{$container_style}}"
            @endif>
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                    <div class="items1">
                        <div class="imgbox">
                            <a href="{{url('/product/'.$product->id)}}">
                                <img src="{{url('/storage/products/'.$product->image)}}" title="engineering tools">
                            </a>
                        </div>
                        <div class="dateils">
                            <h4 style="margin-top: 10px;
                               margin-left: 13px;
                               font-size: 20px;
                                height: 50px;
                                overflow: hidden;"
                                title="{{$product->title}}">{{$product->title}}</h4>
                            <div class="price">{{$product->price>0?$product->price.' LE':"Free"}}</div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="{{$first_product_style}}">
                        <div class="items1">
                            <div class="imgbox">
                                <a href="{{url('/products/'.$product->id)}}">
                                    <img src="{{url('storage/products/'.$product->image)}}">
                                </a>
                            </div>
                            <div class="dateils">
                                <h4 style="margin-top: 10px;
                               margin-left: 13px;
                               font-size: 20px;
                               height: 50px;
                               overflow: hidden;"
                                    title="{{$product->title}}">{{$product->title}}</h4>
                                <div class="price">{{$product->price>0?$product->price.' LE':"Free"}}</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($loop->iteration%4==0||$loop->last)
                    @php($new_row=true)
            </div>
        </div>
    @endif
@endforeach

<!--end products-->
<!--start endwebsite-->
<div class="end">
    <div class="imag">
        <span class="image1"><img src="{{asset('images/f.png')}}"></span>
        <span class="image2"><img src="{{asset('images/f2.png')}}"></span>
        <span class="image3"><img src="{{asset('images/f2.png')}}"></span>
    </div>
    <div class="link">
        <ul>
            <li><a href="#" class="link1">Contact us</a></li>
            <li><a href="#" class="link2">About Us</a></li>
        </ul>
        <div class="social">
            <a class="social1"><i class="fa fa-facebook-official	" style="color:#000"></i></a>
            <a class="social2"><i class="fa fa-twitter" style="color:#000"></i></a>
            <p>All copy Rights Reserved to Student Service Zone 2019</p>

        </div>
    </div>
</div>
<!--end endwebsite-->

<script src="../js/jquery-1.12.4.min.js"></script>
</body>
</html>
