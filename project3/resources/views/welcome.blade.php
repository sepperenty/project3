@extends('layouts.app')


@section('header')
        <!-- styles -->
{{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
<title>Home - Graag Gedaan</title>
<!--Pagina's hebben een betekenisvolle titel-->
<!--bv title>Openingsuren bibliotheek - gemeente Aalst</title>-->
<!--naam van de bedrijf achteraan plaatsen behaalve voor home page -> altijd naam van website vermelden-->

<script src="{{ url('/js/welcome.js') }}"></script>
@endsection


@section('welcome')


    <div class="container-fluid {{ Auth()->check() ? ' ' : 'google-maps-top' }}  ">
        @if(!Auth()->check())
            <div class=" content-home">
                <div class="col-md-5" id="inhoud">

                    <img class="introduction-img" src="/images/medium/question.png">

                    <h1><span class="line-headers">w</span>at kunnen wij voor u betekenen.</h1>
                    <p>
                        Zijn er zaken waarbij je een helpende hand kunt gebruiken ? Klik dan op "plaats oproep" en vul het formulier in.
                        Ons doel is vrijwilligerswerk makkelijk te maken.
                    </p>
                    <p>
                        Deze website is gemaakt om hulpzoekenden en vrijwilligers samen te brengen. Zoek je adres op de kaart en kijk wie je in de buurt kan helpen.
                    </p>

                    <form action="/projects/add">
                        <button class="btn btn-default">
                            @if(Auth()->check())
                                plaats oproep
                            @else
                                Login & plaats oproep
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        @endif
        <div class=" {{ Auth()->check() ? ' google-maps' : 'col-md-7  google-maps' }}  ">
            <div id="map"></div>
            <div class=" google-maps-search">
                <fieldset class="search-fieldset">
                    <legend>Zoek</legend>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Categorie <span
                                        class="glyphicon glyphicon-align-justify"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Persoon</a></li>
                                <li><a href="#">Bedrijven</a></li>
                                <li><a href="#">Noodoproep</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                        <input type="text" name="seach" id="searchTextField" class="form-control" aria-label="..."
                               placeholder="Locatie">
            <span class="input-group-btn">
            <button class="btn btn-primary" id="search_button" type="button">Zoek <span
                        class="glyphicon glyphicon-search"></span></button>
            </span>
                    </div>
                </fieldset>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>



    <div class="container-fluid ">
        <div class="row extra-info">
            {{--<div class="col-md-4">--}}
            {{--<p>Er zoeken</p>--}}
            {{--<p class="cijfers">{{$amountProjectUsers}}</p>--}}
            {{--<p>mensen hulp</p>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="col-md-4 content-extra">--}}
            {{--<p>Er zijn</p>--}}
            {{--<p class="cijfers">{{$amountProjectCompanys}}</p>--}}
            {{--<p>bedrijven gerigistreerd</p>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="col-md-4">--}}
            {{--<p>We zijn trots op onze</p>--}}
            {{--<p class="cijfers">{{$amountRegistered}}</p>--}}
            {{--<p>Geregistreerde leden</p>--}}
            {{--</div>--}}

            <div class="col-md-12 home-header ">
                <h1><span class="line-headers"> F</span>otogalerij getuigenissen</h1>
                <p>Hier worden ervaringen gedeeld door middel van foto&apos;s.</p>
            </div>

        </div>

    </div>


    <div class="container-fluid foto-gallery">
   
            <!-- <a href="/pictures/add" class="btn btn-primary col-md-offset-5 margin-top">FOTO TOEVOEGEN</a> -->

        <div class="row">
            {{--<div class="col-md-12 col-sm-12 col-lg-12 heading">--}}
            {{--<h1>Fotoglerij getuigenissen</h1>--}}
            {{--<p>Hier worden ervaringen gedeeld door middel van foto&apos;s</p>--}}

            {{--</div>--}}
        </div>


        <div class="row">
            @foreach($randomPictures as $picture)
                <div class="col-sm-6 col-md-3 frame">
                    <div class="thumbnail uploadPicture">
                        <img src="/images/medium/{{$picture->name}}" alt="{{$picture->picture_info}}">
                       <!--  <div class="caption">
                           <h3>{{$picture->picture_info}}</h3>
                       </div> -->
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>


    <!--En plaats de footer-div altijd onderaan in de broncode.-->


@endsection




