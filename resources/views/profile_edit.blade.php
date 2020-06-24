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
        <link rel="stylesheet" href="../css/profile edit.css">
        <link rel="stylesheet" href="../css/edit profileresponsive.css" >
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
    <section id="cont">
    <!--Form-->
      <div class="login-form">
          <form class="validate-form" method="post" action="{{url('/profile/update')}}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
                 <center class="photo">
                      <img id="blah" src="{{url('storage/avatars/'.$user->info->avatar)}}" alt="your image" />
                  <div class="update-photo">
                  <input type="file" name="avatar" id="file" class="inputfile" onchange="readURL(this);" />
                 <label for="file">update photo</label>
                  </div>

            </center>
    <!--username Input-->

                      <div class="FirstName">
                      <input class="input1"
                       type="text"
                       name="first_name"
                       required=""
                      value="{{$user->info->first_name}}">
                       <label  class="focus-input">
                        First Name </label>
                   </div>
              <br>
                    <div class="SecondName">
                      <input class="input2"
                       type="text"
                       name="last_name"
                       required=""
                      value="{{$user->info->last_name}}">
                       <label class="focus-input"id="inp2">
                         Second Name</label>
                    </div>
    <!--educationGrade input -->
             <div class="login-form-educationGrade">
                         <input class="input3"
                          type="text"
                          name="grade"
                          required=""
                         value="{{$user->info->grade}}">
                         <label class="focus-input">
                          Education Grade</label>
             </div>
        <!--Email input -->
        <div class="wrap-input4 validate-input">

             <div class="login-form-Email"  data-validate="Email">
                         <input class="input4"
                         type="email"
                         name="email"
                         required=""
                         value="{{$user->email}}">
                         <label class="focus-input" >
                         Email</label>
              </div>
         </div>
{{--        <!--password input -->--}}
{{--        <div class="wrap-input5 validate-input" data-validate="Enter password">--}}

{{--              <div class="login-form-password" >--}}
{{--                             <input class="input5"--}}
{{--                              type="password"--}}
{{--                               name="password"--}}
{{--                               required="">--}}
{{--                             <label class="focus-input" >--}}
{{--                           Password</label>--}}
{{--       <!--icone eye-->--}}
{{--                            <span toggle="#password-field"--}}
{{--                               class="fa fa-fw fa-eye field-icon toggle-password"></span>--}}

{{--              </div>--}}
{{--         </div>--}}
{{--                   <!-- confirm password input -->--}}
{{--        <div class="wrap-input5 validate-input" data-validate="Enter password">--}}

{{--              <div class="login-form-password" >--}}
{{--                             <input class="input5"--}}
{{--                              type="password"--}}
{{--                               name="password"--}}
{{--                               required="">--}}
{{--                             <label class="focus-input" >--}}
{{--                          confirm Password</label>--}}
{{--       <!--icone eye-->--}}
{{--                            <span toggle="#password-field"--}}
{{--                               class="fa fa-fw fa-eye field-icon toggle-password"></span>--}}

{{--              </div>--}}
{{--         </div>--}}
                <!--gender input -->
                <center>
                      <div class="wrap-input5 validate-input" data-validate="Enter gender" id="gender">
                         <tr>
                             <td>
                                 <select>
                                     <option>Gender</option>

                                     <option>female</option>
                                     <option>male</option>
                                 </select>
                             </td>
                         </tr>
                     </div>
                      </center>
                <div class="login-form-gender" >
                 <div>
                 <label class="Gender" for="Gender">Gender</label>
               </div>
               <div class="Male-Famel">
                 <div class="Male_input">
                   <input  type="radio" id="male" name="gender" value="male"{{$user->info->gender ==='male'? "checked":""}}>
                   <label class="male" for="male">Male</label>
                 </div>
                 <div class="Female-input">
                   <input type="radio" id="female" name="gender" value="female"{{$user->info->gender ==='female'? "checked":""}}>
                   <label  class="female"for="female">Female</label>
                 </div>
               </div>
              </div>
       <!--Login Button-->
            <div class="login-form-button">
                          <div>
                             <input class="login-button" type="submit" value="save">

                           </div>
  </div>
  </form>
  </div>
  </section>


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




        <!-- java script-->
<!-------===================================================-------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--==============================================================================-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../js/register.js"> </script>
<!--===============================================================================================-->
    <script src="../js/itemdes.js"> </script>


    </body>

    </html>
