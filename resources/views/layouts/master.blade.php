<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('css/nav3.css')}}"/>
    @stack('css')
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<nav id="app">
    <section id="logo">
        <a href="{{url('/')}}"> <img src="/images/Hand.png" alt=""/> </a>
        <i class="fas fa-bell"></i>
    </section>
    <section id="search">
        <div class="search-container">
            <form action="">
                <input type="text" placeholder="Search.." name="search"/>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </section>
    <section id="navs-reg">
        <div>
            <i id="menu" class="fas fa-bars" onmousedown="toggleB()"></i>
            <div id="navs" class="navs-cont">
                <a href="{{url('/items')}}">Items</a>
                <a href="{{url('/services')}}">Services</a>
                <a href="{{url('/events')}}">Events</a>
                <a href="{{url('/products')}}">Handmade</a>
            </div>
        </div>
        <div id="dropdown-container">
            <i id="user-icon" class="fas fa-user-circle" onmousedown="toggleA()">
            </i>
            <div id="register" class="reg-cont">
                @guest
                    <a href="{{url('/register')}}">Register</a>
                    <a href="{{url('/login')}}">login</a>
                @endguest
                @auth
                    <a href="{{url('/profile')}}">profile</a>
                    <a href="{{url('/logout')}}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </section>
</nav>
@yield('banner')
@yield('content')
@yield('footer')
<script>



    function toggleA() {
        var register = document.getElementById("register");
        if (register.style.display === "flex") {
            register.style.display = "none";
        } else {
            register.style.display = "flex";
        }
    }

    function toggleB() {
        var navs = document.getElementById("navs");
        if (navs.style.display === "flex") {
            navs.style.display = "none";
        } else {
            navs.style.display = "flex";
        }
    }
</script>
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
@stack('js')
</body>
</html>
