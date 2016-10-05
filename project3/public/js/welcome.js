$(function () {
    var map;
    var cons_zoom_closup =12;
    function initMap() {
        var myLatLng = {lat: 51.2194475, lng: 4.4024643};

        init_map( 51.2194475,4.4024643,cons_zoom_closup);

        // map = new google.maps.Map(document.getElementById('map'), {
        //     zoom: 12,
        //     center: myLatLng
        // });
        var jqxhr = $.get("/api/projects", function () {
            console.log("success");
        })
            .done(function (data) {
                console.log('second succes', data);
                if (data) {
                    for (i = 0; i < data.length; i++) {

                        var infowindow = new google.maps.InfoWindow();
                        var marker, i;

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[i].lat, data[i].lng),
                            map: map
                        });

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {

                            var urlproject = '/projects/' + data[i].id + '/show';
                            console.log(urlproject);

                            var contentString = '<div id="content"> <img src="' + data[i].foto + '" ' +
                                '<div id="siteNotice">' +
                                '</div>' +
                                '<h1 id="firstHeading" class="firstHeading">' + data[i].title + '</h1>' +
                                '<div id="bodyContent">' +

                                '<p>' + data[i].description + '</p>' + '<div><a href="' + urlproject + '">meer</a><div>' +

                                '</div>' +
                                '</div>';

                            return function () {
                                infowindow.setContent(contentString);
                                infowindow.open(map, marker);
                            }

                        })(marker, i));
                    }
                    initialize();
                } else {
                    alert("data base gegevens zijn leeg");
                }
            })
            .fail(function () {
                console.log("error")
            });


    }



    var placeSearch, autocomplete,input;

    function initialize() {
        $(".info_location").fadeOut("fast");
        input  = document.getElementById('searchTextField');

        google.maps.event.addDomListener(input, 'keydown', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        autocomplete = new google.maps.places.Autocomplete(input);
        console.log(autocomplete);
        autocomplete.addListener('place_changed', fillInAddress);
    }



    function fillInAddress() {

        if(!autocomplete.getPlace().formatted_address){
            console.log("locatie bestaat niet");
        }
        if(autocomplete.getPlace().formatted_address){
            var adress = autocomplete.getPlace().formatted_address;
            var jqxhr = $.get("https://maps.googleapis.com/maps/api/geocode/json?address="+adress+"&key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug" , function () {
                console.log("success");
            })
                .done(function (data) {
                    if (data) {
                        console.log(data.results[0].geometry.location);
                        var lat = data.results[0].geometry.location.lat;
                        var lng = data.results[0].geometry.location.lng;
                        init_map(lat,lng,cons_zoom_closup);
                    } else {
                        $("#searchTextField").css("background-color", "yellow");
                    }
                })
                .fail(function () {
                    $("#searchTextField").css("background-color", "yellow");
                });
        }
    }


    function init_map(lat,lng,zoom) {
        var myLatLng = new google.maps.LatLng(lat, lng);

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoom,
            center: myLatLng
        });


    }

    google.maps.event.addDomListener(window, 'load', initMap);

});