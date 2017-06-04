<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand">
                    <img src="{{asset('/logo.png')}}" alt="Print It" style="width:20px;height:20px;">
                </a>
                <a class="navbar-brand">{{ config('app.name') }}</a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <form>
                            <input id="navSearch" name="user_id" placeholder="Search a profile..." oninput='onInput()'
                                   list="users">
                            <datalist id="users">
                                <option value=""></option>
                            </datalist>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @if(Auth::user()->admin == 1)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="">Administration
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('requests.index') }}">Requests</a></li>
                                    <li><a href="{{ route('users.blocked') }}">Blocked Users</a></li>
                                    <li><a href="{{ route('comments.index') }}">Blocked Comments</a></li>
                                    <li><a href="{{ route('departments.index') }}">Departments</a></li>
                                    <li><a href="{{ route('printers.index') }}">Printers</a></li>
                                </ul>
                            </li>
                        @endif
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
                link = opts[i].outerHTML.split('href="')[1].split('"');
                window.location = link[0];
                break;
            }
        }
    }
</script>

<script>
    $("#navSearch").on("keyup", function (event) {
        console.log("entra");
        var _this = $(this);
        $.get("{{ url('search/profile')}}",
            {option: $("#navSearch").val()},
            function (users) {
                console.log(users);
                $("#users").empty();
                for (var u in users) {
                    $('#users').append('<option href="/users/' + users[u].id + '/profile" data-value="' + users[u].id + '">' + users[u].name + ' (' + users[u].id + ')' + '</option>');
                }
                _this.focus();
            })
    });
</script>