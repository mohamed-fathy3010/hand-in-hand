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
    <link rel="stylesheet" href="../css/items.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../css/itemresponsive.css">
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

<div class="cotainer" id="item">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="items">
                <div class="image">
                    <img src="/images/marginalia-education.png" class="ig1"
                         style="width: 40%;height: 110%;transform: rotateY(180deg);position: absolute;margin: 0px 0 0 0px;">
                    <h3>ITEMS</h3>
                </div>
                <img src="/images/path2.png" class="background1">

                <div class="paragrph">

                    <p>Help other students by share your un used Books or tools.</p>
                </div>

            </div>
        </div>
    </div>
</div>

<div>

    <!--start fileter-->
    <div class="filter">
        <button><i class="fa fa-filter"></i>Filter</button>
        <!-- Trigger/Open The Modal -->
        <button id="myBtn">Add</button>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="content">
                <span class="close" style=" font-size: 35px;color: #ff0000;">&times;</span>
                <form class="edit-item" action="{{url('/items')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- select photo -->
                    <center class="photo">
                        <img id="blah" src="{{url('storage/items/default.png')}}" alt="your image"/>
                        <div class="update-photo">
                            <input type="file" name="image" id="file" class="inputfile" onchange="readURL(this);"/>
                            <label for="file">select photo</label>
                        </div>
                    </center>
                    <div class="home">


                        <label for="w3review">TiTLe</label>
                        <textarea id="w3review" name="title" rows="1.500" cols="55">
                                 </textarea>

                        <label for="w3review">Phone</label>
                        <textarea id="w3review" name="phone" rows="1.500" cols="55">
                                 </textarea>
                        <label for="w3review">facebook</label>
                        <textarea id="w3review" name="facebook" rows="1.500" cols="55">
                                     </textarea>
                        <label for="w3review">Price</label>
                        <input type="number" name="price"
                               style="width: 430px;background: white;border:1px solid rgb(118,118,118) ">
                        <br>
                        <br>
                        <label for="w3review" style="margin-top: 10px">Description</label>
                        <textarea id="w3review" name="description" rows="3" cols="55">
                                </textarea>
                        <br>
                        <input class="submit" type="submit" value="save">
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!--end fileter-->

</div>

<!--start items-->
{{--@foreach($items as $item)--}}
{{--    @if($loop->first||$new_row)--}}
{{--        <div class="cotainer" @if($new_row)--}}
{{--        @php($new_row=false)--}}
{{--        style="margin-top: 350px"--}}
{{--            @endif>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">--}}
{{--                    <div class="items1">--}}
{{--                        <div class="imgbox">--}}
{{--                            <img src="{{url('/storage/items/'.$item->image)}}" title="engineering tools">--}}
{{--                        </div>--}}
{{--                        <div class="dateils">--}}
{{--                            <h4 id="name" title="{{$item->title}}">{{$item->title}}</h4>--}}
{{--                            <div class="price">{{$item->price>0?$item->price.' LE':"Free"}}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @else--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12" id="marg-left-2" >--}}
{{--                        <div class="items1">--}}
{{--                            <div class="imgbox">--}}

{{--                                <img src="{{url('storage/items/'.$item->image)}}">--}}

{{--                            </div>--}}
{{--                            <div class="dateils">--}}
{{--                                <h4 id="name"--}}
{{--                                    title="{{$item->title}}">{{$item->title}}</h4>--}}
{{--                                <div class="price">{{$item->price>0?$item->price.' LE':"Free"}}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if($loop->iteration%4==0||$loop->last)--}}
{{--                    @php($new_row=true)--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <br>--}}
{{--    @endif--}}
{{--@endforeach--}}
@foreach($data as $container)
    <div class="cotainer" id="{{$loop->iteration !== 1?'marg-top':''}}">
        <div class="row">
            @foreach($container as $item)
                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12"
                @switch($loop->iteration)
                    @case(1)
                        {{''}}
                        @break
                        @case(2)
                        {{'id=marg-left-2'}}
                        @break
                        @case(3)
                        {{'id=marg-left-3'}}
                        @break
                        @case(4)
                        {{'id=marg-left-4'}}
                        @break
                    @endswitch
                >
                    <div class="items1">
                        <a href="{{url('/items/'.$item->id)}}">
                        <div class="imgbox">
                            <img src="{{url('storage/items/'.$item->image)}}">
                        </div>
                        </a>
                        <div class="dateils">
                            <h4 id="name">{{$item->title}}</h4>
                            <div class="price">{{$item->price>0?$item->price.' LE':"Free"}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <br>
@endforeach
@php($margin=450)

{{$items->links('vendor.pagination.default',['margin'=>$margin])}}

<!--end items-->

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

<script src="{{asset('../js/jquery-1.12.4.min.js')}}"></script>
<script src="../js/itemdes.js"></script>


</body>

</html>
