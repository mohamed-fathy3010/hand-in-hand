<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>hand in hand</title>
    <link rel="shortcut icon" href="{{asset('images/HandInHand.png')}} " type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('bootstrab/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
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
                    <a href="{{url('/items')}}" data-value="about" class="effect">Items</a></li>
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
<!--start item-->
<div class="item">
    <div class="imge">
        <img src="{{url('storage/avatars/'.$info->avatar)}}"
             style="width: 100%;height: 100%;position: absolute;margin: 0px 0 0 0;">
        <img src="{{asset('images/Rectangle2.png')}}"
             style="width: 100%; height: 300px;position: relative;margin: 200px 0 0 0;border-radius: 10px;">
    </div>
    {{--            <div class="ponts">--}}
    {{--                <i class="fa fa-arrow-left" style="margin:20px 0 0 30px ;position: absolute;"></i>--}}
    {{--                <button class="point"style="width:10px;margin: 30px 0px 0 0;padding-left: 60px;">--}}
    {{--                                          <ul>--}}
    {{--                                             <li><span></span>--}}
    {{--                                                 <span></span>--}}
    {{--                                                 <span></span>--}}
    {{--                                             </li>--}}
    {{--                                          </ul>--}}
    {{--                                    </button>--}}
    {{--            </div>--}}
    <div class="words">
        <h5>{{$info->first_name.' '.$info->last_name}}</h5>
    </div>
</div>
<br>

<div class="Details">
    <h1>Details</h1>
    <h3>Edit</h3>
</div>


<div class="description">
    <p><i class="fa fa-user" aria-hidden="true" style="padding-left: 5px;"></i> Bio </p>
    <p><i class="fa fa-map-marker" aria-hidden="true" style="padding-left: 5px;"></i> minyat El-Qamh Asharquira </p>
    <p><i class="fa fa-envelope-o" aria-hidden="true" style="padding-left: 5px;"></i> {{$user->email}}</p>
</div>
<span style="width: 400px;height: 3px; background:#5B5959;position: absolute;margin: 730px 0 0 500px;">

    </span>
<div class="location">
    <h1>shares</h1>
    <div class="links">
        <button>Items</button>
        <button>Service</button>
        <button>Handmade</button>
        <button>Events</button>
    </div>

</div>
<div class="cotainer">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
            <div class="items1">
                <div class="imgbox">
                    <img src="{{asset('images/booktitle.jpeg')}}">
                </div>
                <div class="dateils">
                    <h4 style="margin-top: -6px;">Book Title<span><br><a href="Rockport.html">Rockport Sharp & Ready Chukka Boot</a></span>
                    </h4>
                    <div class="price">Free</div>
                </div>
            </div>
        </div>


        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="margin-left: 60px;">
            <div class="items1">
                <div class="imgbox">
                    <img src="{{asset('images/Engineeringtools.jpeg')}}">
                </div>
                <div class="dateils">
                    <h4 style="margin-top: -6px;">Book Title<span><br><a href="Rockport.html">Rockport Sharp & Ready Chukka Boot</a></span>
                    </h4>
                    <div class="price">Free</div>
                </div>
            </div>
        </div>


        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="margin-left: 50px;">
            <div class="items1">
                <div class="imgbox">
                    <img src="{{asset('images/Medicaltools.jpeg')}}">
                </div>
                <div class="dateils">
                    <h4 style="margin-top: -6px;">Book Title<span><br><a href="Rockport.html">Rockport Sharp & Ready Chukka Boot</a></span>
                    </h4>
                    <div class="price">Free</div>
                </div>
            </div>
        </div>


        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="margin-left: 60px;">
            <div class="items1">
                <div class="imgbox">
                    <img src="{{asset('images/tools.jpeg')}}">
                </div>
                <div class="dateils">
                    <h4 style="margin-top: -6px;">Book Title<span><br><a href="Rockport.html">Rockport Sharp & Ready Chukka Boot</a></span>
                    </h4>
                    <div class="price">Free</div>
                </div>
            </div>
        </div>
    </div>
</div>
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

<script src="{{asset('../js/jquery-1.12.4.min.js')}}"></script>


</body>

</html>
