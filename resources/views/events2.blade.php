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
    <link rel="stylesheet" href="../css/events.css">
    <link rel="stylesheet" href="../css/events2.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../css/eventresponsive.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.js">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {{--    <script src="https://kit.fontawesome.com/a076d05399.js"></script>--}}
    <script src="{{asset('js/app.js')}}"></script>
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
<!--end nevbar-->

<div class="cotainer" id="event">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="items">
                <div class="image">
                    <img src="../images/marginalia-education.png" class="ig1"
                         style="width: 40%;height: 110%;transform: rotatey(180deg);position: absolute;margin: 0px 0 0 0px;">
                    <h3>EVENTS</h3>
                </div>
                <img src="../images/path2.png" class="background1">

                <div class="paragrph">

                    <p class="paragrph2">know the events in your university or in your zone.</p>
                </div>

            </div>
        </div>
    </div>
</div>


<!--start fileter-->
<div class="filter" style="margin-bottom: 80px">
    <button><i class="fa fa-filter"></i>Filter</button>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Add</button>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="content">
            <span class="close" style=" font-size: 35px;color: #ff0000;">&times;</span>
            <form class="edit-item" method="post" action="{{url('/events')}}" enctype="multipart/form-data">
            @csrf
            <!-- select photo -->
                <center class="photo">
                    <img id="blah" src="{{url('storage/events/default.png')}}" alt="your image"/>
                    <div class="update-photo">
                        <input type="file" name="image" id="file" class="inputfile" onchange="readURL(this);"/>
                        <label for="file">select photo</label>
                    </div>
                    <!---- end select photo-->
                </center>
                <div class="home">

                    <label for="w3review">TiTLe</label>
                    <textarea id="w3review" name="title" rows="1.500" cols="55" style="border-radius: 5px;">
             </textarea>

                    <label for="w3review">About</label>
                    <textarea id="w3review" name="about" rows="1.500" cols="55" style="border-radius: 5px;">
                </textarea>
                    <label for="w3review">Location</label>
                    <textarea id="w3review" name="location" rows="1.500" cols="55" style="border-radius: 5px;">
                  </textarea>
                    <label for="w3review">date </label>
                    <input type="datetime-local" name="date" style="width: 423px;height: 30px;border: 1px solid #666;background-color: #fff;direction:ltr;
          unicode-bidi: bidi-override;">
                    <br>

                    <label for="w3review" style="margin-top: 30px;">Description</label>
                    <textarea id="w3review" name="description" rows="3" cols="55">
             </textarea>
                    <br>
                    <input class="submit" type="submit" value="save">
                    <!---- end dialog from-->
                </div>
            </form>
        </div>

    </div>
</div>
<!--end fileter-->


<!--start events-->
@foreach($events as $event)
    <div id="events">
        <div class="right-sec">

            <div class="in-star">
                <i style="color:{{$event->is_interested?'#ff0000':'#fff'}}" id="star{{$event->id}}"
                   class="{{$event->is_interested?'fa fa-star':'fa fa-star-o'}}" aria-hidden="true"
                   @auth
                   onclick="interest({{$event->id}})"
                @endauth></i>
            </div>


            <p style="color: white" id="in-text{{$event->id}}">{{$event->is_interested?'interested':'interest'}}</p>
        </div>
        <div class="left-sec">
            <a style="text-decoration: none" href="{{{url('/events/'.$event->id)}}}">
                <div
                    style="
                        background: linear-gradient(
                        to bottom,
                        rgba(255, 255, 255, 0),
                        #00363d9d 70%
                        ),
                        url({{url('/storage/events/'.$event->image)}});
                        background-repeat: no-repeat;
                        background-size: cover;
                        "
                    class="events-bg"
                >
                    <p>{{$event->title}}</p>
                </div>
            </a>
        </div>
    </div>

@endforeach
{{$events->links('vendor.pagination.default',['margin'=>100])}}
<div class="end" style="margin-top: 50px">
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

<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="../js/itemdes.js"></script>
<script>

    function interest(eventId) {
        var star = document.getElementById('star' + eventId);
        var in_text = document.getElementById('in-text' + eventId);
         event.preventDefault();
        axios.post('/events/' + eventId + '/interest');
        if (in_text.innerText === 'interest') {
            in_text.innerText = 'interested';
            star.className = 'fa fa-star';
            star.style.color = '#ff0000'
        } else {
            in_text.innerText = 'interest';
            star.className = 'fa fa-star-o';
            star.style.color = '#fff';
        }
    }
</script>
</body>
</html>
