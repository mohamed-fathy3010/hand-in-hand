<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>hand in hand</title>
      <link rel="shortcut icon" href="images/HandInHand.png" type="/images/HandInHand.png"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="bootstrab/bootstrap.min.css">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="css/loginresponsive.css">
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
      <form class="validate-form" method="POST" action="{{route('login')}}">
        @csrf
            <!--Email Input-->
  <div class="wrap-input1 validate-input" data-validate="Enter email">

            <div class="login-form-email">
                  <input class="input1"
                  type="text"
                  name="email"
                  required="">
                   <label class="focus-input"> Email</label>
            </div>
  </div>
            <br />
           <!--Pass Input-->
  <div class="wrap-input5 validate-input" data-validate="Enter password">

                   <div class="login-form-password">
                        <input class="input5"
                        type="password"
                        name="password"
                        required="">
                      <label class="focus-input"> password</label>
                       <!--icone eye-->
                       <span toggle="#password-field"
                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                     </div>
   </div>
          <br />

          <!--Forget pass container-->
                      <span class="forget-pass">
                       <a class="login-form-forgetpassword" href="#">
                                  Forget Your Password?</a
                                      ></span>
          <br />
          <!--Login Button-->
                      <input class="login-form-button" type="submit" value="Login">
          <!--New acc container-->
                         <div class="new-account">
                         <p>Need an account? <span class="Register">
                         <a class="link-resister" href="{{route('register')}}"  > Register </a> </span></p>
              </div>
        </form>
      </div>
    </section>
           <!-- java script-->
<!-------===================================================-------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--==============================================================================-->
<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/login.js')}}"> </script>
<!--===============================================================================================-->


  </body>
</html>

