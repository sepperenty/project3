$(document).ready(function () {
    console.log("manege page lets doe it!");


    var cons_lan = 51.2194475;
    var cons_lng  =4.4024643;
    var cons_zoom_closup = 15;
    var cons_zoom_uot = 10;
    var map;

//form validation



   $('#form_project').validate({ // initialize the plugin
        rules: {
            title: {
                required: true,
                minlength: 1
            },
            description: {
                required: true,
                minlength: 1
            },
            category: {
                required: true,
            },goal: {
                required: true,
                minlength:1
            },address: {
                required: true,
            }
        }
    });





    //load project

    $(".project_list").click(function () {
        console.log("click on project", $(this).attr('data-project_id'));

        var project_id = $(this).attr('data-project_id');

        if (project_id != "new_project") {

             $(".id").val(project_id);
             $("#manageBtn").html("Update Project");


            var jqxhr = $.get("/api/projects/" + project_id, function () {
                console.log("success");
            })
                .done(function (data) {
                    if (data) {
                        show_message("info","Pas je zoekertje aan");

                        $('input[name="id"]').val(data.id);
                        $('input[name="title"]').val(data.title);
                        $('textarea[name="description"]').val(data.description);
                        $('input[name="category"]').val(data.category);
                        $('input[name="goal"]').val(data.goal);
                        $('input[name="address"]').val(data.address);
                        $('input[name="lat"]').val(data.lat);
                        $('input[name="lng"]').val(data.lng);

                        // $('.project_file').append("<img class='project_foto' src='/images/small/" + data.foto + ".jpg'>");
                        var picturePath = '/images/small/' + data.foto + ".jpg";
                        $('#currentPicture').attr('src', picturePath);
                        $('#currentPicture').show();
                        console.log('project api request succes', data);
                        init_map(data.lat, data.lng,cons_zoom_closup);
                        set_marker(data.lat, data.lng);
                    } else {
                        show_message_error("info","Er ging iets mis, probeer het later nog eens");
                        init_map(cons_lan,cons_lng,cons_zoom_uot);

                        $(".info").val("Pas je zoekertje aan");
                    }
                })
                .fail(function () {
                    console.log("error");
                    show_message_error("info","Er ging iets mis, probeer het later nog eens");
                    //$(".info").fadeOut("fast").html("Er ging iets mis, probeer het later nog eens").removeClass("alert-info").addClass("alert-danger").fadeIn("fast");

                });
        } else {
            $("#manageBtn").html("Create Project");
            console.log($('form').trigger("reset"));
            show_message("info","Vul de gegevens in om je zoekertje te plaatsen");
            if ($(".project_foto")) {
                $(".project_foto").remove();
            }
            init_map(cons_lan,cons_lng,cons_zoom_uot);

        }


    })


    function show_message_error(selector,text) {
        $("."+selector).hide().html(text).removeClass("alert-info").addClass("alert-danger").fadeIn("slow");
    }
    function show_message(selector,text) {
        $("."+selector).hide().html(text).fadeIn("slow");
    }




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
            console.log("a");
            $(this).attr('tabindex', "-1");
            console.log('a');
        });


    });


   

    
})



