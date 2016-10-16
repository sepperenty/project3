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


    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>
    <script src="{{ url('/js/welcome.js') }}"></script>
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

        .google-maps {

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
        <div class="input-group col-md-6">
            <div class="col-md-6">
                <input type="text" name="loction" class="form-control" placeholder="Locatie" id="searchTextField">
            </div>


            <div class="input-group-btn">
                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Zoeken
                </button>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12 google-maps">
            <div id="map"></div>
        </div>
    </div>

</div>
<script>

</script>
</body>
</html>



