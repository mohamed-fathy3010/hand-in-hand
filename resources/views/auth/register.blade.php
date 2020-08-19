<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <!--------------------------------------------------------------------------------------------------->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="shortcut icon" href="images/hand-logo.png" type="image/jpg" />
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Resister.css" />
    <link rel="stylesheet" type="text/css" href="../css/resisterresponsive.css" />
    <!----============================================================================================-->
    <link rel="shortcut icon" href="../images/HandInHand.png" type="../images/HandInHand.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrab/bootstrap.min.css">
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

<div class="navbar elem-center">
    <div class="container">
        <div class="parent left-right">
            <div class="navbar-header">
                <a href="{{url('')}}" class="navbar-brand"><img src="../images/HandInHand.png"></a>
            </div>
            <ul class="nav navlist" id="links">
                <li class="active">
                    <a href="{{url('/items')}}" data-value="about" class="effect">Items</a></li>
                <li><a href="{{url('/services')}}" data-value="port" class="effect">Services</a></li>
                <li><a href="{{url('/events')}}" data-value="foll" class="effect">Events</a></li>
                <li><a href="{{url('/products')}}" data-value="cont" class="effect">Handmade</a></li>
            </ul>
            <form id="search"class="navbar-form navbar-right">
                <input type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </form>
            <div class="menu">
                <button class="toggl">
                    <ul>
                        <li><span></span>
                            <span></span>
                            <span></span>
                            <ul >
                                <li >
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

<!--Login section container-->
<section id="cont">
    <!--Form-->
    <div class="login-form">
        <form class="validate-form" method="post" enctype="multipart/form-data">
            @csrf
            <center class="photo">
                <img id="blah" src="../images/undraw_male_avatar_323b.png" alt="your image" />
                <div class="update-photo">
                    <input type="file" name="avatar" id="file" class="inputfile
                                       " onchange="readURL(this);" />
                    <label for="file" class="update-photo" style="background: none">select photo</label>
                </div>

            </center>
            <!--username Input-->
            <div class="login-form-username">

                <div class="FirstName">
                    <input class="input1"
                           type="text"
                           name="first_name"
                           required="">
                    <label  class="focus-input">
                        First Name </label>
                </div>

                <div class="SecondName">
                    <input class="input2"
                           type="text"
                           name="last_name"
                           required="">
                    <label class="focus-input"id="inp2">
                        Second Name</label>
                </div>
            </div>
            <!--educationGrade input -->
            <div class="login-form-educationGrade">
                <input class="input3"
                       type="text"
                       name="grade"
                       required="">
                <label class="focus-input">
                    Education Grade</label>
            </div>
            <!--Email input -->
            <div class="wrap-input4 validate-input">

                <div class="login-form-Email"  data-validate="Email">
                    <input class="input4"
                           type="email"
                           name="email"
                           required="">
                    <label class="focus-input" >
                        Email</label>
                </div>
            </div>
            <!--password input -->
            <div class="wrap-input5 validate-input" data-validate="Enter password">

                <div class="login-form-password" >
                    <input class="input5"
                           type="password"
                           name="password"
                           required="">
                    <label class="focus-input" >
                        Password</label>
                    <!--icone eye-->
                    <span toggle="#password-field"
                          class="fa fa-fw fa-eye field-icon toggle-password"></span>

                </div>
            </div>
            <!-- confirm password input -->
            <div class="wrap-input5 validate-input" data-validate="Enter password">

                <div class="login-form-password" >
                    <input class="input5"
                           type="password"
                           name="password_confirmation"
                           required="">
                    <label class="focus-input" >
                        confirm Password</label>
                    <!--icone eye-->
                    <span toggle="#password-field"
                          class="fa fa-fw fa-eye field-icon toggle-password"></span>

                </div>
            </div>
            <!--gender input -->
            <center>
                <div class="wrap-input5 validate-input" data-validate="Enter gender" id="gender">
                            <select>
                                <option>Gender</option>

                                <option>female</option>
                                <option>male</option>
                            </select>
                </div>
            </center>
            <div class="login-form-gender" >
                <div>
                    <label class="Gender" for="Gender">Gender</label>
                </div>
                <div class="Male-Famel">
                    <div class="Male_input">
                        <input  type="radio" id="male" name="gender" value="male">
                        <label class="male" for="male">Male</label>
                    </div>
                    <div class="Female-input">
                        <input type="radio" id="female" name="gender" value="female">
                        <label  class="female"for="female">Female</label>
                    </div>
                </div>
            </div>
            <!--Login Button-->
            <div class="login-form-button">
                <div>
                    <input class="login-button" type="submit" value="Sign up">

                </div>
                <div class="new-account">
                             <span> <a href="{{url('/login')}}"
                                       target="blank" id="account"> Already have an account?</a>    </span>
                </div>
            </div>
        </form>
    </div>
</section>
<!----====================================================================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--==============================================================================-->
<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/register.js')}}"> </script>
<!--===============================================================================================-->
<script src="../js/itemdes.js"> </script>
</body>
</html>

