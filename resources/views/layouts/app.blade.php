<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Set website title -->
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                        <img src="/logo.png"style="width:20px;height:20px;">
                    </a>
                    <a class="navbar-brand">{{ config('app.name') }}</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <form>
                                <input id="navSearch" name="user_id" placeholder="Search a profile..." oninput='onInput()' list="users">
                                <datalist id="users">
                                    <option value=""></option>
                                </datalist>
                            </form>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li> <a href="{{ route('users.index') }}">Users</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(Auth::user()->admin == 1)
                                <li> <a href="{{ route('requests.index') }}">Requests</a></li>
                            @endif

                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function onInput() {
            var link;
            var val = document.getElementById("navSearch").value;
            var opts = document.getElementById('users').childNodes;
            for (var i = 0; i < opts.length; i++) {
                if (opts[i].value === val) {
                    link=opts[i].outerHTML.split('href="')[1].split('"');
                    window.location = link[0];
                    break;
                }
            }
        }
    </script>

    <script>
        $("#navSearch").on("keyup", function(event) {
            console.log("entra");
            var _this = $(this);
            $.get("{{ url('search/profile')}}",
                { option: $("#navSearch").val() },
                function(users) {
                    console.log(users);
                    $("#users").empty();
                    for (var u in users) {
                        $('#users').append('<option href="/users/' + users[u].id + '/profile" data-value="' + users[u].id + '">' + users[u].name + ' ('+ users[u].id+')' + '</option>');
                        //data-value ??
                    }
                    _this.focus();
            })
        });
    </script>
</body>
</html>