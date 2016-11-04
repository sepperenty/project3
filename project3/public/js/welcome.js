$(function () {
    var map;
    var cons_zoom_closup = 15;
    var cons_zoom = 9;
    var dropdown_selected = "";
    var myLatLng = {lat: 51.2194475, lng: 4.4024643};

    var iconBase = window.location.host;
    var icons = {
        company: {
            icon: '/images/google_maps_pin/bedrijf.png'
        },
        priority: {
            icon:  '/images/google_maps_pin/gebruiker-dringend.png'
        },
        individual: {
            icon: '/images/google_maps_pin/gebruiker-gewoon.png'
        },
        company_priority: {
            icon: '/images/google_maps_pin/bedrijf-dringend.png'
        }
    };

    console.log(icons["company"].icon);
    function initMap() {


        console.log($(".adress_fill").val());


        // if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(function (position) {
        //         var pos = {
        //             lat: position.coords.latitude,
        //             lng: position.coords.longitude
        //         };
        //
        //         init_map(pos.lat, pos.lng, cons_zoom_closup);
        //     }, function () {
        //         //handleLocationError(true, infoWindow, map.getCenter());
        //     });
        // } else {
        // Browser doesn't support Geolocation
        init_map(myLatLng.lat, myLatLng.lng, cons_zoom);
        // }


        if ($("#inhoud").length) {
            $("#inhoud").height(function () {

                $(".google-maps").height(function () {

                    if( $(window).width() < "992"){
                        return "400";
                    }else{
                        return $("#inhoud").height();
                    }

                });

                $(window).resize(function () {

                    if( $(window).width() < "992"){
                        $(".google-maps").height(400);
                    }else{
                        $(".google-maps").height($("#inhoud").height());
                    }

                })
            })
        } else {
            if($(window).width() < "992"){
                $(".google-maps").height(400);
                $("#map").height(400).css("left", "0");
            }else{
                $(".google-maps").height(650);
                $("#map").height(650).css("left", "0");
            }

        }


        // map = new google.maps.Map(document.getElementById('map'), {
        //     zoom: 12,
        //     center: myLatLng
        // });
        configur_google_map();

        $(function () {
            $(".dropdown-menu li a").click(function () {
                $(".dropdown-toggle").text($(this).text());
                $(".dropdown-toggle").val($(this).text());
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
            var type_icon ="individual";
            if(data[i].isPriority && data[i].isCompany ){
                type_icon ="company_priority";
            }else if(data[i].isPriority){
                type_icon ="priority";
            }else if(data[i].isCompany){
                type_icon ="company";
            }else {
                type_icon ="individual";
            }

            var marker, i;
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(data[i].lat, data[i].lng),
                icon: icons[type_icon].icon,
                map: map
            });
            //console.log("-----------------",data);
            google.maps.event.addListener(marker, 'click', (function (marker, i) {

                var urlproject = '/projects/' + data[i].id + '/show';
                //console.log(urlproject);

                var contentString = '' +
                    '<div class="content_google-map"> ' +
                        '<div class="post-thumb col-md-4" >' +
                            '<img src="/images/small/' + data[i].foto + '">' +
                        '</div>' +
                        '<div class="siteNotice col-md-8" >' +

                            '<h1>' + data[i].title + '</h1>' +
                            '<div id="bodyContent">' +
                                '<p>' + data[i].description.substring(1, 100) + '...' + '</p>' + '<div><a href="' + urlproject + '">meer lezen over dit project</a><div>' +
                            '</div>'
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

        if (serach_category) {
            var search_category_term;
            switch (serach_category) {
                case "Noodoproep":
                    search_category_term = "priority";
                    break;
                case "Person":
                    search_category_term = "individual"
                    break;
                case "Bedrijven":
                    search_category_term = "company"
                    break;
                default:
                    search_category_term = "";
            }
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
                            configur_google_map(search_category_term)

                        } else {
                            $("#searchTextField").css("background-color", "yellow");
                        }
                    })
                    .fail(function () {
                        $("#searchTextField").css("background-color", "yellow");
                    });
            }
        } else {
            init_map(myLatLng.lat, myLatLng.lng, cons_zoom);
            configur_google_map(search_category_term)
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

        google.maps.event.addListenerOnce(map, 'idle', function () {
            $('#map').find('a').each(function () {
                $(this).attr('tabindex', "-1");
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap);
});