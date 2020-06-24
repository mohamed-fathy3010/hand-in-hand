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
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../css/profileresponsive.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.js">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                    <i id="bell"class="fa fa-bell" aria-hidden="true"></i>
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
                <li><a href="{{url('/services')}}" data-value="port"class="effect">Services</a></li>
                <li><a href="{{url('/events')}}" data-value="foll"class="effect">Events</a></li>
                <li><a href="{{url('/products')}}" data-value="cont"class="effect">Handmade</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </form>
            <!-- menu-->         <div class="menu">
                <button class="toggl">
                    <ul>
                        <li><span></span>
                            <span></span>
                            <span></span>
                            <ul >
                                <li >
                                    <a href="{{url('/items')}}" data-value="about" id="link-nav" class="effect">Items</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/services')}}" data-value="port" id="link-nav"class="effect">Services</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/events')}}" data-value="foll" id="link-nav"class="effect">Events</a>
                                    <hr id="link-nav">
                                    <a href="{{url('/products')}}" data-value="cont" id="link-nav"class="effect">Handmade</a>
                                    <hr id="link-nav">
                                    @guest
                                        <a href="{{url('/login')}}">login</a>
                                        <hr>
                                        <a href="{{url('/register')}}">Register</a>
                                    @endguest
                                    @auth

                                        <a href="{{url('/profile')}}">profile</a>
                                        <hr>
                                        <a href="{{url('/logout')}}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">log out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
<div class="item">
    <div class="imge">
        <img src="{{url('/storage/avatars/'.$user->info->avatar)}}"id="profile">
        <img src="../images/Rectangle2.png"id="linecolor">
    </div>
    <div class="ponts">
        <button id="point" class="point">
        </button>
    </div>
    <div class="words">
        <h5>{{"{$user->info->first_name} {$user->info->last_name} "}}</h5>
    </div>
</div>
<br>

<div class="Details">
    <h1>{{$user->info->grade}}</h1>
    <h3>
        <a href="{{url('profile/edit')}}" style="color: #ff0000;"> Edit</a>
    </h3>
</div>



<div class="description">
    <p><i class="fa fa-user" aria-hidden="true" style="padding-left: 5px;"></i> {{$user->info->gender}} </p>
    <p><i class="fa fa-envelope-o" aria-hidden="true"style="padding-left: 5px;"></i> {{$user->email}}</p>
</div>
<span id="line">

    </span>
{{--<div class="location">--}}
{{--    <h1>my resources</h1>--}}
{{--    <div class="links">--}}
{{--        <button>Items</button>--}}
{{--        <button>Service</button>--}}
{{--        <button id="handmade">Handmade</button>--}}
{{--        <button id="event">Events</button>--}}
{{--    </div>--}}

{{--</div>--}}






{{--<!--start items-->--}}
{{--<div class="cotainer" >--}}
{{--    <div class="row" >--}}
{{--        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12"id="marg-left-1"  >--}}
{{--            <div class="items1">--}}
{{--                <div class="imgbox">--}}
{{--                    <img src="../images/booktitle.jpeg"title="Engineeringtools">--}}
{{--                </div>--}}
{{--                <div class="dateils">--}}
{{--                    <h4  id ="name">Book Titlkb;o huh gk kjfyuy kufy kufy</h4>--}}
{{--                    <div class="price">99999.99</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}





{{--        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" id="marg-left-2" >--}}
{{--            <div class="items1">--}}
{{--                <div class="imgbox">--}}
{{--                    <img src="../images/Engineeringtools.jpeg">--}}
{{--                </div>--}}
{{--                <div class="dateils">--}}
{{--                    <h4 id ="name">Book Title</h4>--}}
{{--                    <div class="price">Free</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}





{{--        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" id="marg-left-3"  >--}}
{{--            <div class="items1">--}}
{{--                <div class="imgbox">--}}
{{--                    <img src="../images/Medicaltools.jpeg">--}}
{{--                </div>--}}
{{--                <div class="dateils">--}}
{{--                    <h4 id ="name">Book Title</h4>--}}
{{--                    <div class="price">Free</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



{{--        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" id="marg-left-4" >--}}
{{--            <div class="items1">--}}
{{--                <div class="imgbox">--}}
{{--                    <img src="../images/tools.jpeg">--}}
{{--                </div>--}}
{{--                <div class="dateils">--}}
{{--                    <h4 id ="name">Book Title</h4>--}}
{{--                    <div class="price">Free</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!--end endwebsite-->

<script src="{{asset('../js/jquery-1.12.4.min.js')}}"></script>


</body>

</html>
