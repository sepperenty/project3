$(function () {
    var map;
    var cons_zoom_closup = 12;
    var dropdown_selected = "";

    function initMap() {
        var myLatLng = {lat: 51.2194475, lng: 4.4024643};


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                init_map(pos.lat, pos.lng, cons_zoom_closup);
            }, function () {
                //handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            init_map(myLatLng.lat, myLatLng.lng, cons_zoom_closup);
        }





        // map = new google.maps.Map(document.getElementById('map'), {
        //     zoom: 12,
        //     center: myLatLng
        // });
        configur_google_map();

        $(function () {
            $(".dropdown-menu li a").click(function () {
                $(".btn:first-child").text($(this).text());
                $(".btn:first-child").val($(this).text());
                dropdown_selected = $(this).text();
                console.log(dropdown_selected);
            });
        });

        $("#search_button").click(function () {
            fillInAddress(dropdown_selected);
        })
    }


    function configur_google_map(search_option) {
        var search_input_string = "";
        if (search_option) {
            search_input_string = "/filter/" + search_option;
        }
        var jqxhr = $.get("/api/projects" + search_input_string, function () {
                console.log("success");
            })
            .done(function (data) {
                console.log('second succes', data);
                if (data) {
                    console.log(data);
                    initialize_markers(data)
                    initialize();
                } else {
                    alert("data base gegevens zijn leeg");
                }
            })
            .fail(function () {
                console.log("error")
            });
    }

    function initialize_markers(data) {
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

                var contentString = '' +
                    '<div class="content"> ' +
                        '<div class="post-thumb">'+
                            '<img src="/images/small/' + data[i].foto + '.jpg" ' +
                        '</div>'+
                        '<div class="siteNotice">' +

                        '<h1 id="firstHeading" class="firstHeading">' + data[i].title + '</h1>' +
                        '<div id="bodyContent">' +
                        '<p>' + data[i].description + '</p>' + '<div><a href="' + urlproject + '">meer lezen over dit project</a><div>' +
                        '</div>' +
                    '</div>';

                return function () {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }

            })(marker, i));
        }
    }

    var placeSearch, autocomplete, input;

    function initialize() {
        $(".info_location").fadeOut("fast");
        input = document.getElementById('searchTextField');

        google.maps.event.addDomListener(input, 'keydown', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        autocomplete = new google.maps.places.Autocomplete(input);
        console.log(autocomplete);
        //autocomplete.addListener('place_changed', fillInAddress);
    }


    function fillInAddress(serach_category) {

        if (autocomplete) {
            console.log("auto compitted bestaat");
            console.log(autocomplete);
        }
        if ($("#searchTextField").val()) {
            console.log($("#searchTextField").val());
            if (autocomplete.getPlace().formatted_address) {
                var adress = autocomplete.getPlace().formatted_address;
                var jqxhr = $.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + adress + "&key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug", function () {
                        console.log("success");
                    })
                    .done(function (data) {
                        if (data) {
                            console.log(data.results[0].geometry.location);
                            var lat = data.results[0].geometry.location.lat;
                            var lng = data.results[0].geometry.location.lng;
                            init_map(lat, lng, cons_zoom_closup);

                            if (serach_category) {
                                var search_category_term;
                                switch (serach_category) {
                                    case "Noodoproep":
                                        search_category_term = "priority";
                                        break;
                                    case "Gewoon oproep":
                                        search_category_term = "individual"
                                        break;
                                    case "Bedrijven":
                                        search_category_term = "company"
                                        break;
                                    default:
                                        search_category_term = "";
                                }
                                configur_google_map(search_category_term)
                            }
                        } else {
                            $("#searchTextField").css("background-color", "yellow");
                        }
                    })
                    .fail(function () {
                        $("#searchTextField").css("background-color", "yellow");
                    });
            }
        }
    }

    $(".reviuw").html("div><ul></ul></div>")

    function init_map(lat, lng, zoom) {
        var myLatLng = new google.maps.LatLng(lat, lng);

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoom,
            center: myLatLng,
            disableDefaultUI: true,
            zoomControl: true,
            scaleControl: true
        });

        google.maps.event.addListenerOnce(map, 'idle', function(){
        $('#map').find('a').each(function () {

            $(this).attr('tabindex', "-1");
            console.log('a');
        });


    });


    }

    google.maps.event.addDomListener(window, 'load', initMap);



    

});