<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>hand in hand</title>
    <link rel="shortcut icon" href="../images/HandInHand.png" type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/servicedescription.css">
    <link rel="stylesheet" href="../css/servicedesresponsive.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.js">
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
<div class="navbar elem-center" id="app">
    <div class="container">
        <div class="parent left-right">
            <div class="navbar-header">
                <a href="" class="navbar-brand"><img src="/images/HandInHand.png"></a>
                @auth
                    <i id="bell" class="fa fa-bell" aria-hidden="true"></i>
                @endauth
                <div class="language">
                    <!-- select from 2 option-->
                    <select>
                        <option>English</option>
                        <option>عربي</option>

                    </select>

                </div>

            </div>
            <ul class="nav navlist" id="links">
                <li class="active">
                    <a href="{{url('/items')}}" data-value="about" class="effect">Items</a></li>
                <li><a href="{{url('/services')}}" data-value="port" class="effect">Services</a></li>
                <li><a href="{{url('/events')}}" data-value="foll" class="effect">Events</a></li>
                <li><a href="{{url('/products')}}" data-value="cont" class="effect">Handmade</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </form>
            <!-- menu-->
            <div class="menu">
                <button class="toggl">
                    <ul>
                        <li><span></span>
                            <span></span>
                            <span></span>
                            <ul>
                                <li>
                                    <a href="{{url('/items')}}" data-value="about" id="link-nav"
                                       class="effect">Items</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/services')}}" data-value="port" id="link-nav" class="effect">Services</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/events')}}" data-value="foll" id="link-nav"
                                       class="effect">Events</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/products')}}" data-value="cont" id="link-nav" class="effect">Handmade</a>
                                    <hr id="link-nav">
                                    @guest
                                        <a href="{{url('/login')}}">login</a>
                                        <hr>
                                        <a href="{{url('/register')}}">Register</a>
                                    @endguest
                                    @auth

                                        <a href="{{url('/profile')}}">profile</a>
                                        <hr>
                                        <a href="{{url('/logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">log out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
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
<!--end nevbar-->
<!--start item-->
<div class="Workshop">
    <h4>{{$service->title}}</h4>
            <p>
                @if ($service->created_at->diffInDays() > 30)
                    {{$service->created_at->toFormattedDateString()}}
                @else
                    {{$service->created_at->diffForHumans()}}
                @endif
            </p>
</div>
<!-- Trigger/Open The Modal -->
<button id="myBtn" style="visibility:{{auth()->id() === $service->user_id?"":"hidden" }}">Edit</button>
<!-- The Modal -->
<div id="myModal" class="modal">

    <div class="content">
        <span class="close" style=" font-size: 35px;color: #ff0000;">&times;</span>
        <form class="edit-item" method="post" action="{{url('/services/'.$service->id)}}">
            @csrf
            @method('patch')
            <div class="home">
                <label for="w3review">Description</label>
                <textarea id="w3review" name="description" rows="3" cols="55">
                    {{$service->description}}
              </textarea>

                <label for="w3review">TiTLe</label>
                <textarea id="w3review" name="title" rows="2" cols="55">
                    {{$service->title}}
              </textarea>

                <label for="w3review">Target</label>
                <textarea id="w3review" name="target" rows="2" cols="55">
                    {{$service->target}}
                 </textarea>
                <label for="w3review">Price</label>
                <input type="number" name="price" style="width: 430px;" value="{{$service->price}}">
                <div class="goal">
                    <label for="w3review">goal</label>
                    <input type="number" name="goal" style="width: 430px;" value="{{$service->goal}}">
                </div>
                <br>
                <input class="submit" type="submit" value="save">
            </div>
        </form>
    </div>

</div>

<div class="Interests">
    <h6> Interests</h6>
    <p><span>{{$service->interests}}</span> people are interest in the service.</p>

</div>
<span id="line-1">

           </span>
<div class="Goal">
    <h5> Goal to start</h5>
    <p>the service will to start when interest become <span>{{$service->goal}}</span>.</p>
</div>
<span id="line-2">

           </span>
<div class="description">
    <h1> Service Description</h1>
    <p>{{$service->description}}</p>
</div>

<span id="line-3">

           </span>

<div class="price">
    <h2>Price</h2>
    <p>{{$service->price>0?$service->price.' LE':"Free"}}</p>
</div>

<span id="line-4">

           </span>

<div class="target">
    <h3>Target</h3>
    <p>This service ia avilable to <span>{{$service->target}}</span> only.</p>
</div>


@if(auth()->id() !== $service->user_id)
<div class="butt">
    <div class="share">
        <i class="fa fa-share-alt" aria-hidden="true" name="share"></i>
    </div>
    <button><i class="fa fa-star-o" aria-hidden="true"></i><br>Interest</button>
    <div class="circle">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
    </div>
</div>
@endif
<!--end item-->


<!-- start buttom delete-->
<form method="post" action="{{url('/services/'.$service->id)}}">
    @csrf
    @method('delete')
    @if(auth()->id() === $service->user_id)
    <input id="myBtndelete" class="login-button" type="submit" value="delete">
    @endif
</form>
<!-- end buttom delete-->
<!-- start buttom delete-->
@if(auth()->id() !== $service->user_id)
<button id="myBtnreport">Report</button>
@endif
<div id="myModalete" class="modal">
    <!-- Modal content -->
    <div class="contentreport">
        <span class="closereport" style=" font-size: 35px;color: #ff0000;">&times;</span>
        <form class="edit-item" action="{{url('services/'.$service->id.'/report')}}" method="post">
           @csrf
            <!-- select photo -->


            <div class="homereport">
                <div class="spam-inappropriate">
                    <div class="spam_input">
                        <input type="radio" id="spam" value="spam" name="reason">
                        <label class="spam" for="spam">spam</label>
                    </div>
                    <div class="inappropriate-input">
                        <input type="radio" id="inappropriate" value="inappropriate" name="reason">
                        <label class="inappropriate" for="inappropriate">inappropriate</label>
                    </div>

                    <br>
                    <input class="submit" type="submit" value="save">
                </div>
            </div>
        </form>
    </div>

</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- end buttom delete-->

<!--start endwebsite-->
<div class="end">
    <div class="imag">
        <span class="image1"><img src="../images/f.png"></span>
        <span class="image2"><img src="../images/f2.png"></span>
        <span class="image3"><img src="../images/f2.png"></span>
    </div>
    <div class="link">
        <ul>
            <li><a href="#" class="link1">Contact us</a></li>
            <li><a href="#" class="link2">About Us</a></li>
        </ul>
        <div class="social">
            <a class="social1"><i class="fa fa-facebook-official"></i></a>
            <a class="social2"><i class="fa fa-twitter"></i></a>
            <p>All copy Rights Reserved to Student Service Zone 2019</p>

        </div>
    </div>
</div>
<!--end endwebsite-->

<script src="../js/jquery-1.12.4.min.js"></script>
<script src="../js/itemdes.js"></script>
</body>
</html>
