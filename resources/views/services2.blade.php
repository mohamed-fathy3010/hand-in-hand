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
    <link rel="stylesheet" href="{{asset('css/service.css')}}">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../css/serviceresponsive.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.js">
    <script src="{{asset('js/app.js')}}"></script>
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



<div class="cotainer">
    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="service">
            <div class="items">
                <div class="image">
                    <img src="../images/undraw_collab_8oes.png" class="ig1"style="width: 40%;height: 110%;transform: rotateY(180deg);position: absolute;margin: -1px 0 0 0px;" >
                    <h3>SERVICE</h3>
                </div>
                <img src="../images/path2.png"class="background1">

                <div class="paragrph">

                    <p class="paragrph2">Help other students by Offer services you can do or ask other stubents for help.</p>
                </div>

            </div>
        </div>
    </div>
</div>



<!--start fileter-->
<div class="filter">
    <button><i class="fa fa-filter"></i>Filter</button>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Add</button>
    <!-- The Modal -->
    <div id="myModal" class="modal"  >
        <!-- Modal content -->
        <div class="content">
            <span class="close" style=" font-size: 35px;color: #ff0000;">&times;</span>
            <form class="edit-item" action="{{url('/services')}}" method="post">
                @csrf
                <center>
                <div class="home">
                    <label for="w3review">Description</label>
                    <textarea id="w3review" name="description" rows="3" cols="55">
                          </textarea>

                    <label for="w3review">TiTLe</label>
                    <textarea id="w3review" name="title" rows="2" cols="55">
                          </textarea>

                    <label for="w3review">Target</label>
                    <textarea id="w3review" name="target" rows="2" cols="55">
                             </textarea>
                    <label for="w3review">Price</label>
                    <input type="number" name="price" style="width: 430px;">
                    <div  class="goal">
                        <label for="w3review">goal</label>
                        <input type="number" name="goal" style="width: 430px;">
                    </div>
                    <br>
                    <input class="submit" type="submit" value="save">
                    <!---- end dialog from-->
                </div>
                </center>
            </form>
        </div>

    </div>
</div>





<!--start service-->
@foreach($services as $service)
<center>
    <div class="interest" style="margin-top:{{$margin.'px'}}">
        <h3>{{$service->title}}</h3>
        <h4>
            @if ($service->created_at->diffInDays() > 30)
           {{$service->created_at->toFormattedDateString()}}
            @else
           {{$service->created_at->diffForHumans()}}
            @endif
        </h4>
        <a style="text-decoration: none" href="{{url('/services/'.$service->id)}}"><p>{{$service->description}}</p></a>
        <span></span>
        <br>
        <br>
        <a id="star-link" style="text-decoration: none;color: #ff0000" href="" onclick="interest({{$service->id}})"><i id="star" class="fa fa-star-o"></i><br>Interest</a>
    </div>
</center>
    @php($margin = $margin + $margin_counter)
@endforeach
<!--end item-->

{{$services->links('vendor.pagination.default',['margin'=>$margin])}}


<!--start endwebsite-->
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
<script src="../js/itemdes.js"> </script>
<script >
    var star= document.getElementById('star');
    var starLink=document.getElementById('star-link')
    function interest(serviceId) {
        event.preventDefault();
        // console.log(starLink.innerText)
        axios.post('/services/' + serviceId + '/interest');
        if (starLink.innerText == 'Interest')
        {
            console.log('interest')
            starLink.innerText= 'Interested'
            star.className='fa fa-star'
        }
        else{
            starLink.innerText= 'Interest'
            star.className='fa fa-star-o'

        }
    }
</script>
</body>
</html>
