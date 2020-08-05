<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>hand in hand</title>
    <link rel="shortcut icon" href="images/HandInHand.png" type="/images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{--    <link rel="stylesheet" href="bootstrab/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="css/normalize.css">--}}
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
{{--    <link rel="stylesheet" href="css/navbar-responsive.css">--}}
    <link rel="stylesheet" href="css/styleresponsive.css">
    <link rel="stylesheet" href="bootstrab/bootstrap.min.js">
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


<!--start svg-->


<!-- start one part background handinhand-->
<div class="landing">
    <div class="landing-image">
        <div class="curve-layer1">
            <svg id="Layer_1" enable-background="new 0 0 2118.717 1335.679" viewBox="0 0 2118.72 1335.68"
                 xmlns:xml="http://www.w3.org/XML/1998/namespace" xml:space="preserve" version="1.1">
                                <g>
                                    <path id="path-1"
                                          d="M 789.706 1335.68 H 0 V 0 h 1190.07 c 0 0 198.486 271.909 -90.762 470.514 c -289.248 198.605 -38.17 382.718 51.742 360.556 c 89.914 -22.162 72.949 0 72.949 0 s -279.918 248.895 -72.949 504.609" />
                                    <div class="hand">
                                        <img src="/images/handinh.png"class="imagelogo">
                                        <img src="/images/Hand.png" class="imagehand">
                                        <div class="text">
                                            <h1>Student Service Zone:</h1>
                                            <h2>faciliate the collaboration among students by providing a space where
                                                you can Share , exchangr , and sell educational materials like books or tools ,Offer services like teaching subjects or answering
                                                college subjects question ,Announce and group events and Sell hand-made products.</h2>
                                            @guest
                                            <a href="{{url('/register')}}" data-value="foll"class="register"> Register</a>
                                            @endguest
                                        </div>
                                    </div>

                                </g>
                           </svg>
        </div>
    </div>
</div>
<!-- end one part background handinhand-->
<!--end svg-->

<br class="space">


<!--start items -->

<div class="cotainer">
    <div class="row" >
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <div class="items">
                <div class="image">
                    <img src="/images/marginalia-education.png"class="ig1">
                    <h3>ITEMS</h3>
                </div>
                <img src="/images/path2.png"class="background1">

                <div class="paragrph">
                    <a href="{{url('/items')}}" data-value="foll"class="showmore">Show more</a>
                    <p>Help other students by share your un used Books or tools</p>
                </div>

            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="items">
                <div class="image">
                    <img src="/images/undraw_collab_8oes.png"class="ig2" >
                    <h3 class="h_service">SERVICES</h3>
                </div>
                <img src="/images/path2.png"class="background2">
                <div class="paragrph">
                    <a href="{{url('/services')}}" data-value="foll"class="showmore">Show more</a>
                    <p class="paragrph3">Help other students by Offer services you can do or ask other stubents for help</p>
                </div>

            </div>
        </div>
    </div>
</div>




<div class="cotainer"id="two_row">
    <div class="row" >
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <div class="items">
                <div class="image">
                    <img src="/images/marginalia-education.png"class="ig3">
                    <h3>EVENTS</h3>
                </div>
                <img src="/images/path2.png"class="background3">

                <div class="paragrph">
                    <a href="{{url('/events')}}" data-value="foll"class="showmore">Show more</a>
                    <p class="paragrph2">know the events in your university oy in your zone</p>
                </div>

            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="items">
                <div class="image">
                    <img src="/images/undraw_good_team_m7uu.png"class="ig4">
                    <h3 class="h_handmade">HANDMADE</h3>
                </div>
                <img src="/images/path2.png"class="background4">
                <div class="paragrph">
                    <a href="{{url('/products')}}" data-value="foll"class="showmore">Show more</a>
                    <p class="paragrph1">Share your handmade works in our website to get more sales from your university students</p>
                </div>

            </div>
        </div>
    </div>
</div>
<!--end items -->


<!--start endwebsite-->
<div class="end">
    <div class="imag">
        <span class="image1"><img src="/images/f.png"></span>
        <span class="image2"><img src="/images/f2.png"></span>
        <span class="image3"><img src="/images/f2.png"></span>
    </div>
    <div class="link">
        <ul>
            <li><a href="#" class="link1">Contact us</a></li>
            <li><a href="#" class="link2">About Us</a></li>
        </ul>
        <div class="social">
            <a class="social1"><i class="fa fa-facebook-official"style="color:#000"></i></a>
            <a class="social2"><i class="fa fa-twitter"style="color:#000"></i></a>
            <p>All copy Rights Reserved to Student Service Zone 2019</p>

        </div>
    </div>
</div>
<!--end endwebsite-->

<script src="/js/jquery-1.12.4.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            notifications: [],
            user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
        },
        created() {
            @auth
                // this.getNotifications();
            console.log('hello user ' + this.user.id);
            window.Echo.channel('user-'+this.user.id).listen('NotificationWasPushed', e =>{
                console.log(e);
            });
            @endauth
        },
        methods: {
            getNotifications() {
                axios.get('/api/users/'+this.user.id+'/notifications')
                    .then((response) => {
                        this.notifications = response.data;
                        console.log(response.data);
                    })
                    .catch(function (error) {
                            console.log(error);
                        }
                    );
            },

        }
    })
</script>
</body>

</html>
