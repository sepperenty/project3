<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project3-Zorg voor elkar</title>

    <!-- styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
          rel="stylesheet">

    <!-- scripts -->
    <!-- root script altijd van boven staan -->
    <script src="{{ url('/js/root.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 500px;
            width: 100%;
        }
        .google-maps{

        }
    </style>

</head>
<body>

<img src="https://s3.amazonaws.com/media.jetstrap.com/JWZlwmDlSOeKHUkE7Jp1_Wireframe.png"
     width="100%" height="250px">
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Brand</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Link</a>
                </li>
                <li>
                    <a href="#">Link</a>
                </li>
                @if (Route::has('login'))
                    <li>
                        <a href="{{ url('/login') }}">Login</a>
                    <li>
                        <a href="{{ url('/register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="row">
        <div class="col-md-12 google-maps"><div id="map"></div></div>
    </div>

</div>
<script>
    $(function () {



        console.log(getBaseUrl());


        function initMap() {
            var myLatLng = {lat: 51.2194475, lng: 4.4024643};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng
            });

            var jqxhr = $.get( root+"/api/projects", function() {
                console.log("success");
            })
                    .done(function(data) {
                        console.log('second succes',data);

                            if(data){
                                for (i = 0; i < data.length; i++) {

                                    var infowindow = new google.maps.InfoWindow();
                                    var marker, i;

                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(data[i].lat, data[i].lng),
                                        map: map
                                    });

                                    google.maps.event.addListener(marker, 'click', (function(marker, i) {

                                        var urlproject = getBaseUrl()+'projects/'+data[i].id+'/show';
                                        console.log(urlproject);

                                        var contentString = '<div id="content"> <img src="'+data[i].foto+'" '+
                                                '<div id="siteNotice">'+
                                                '</div>'+
                                                '<h1 id="firstHeading" class="firstHeading">'+data[i].title+'</h1>'+
                                                '<div id="bodyContent">'+

                                                '<p>'+data[i].description+'</p>'+'<div><a href="'+urlproject+'">meer</a><div>'+

                                                '</div>'+
                                                '</div>';

                                        return function() {
                                            infowindow.setContent(contentString);
                                            infowindow.open(map, marker);
                                        }

                                    })(marker, i));
                                }
                            }else {
                                alert("data base gegevens zijn leeg");
                            }

                    })
                    .fail(function() {
                        console.log("error")
                    });



        }
        google.maps.event.addDomListener(window, 'load', initMap);


//        $.get( "ajax/test.html", function( data ) {
//            console.log(data);
//        });




    });
</script>
</body>
</html>



