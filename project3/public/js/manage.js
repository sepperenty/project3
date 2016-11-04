$(document).ready(function () {
    console.log("manege page lets doe it!");


    var cons_lan = 51.2194475;
    var cons_lng  =4.4024643;
    var cons_zoom_closup = 15;
    var cons_zoom_uot = 10;
    var map;

//form validation

   //
   //
   // $('#form_project').validate({ // initialize the plugin
   //      rules: {
   //          title: {
   //              required: true,
   //              minlength: 1
   //          },
   //          description: {
   //              required: true,
   //              minlength: 1
   //          },
   //          category: {
   //              required: true,
   //          },goal: {
   //              required: true,
   //              minlength:1
   //          },address: {
   //              required: true,
   //          }
   //      }
   //  });








    //maps code


    var placeSearch, autocomplete,input;
    initialize();
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

                        $('input[name="lat"]').val(lat);
                        $('input[name="lng"]').val(lng);

                        //
                        init_map(lat,lng,cons_zoom_closup);
                        set_marker(lat, lng);
                    } else {
                        init_map(cons_lan,cons_lng,cons_zoom_uot);
                        $(".info_location").show();
                        set_marker(0, 0);
                    }
                })
                .fail(function () {
                    $('input[name="lat"]').val("");
                    $('input[name="lng"]').val("");
                    console.log("error");
                    $(".info_location").show();
                    //$(".info").fadeOut("fast").html("Er ging iets mis, probeer het later nog eens").removeClass("alert-info").addClass("alert-danger").fadeIn("fast");

                });
        }

    }

    init_map(cons_lan,cons_lng,cons_zoom_uot);
    //for antwerpen {lat: 51.2194475, lng: 4.4024643}
    function init_map(lat,lng,zoom) {
        var myLatLng = new google.maps.LatLng(lat, lng);

        map = new google.maps.Map(document.getElementById('map_form'), {
            zoom: zoom,
            center: myLatLng
        });
    }

    function set_marker(lat, lng) {
        console.log("set_marker",lat, lng)
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map
        });

    }

    /*
        Ontwijk de linken op google maps kaart met tab.
    */

    google.maps.event.addListenerOnce(map, 'idle', function(){
        console.log("map ingeladen");
        $('#map_form').find('a').each(function () {
            $(this).attr('tabindex', "-1");
        });


    });


   

    
})



