<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->


    <!--scripts-->


    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>
    @yield('header')


    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <style>
        #map_form {
            height: 250px;
            width: 100%;
        }
    </style>

    <!-- scripts -->
    <!-- root script altijd van boven staan -->


    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {{--<script src="{{ url('/js/app.js')}}"></script>--}}


</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="nav-font-size">
        <div class="navbar-header">
            <!--Logo linkt naar homepage-->
            <!--<a href="http://www.vioe.be/">-->
            <!--<img src="vioe-logo.png" alt="Home VIOE - Vlaams Instituut voor het Onroerend Erfgoed" /></a>-->

            <a class="navbar-brand" href="/"><img class="brand-logo" src="/images/medium/GraagGedaan-small.png"
                                                  alt="home Graag Gedaan - Vrijwilligerswerk voor mindervaliden"></a>
        </div>


        <div class="collapse navbar-collapse navbar-ex1-collapse navbar-right">
            <ul class="nav navbar-nav ">

                <li>
                    <button type="submit" class="go-to-content">Naar inhoud</button>
                </li>
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="pull-left back">Home</a>
                </li>
                <li class="{{ Request::is('projects/add') ? 'active' : '' }}">
                    <a href="/projects/add">Plaats oproep</a>
                </li>

                @if((Auth()->check()) && (Auth()->user()->hasProject()))
                    <li class="{{ Request::is('projects/beheer') ? 'active' : '' }}">
                        <a href="/projects/beheer">beheer oproepen</a>
                    </li>
                @endif


                @if (Auth::guest())
                    <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="{{ Request::is('register') ? 'active' : '' }}"><a
                                href="{{ url('/register') }}">Register</a></li>


                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

@if(!empty($message))

    <div class="alert alert-info">
        {{$message}}
    </div>

@endif

@yield('welcome')
<div class="container">


</div>
<div id="wrap">
    <div id="main">
        @yield('content')
        @yield('show_page')
    </div>
</div>


<div class="container-fluid ">
    <div class="row">
        <footer class="footer">
            <H1><a href="/contact">Gemaakt door Graag Gedaan<p>Voor vragen of opmerkingen contacteer ons</p></a></H1>
        </footer>
    </div>
</div>
</body>
</html>