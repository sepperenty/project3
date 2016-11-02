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

    @extends('layouts.app')


    <!--styles-->
    @section('header')
    <script src="{{ url('/js/welcome.js') }}"></script>
        @endsection
</head>
<body>


@section('welcome')

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
                    <input type="text" name="seach" id="searchTextField" class="form-control" aria-label="..." placeholder="Locatie">
                    <span class="input-group-btn">
                         <button class="btn btn-default" id="search_button" type="button">Zoek <span
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
        <h1>Wat kunnen wij voor u doen?</h1>
        <p>
            Deze website is gemaakt voor hulpzoekende en vrijwilligers.
            Wil je graag vrijwilligers werk doen maar weet je niet waar te beginnen ?
            Zoek je adres op de kaart en kijk wie je in de buurt kan helpen. 
        </p>
        <p>
            Zijn er zaken waarbij je een helpende hand kunt gebruiken ? Klik dan op plaats oproep en vul het formulier in.
            Onze doel is vrijwilligerswerk makkelijk maken.
        </p>
       
            <a href="/projects/add">
                 <button class="head-button">
                 @if(Auth()->check())
                plaats oproep
                 @else 
                Login & plaats oproep
                @endif
                 </button>
            </a>
       
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
        <div class="col-md-4 content-extra">
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
            @if(Auth()->check())
            <a href="/pictures/add" class="btn btn-primary">upload</a>
            @endif
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


@endsection
</body>
</html>



