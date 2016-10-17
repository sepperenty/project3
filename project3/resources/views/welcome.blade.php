<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- styles -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <!--Pagina's hebben een betekenisvolle titel-->
    <!--bv title>Openingsuren bibliotheek - gemeente Aalst</title>-->
    <!--naam van de bedrijf achteraan plaatsen behaalve voor home page -> altijd naam van website vermelden-->
    <title>Graag gedaan, Vrijwilligerswerk voor mindervaliden </title>


    <!--styles-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
          rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">


    <!--scripts-->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>
    <script src="{{ url('/js/welcome.js') }}"></script>
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
                <li class="active">
                    <a href="#" class="pull-left back">Home</a>
                </li>
                <li>
                    <a href="/projects/manage">Plaats oproep</a>
                </li>
                <li>
                    <!--Linkteksten zijn betekenisvol binnen hun context-->
                    <a href="#">Over Graag Gedaan</a>
                </li>
                <li>
                    <!--Linkteksten zijn betekenisvol binnen hun context-->
                    <a href="#">Contact</a>
                </li>

                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>


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

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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


<div class="container-fluid">

    <div class=" google-maps">
        <div id="map"></div>

        <div class=" google-maps-search">
            <fieldset class="search-fieldset">
                <legend>Zoeken op google maps</legend>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Categorie <span
                                    class="glyphicon glyphicon-align-justify"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Noodoproep</a></li>
                            <li><a href="#">Gewoon oproep</a></li>
                            <li><a href="#">Bedrijven</a></li>
                        </ul>
                    </div><!-- /btn-group -->
                    <input type="text" name="seach" class="form-control" aria-label="..." placeholder="Locatie">
                    <span class="input-group-btn">
                         <button class="btn btn-default" type="button">Zoek <span
                                     class="glyphicon glyphicon-search"></span></button>
                     </span>
                </div>
            </fieldset>

        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div>
</div>

<div class="container-fluid content-home">
    <div class="col-md-3 content-home-child">
        <img class="introduction-img" src="/images/medium/question.png" alt="Icon met een vraagteken">
        <h1>Wat is Graag Gedaan</h1>
        <p>ndustry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type
            and scrambled it to make a type specimen book.
            It has survived not only five centuries, but
            also the leap </p>
        <button class="head-button">Registreer & plaats oproep</button>
    </div>
</div>

<div class="container-fluid ">
    <div class="row extra-info">
        <div class="col-md-4">
            <p>Er zoeken</p>
            <h1>{{$amountProjectUsers}}</h1>
            <p>mensen hulp</p>
        </div>
        <hr>
        <div class="col-md-4">
            <p>Er zijn</p>
            <h1>{{$amountProjectCompanys}}</h1>
            <p>bedrijven gerigistreerd</p>
        </div>
        <hr>
        <div class="col-md-4">
            <p>We zijn trots op onze</p>
            <h1>{{$amountRegistered}}</h1>
            <p>Geregistreerde leden</p>
        </div>
    </div>

</div>


<div class="container-fluid foto-gallery">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12 heading">
            <h1>Fotogelerij getuigenissen</h1>
            <p>Hier worden ervaringen gedeeld door middel van foto&apos;s</p>
        </div>

        @foreach($randomPictures as $picture)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <div class="img-frame">
                    <img src="/images/medium/{{$picture->name}}.jpg" alt="...">
                    <div class="caption">
                        <p>{{$picture->picture_info}}</p>
                    </div>
                </div>
            </div>
        </div>
            @endforeach


    </div>
</div>


<!--En plaats de footer-div altijd onderaan in de broncode.-->

<div class="container-fluid footer">

    <div class="row">
        <footer>
            <H1><a href="/contact">Gemaakt door Graag Gedaan<p>Voor vragen of opmerkingen contacteer ons</p></a></H1>

        </footer>

    </div>
</div>
</body>
</html>



