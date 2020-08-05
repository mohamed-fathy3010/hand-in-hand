<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>hand in hand</title>
    <link rel="shortcut icon" href="{{asset('images/HandInHand.png')}} " type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/eventdescription.css">
    <link rel="stylesheet" href="../css/eventdesresponsive.css">
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
                <a href="{{url('/')}}" class="navbar-brand"><img src="/images/HandInHand.png"></a>
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
<!-- End Navbar -->

<!--start item-->
<!--start item-->
<div class="item">
    <div class="imge">
        <img src="{{url('storage/events/'.$event->image)}}" id="event" >
        <img src="../images/Rectangle2.png" id="rectangle">
    </div>
    <div class="ponts">
        <button class="point" id="points"></button>
    </div>
    <div class="words">
        <h5>{{$event->title}}</h5>
        <i class="fa fa-star-o"id="star"></i>



        <!-- Trigger/Open The Modal -->
        <button id="myBtn" style="visibility:{{auth()->id() === $event->user_id?"":"hidden" }}">Edit</button>
        <!-- The Modal -->
        <div id="myModal" class="modal"  >
            <!-- Modal content -->
            <div class="content">
                <span class="close" style=" font-size: 28px;color: #ff0000;">&times;</span>
                <form class="edit-item" method="post" action="{{url('/events/'.$event->id)}}">
                    @csrf
                    @method('patch')
                    <!-- select photo -->
                    <center  class="photo">
                        <img id="blah" src="{{url('storage/events/default.png')}}" alt="your image" />
                        <div class="update-photo">
                            <input type="file" name="image" id="file" class="inputfile" onchange="readURL(this);" />
                            <label for="file">select photo</label>
                        </div>
                    </center>
                    <div class="home">

                        <label for="w3review">TiTLe</label>
                        <textarea id="w3review" name="title" rows="1.500" cols="55"style="border-radius: 5px;">
                            {{$event->title}}
               </textarea>

                        <label for="w3review">About</label>
                        <textarea id="w3review" name="about" rows="1.500" cols="55"style="border-radius: 5px;">
                            {{$event->about}}
                  </textarea>
                        <label for="w3review">Location</label>
                        <textarea id="w3review" name="location" rows="1.500" cols="55"style="border-radius: 5px;">
                            {{$event->location}}
                    </textarea>
                        <label for="date">date </label>
                        <input id="date" type="datetime-local" name="date" style="width: 423px;height: 30px;border: 1px solid #666;background-color: #fff;direction:ltr;
     unicode-bidi: bidi-override;" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($event->date))
}}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3" cols="55">
                            {{$event->description}}
               </textarea>
                        <input class="submit" type="submit" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-------------------end edit dailoag---------------------------------------->




<br>
<div class="About">
    <h1>About</h1>
    <p>{{$event->about}}</p>
</div>

<span id="line-1">

         </span>

<div class="description">
    <h1>Description</h1>
    <p>{{$event->description}}</p>
</div>

<span id="line-2">

       </span>

<div class="location">
    <h1>Location</h1>
    <p> <i class="fa fa-map-marker" id="map"aria-hidden="true"></i> {{$event->location}}</p>
</div>
<span id="line-3">

      </span>
<div class="Time">
    <h1>Time</h1>
    <p><i class="fa fa-calendar" id="calender"aria-hidden="true"></i> {{  date('d-m-Y  -  H:i A', strtotime($event->date))}}</p>
{{--    <p><i class="fa fa-clock-o" id="clock"aria-hidden="true"></i> From 3 Pm To 6 Pm</p>--}}
</div>

<!--end item-->
@if(auth()->id() !== $event->user_id)
<form method="post" action="{{url('events/'.$event->id.'/interest')}}">
    @csrf
    <input id="myBtninterest" class="login-button" type="submit" value="Interest">
</form>
@endif
<!-- start buttom delete-->
@if(auth()->id() === $event->user_id)
<form method="post" action="{{url('/events/'.$event->id)}}">
    @csrf
    @method('delete')
    <input id="myBtndelete" class="login-button" type="submit" value="delete" >
</form>
@endif
<!-- end buttom delete-->
<!-- start buttom delete-->
@if(auth()->id() !== $event->user_id)
<button id="myBtnreport">Report</button>
@endif
<div id="myModalete" class="modal"  >
    <!-- Modal content -->
    <div class="contentreport">
        <span class="closereport" style=" font-size: 35px;color: #ff0000;">&times;</span>
        <form class="edit-item" method="post" action="{{url('/events/'.$event->id.'/report')}}">
            <!-- select photo -->
            @csrf
            <center>
            <div class="homereport">
                <div class="spam-inappropriate">
                    <div class="spam_input">
                        <input  type="radio" id="spam"  value="spam" name="reason" >
                        <label class="spam" for="spam">spam</label>
                    </div>
                    <div class="inappropriate-input">
                        <input type="radio" id="inappropriate" name="reason" value="inappropriate" >
                        <label  class="inappropriate"for="inappropriate">inappropriate</label>
                    </div>
                    <br>
                    <input class="submit" type="submit" value="save">
                </div>
            </div>
            </center>
        </form>
    </div>

</div>


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
<script src="../js/itemdes.js"> </script>

</body>

</html>
