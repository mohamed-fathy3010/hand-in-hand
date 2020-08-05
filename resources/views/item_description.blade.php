<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hand in hand</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/HandInHand.png')}}" type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/itemdescription.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/navbar-responsive.css">
    <link rel="stylesheet" href="../css/itemdescresponcive.css">
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
        <img src="{{url('storage/items/'.$item->image)}}" id="book" >
        <img src="../images/Rectangle2.png" id="rectangle" >
    </div>
    <div class="ponts">
    </div>
    <div class="words">
        <h5>{{$item->title}}</h5>
        <!-- Trigger/Open The Modal -->
        <button id="myBtn" style="visibility:{{auth()->id() === $item->user_id?"":"hidden" }} " >Edit</button>
        <!-- The Modal -->
        <div id="myModal" class="modal"  >
            <!-- Modal content -->
            <div class="content">
                <span class="close" style=" font-size: 35px;color: #ff0000;">&times;</span>
                <form class="edit-item" method="post" action="{{url('items/'.$item->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                    <!-- select photo -->
                    <center  class="photo">
                        <img id="blah" src="{{url('/storage/items/'.$item->image)}}" alt="your image" />
                        <div class="update-photo">
                            <input type="file" name="image" id="file" class="inputfile" onchange="readURL(this);" />
                            <label for="file">select photo</label>
                        </div>
                    </center>
                    <div class="home">
                        <label for="w3review">Description</label>
                        <textarea id="w3review" name="description" rows="3" cols="55">
                            {{$item->description}}
                  </textarea>

                        <label for="w3review">Title</label>
                        <textarea id="w3review" name="title" rows="2" cols="55">
                            {{$item->title}}
                  </textarea>

                        <label for="w3review">Phone</label>
                        <textarea id="w3review" name="phone" rows="2" cols="55">
                            {{$item->phone}}
                     </textarea>
                        <label for="w3review">facebook</label>
                        <textarea id="w3review" name="facebook" rows="2" cols="55">
                            {{$item->facebook}}
                       </textarea>
                        <label for="w3review">Price</label>
                        <input type="number" name="price" style="width: 430px;" value="{{$item->price}}">
                        <br>
                        <input class="submit" type="submit" value="save">
                    </div>
                </form>
            </div>

        </div>
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
    <button onclick="event.preventDefault();
     document.getElementById('request-form').submit();">
        @if($is_requested)
            {{'Requested'}}
            @else
        {{'booking request'}}
            @endif
    </button>
</div>
<form id="request-form" action="{{url('items/'.$item->id.'/request')}}" method="POST" style="display: none;">
    @csrf
</form>
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
<button id="myBtnreport">{{$is_reported?'Reported':'Report'}}</button>
@endif
<div id="myModalete" class="modal">
    <!-- Modal content -->
    <div class="contentreport">
        <span class="closereport" style=" font-size: 35px;color: #ff0000;">&times;</span>
        <form class="edit-item" method="post" action="{{url('items/'.$item->id.'/report')}}">
            @csrf
            <div class="homereport">
                <div class="spam-inappropriate">
                    <div class="spam_input">
                        <input  type="radio" id="spam"  value="spam" name="reason">
                        <label class="spam" for="spam">spam</label>
                    </div>
                    <div class="inappropriate-input">
                        <input type="radio" id="inappropriate" value="inappropriate" name="reason">
                        <label  class="inappropriate"for="inappropriate">inappropriate</label>
                    </div>
                    <br>
                    <input class="submit" type="submit" value="save">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- end buttom delete-->
<!-- start end website -->
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

<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="../js/itemdes.js"> </script>

</body>
</html>
