<!DOCTYPE html>
<html lang="nl">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<nav class="navbar navbar-default">
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
                    <form action="#inhoud">
                        <button type="submit" class="go-to-content">Naar inhoud</button>
                    </form>

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
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{Auth()->user()->name}} - Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>

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
            <div class="col-md-3">
                <h1 class="heading-foter"><span class="line-headers">G</span>emaakt door Graag Gedaan</h1>
                <p>Deze website is gemaakt door 2 knappe studenten van KDG hogeschool.</p>
            </div>
            <div class="col-md-3 contact">
                <h1 class="heading-foter"> <span class="line-headers">O</span>nze doelen</h1>
                <ol>
                    <li>Vrijwilligers een overzicht geven van oproepen die in het buurt zijn.</li>
                    <li>Mensen die hulp nodig hebben de mogelijk geven om hulp te krijgen.</li>
                    <li>Mensen samenbrengen </li>
                </ol>
            </div>
            <div class="col-md-6 contact">
                <h1 class="heading-foter"><span class="line-headers">C</span>ontacteer ons</h1>
                {{ Form::open(array('url' => '/contact/send', 'id'=>'form_project','files' => true)) }}
                {{ csrf_field() }}
                <div class="row">
                    <input name="id" class="id" type="text" value="" hidden>
                    <div class="form-group col-md-6">
                        <label for="naam">Vul je naam(*)</label>
                        <input type="text" name="naam" class="form-control" value="{{ old('naam') }}">
                        @if ($errors->has('naam'))
                            <span>
                                        <strong>{{ $errors->first('naam') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Je email</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="onderwerp">Onderwerp van email</label>
                        <input type="text" name="onderwerp" class="form-control" value="{{ old('onderwerp') }}">
                        @if ($errors->has('onderwerp'))
                            <span>
                                        <strong>{{ $errors->first('onderwerp') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="bericht">Bericht?(*)</label>
                    <textarea name="bericht" cols="10" rows="5"
                              class="form-control ">{{old('bericht')}}</textarea>
                        @if ($errors->has('bericht'))
                            <span>
                                <strong>{{ $errors->first('bericht') }}</strong>
                                </span>
                        @endif
                        <div class="form-group pull-right">
                            <button class="btn btn-primary focus" id="manageBtn">Verzenden</button>
                        </div>
                {{ Form::close() }}
            </div>
        </footer>
    </div>
</div>
</body>
</html>