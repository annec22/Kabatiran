<div id="map_canvas" style="position: absolute;"></div>
<script>
    $(document).ready(function() {
        $('#optionProvince').on('change', function(e) {
            var valueSelected = this.value;
            var type = valueSelected;
            var cityHolder = $('#cityHolder').val();
            document.getElementById("prov").value = type;
            $.ajax({
                url: "<?php echo base_url() . 'getContents'; ?>",
                type: 'POST',
                data: {'prov': valueSelected},
                dataType: 'JSON',
                success: function(data) {
                    $('#optionCity').empty();
                    var splitter = data.split("|");
                    var ctr = 0;
                    do {
                        $('#optionCity').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                        ctr++;
                    } while (ctr < splitter.length - 1)
                    $('#optionCity').val(cityHolder);
                    $('#optionCity').trigger('change');
                },
                error: function() {
                    alert("fail Prov");
                }
            });
        });


        $('#optionCity').on('change', function(e) {
            var cityValue = this.value;
            var brgyHolder = $('#brgyHolder').val();
            document.getElementById("muniCity").value = cityValue;
            $.ajax({
                url: "<?php echo base_url() . 'getMapBrgy'; ?>",
                type: 'POST',
                data: {'muni': cityValue},
                dataType: 'JSON',
                success: function(data) {
                    $('#optionBrgy').empty();
                    var splitter = data.split("|");
                    var ctr = 0;

                    $('#optionBrgy').append('<option selected ="selected">-Select Barangay-</option>');
                    do {
                        $('#optionBrgy').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                        ctr++;
                    } while (ctr < splitter.length - 1)
                    $('#optionBrgy').val(brgyHolder);
                    $('#optionBrgy').trigger('change');
                },
                error: function() {
                    alert("fail City");
                }
            });
        });


        $('#optionBrgy').on('change', function(e) {
            $('#brgy').val(this.value);
        });

        $('#provSelect').on('change', function(e) {
            var valueSelected = this.value;
            $('#provEdit').val(this.value);
            $('#brgySelect').empty();
            $('#brgyEdit').empty();
            $.ajax({
                url: "<?php echo base_url() . 'getContents'; ?>",
                type: 'POST',
                data: {'prov': valueSelected},
                dataType: 'JSON',
                success: function(data) {
                    $('#cmSelect').empty();
                    var splitter = data.split("|");
                    var ctr = 0;
                    do {
                        $('#cmSelect').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                        ctr++;
                    } while (ctr < splitter.length - 1)
                },
                error: function() {
                    alert("fail prov slect");
                }
            });
        });

        $('#cmSelect').on('change', function(e) {
            var cityValue = this.value;
            $('#cmEdit').val(this.value);
            $.ajax({
                url: "<?php echo base_url() . 'getMapBrgy'; ?>",
                type: 'POST',
                data: {'muni': cityValue},
                dataType: 'JSON',
                success: function(data) {
                    $('#brgySelect').empty();
                    var splitter = data.split("|");
                    var ctr = 0;
                    do {
                        $('#brgySelect').append('<option>' + splitter[ctr] + '</option>');
                        ctr++;
                    } while (ctr < splitter.length - 1)
                },
                error: function() {
                    alert("fail cm select");
                }
            });
        });

        $('#brgySelect').on('change', function(e) {
            $('#brgyEdit').val(this.value);
        });

    });

    var minzoom = 10;
    var markersArray = new Array();
    var oldMarkers = new Array();
    var info = null;
//    var strictBounds = new google.maps.LatLngBounds(
//            new google.maps.LatLng(16.23709060923828, 120.51727294921875),
//            new google.maps.LatLng(16.904427878255003, 120.89630126953125)
//            );
    var map_canvas = document.getElementById('map_canvas');//specify which element to print on
    var map_options = {
        center: new google.maps.LatLng(16.4089802, 120.59931329999995), //default start location
        zoom: 16, //zoom level 0-22
        mapTypeId: google.maps.MapTypeId.ROADMAP //type of map (ROADMAP, HYBRID, SATELLITE?)
    };//default options for the map
    var Googlemap = new google.maps.Map(map_canvas, map_options);
    google.maps.event.trigger(Googlemap, 'resize');
    google.maps.event.addListener(Googlemap, 'click', function(event) {

        placeMarker(event.latLng);
        document.getElementById("longitude").value = event.latLng.lng();
        document.getElementById("latitude").value = event.latLng.lat();


        info = (event.latLng.lat() + " " + event.latLng.lng());
    });
    var infowindow = new google.maps.InfoWindow();
    var content = '<div><button onclick="del(); ">Delete</button>&nbsp;<button onclick="edit(); ">Edit</button></div>';
    infowindow.setContent(content);
    var marker = null;
    function infoCallback(infowindow, marker) {
        return function() {

            infowindow.open(Googlemap, marker);
            document.getElementById("delLoc").value = marker.id;
            document.getElementById("delEvent").value = marker.myevent;
            document.getElementById("delMuniCity").value = marker.mymunicity;
            document.getElementById('lat').value = marker.position.lat();
            document.getElementById('long').value = marker.position.lng();
            document.getElementById('tempMarkerID2').value = marker.myid;
            document.getElementById('titleEdit').value = marker.mytitle;
            document.getElementById('cmEdit').value = marker.mycity;
            document.getElementById('brgyEdit').value = marker.mystreet;
            if(marker.mytime.split(":")[0] > 12){
//                document.getElementById('hrEdit').value = marker.mytime.split(":")[0] - 12;
                $('#hrEdit').val(marker.mytime.split(":")[0] - 12);
                $('#timeOfDayEdit').val('PM');
            }else{
//                document.getElementById('hrEdit').value = marker.mytime.split(":")[0];
                $('#hrEdit').val(marker.mytime.split(":")[0]);
                $('#timeOfDayEdit').val('AM');
            }
            
            document.getElementById('minEdit').value = marker.mytime.split(":")[1];
            document.getElementById('dateEdit').value = marker.mydate;
            document.getElementById('descriptionEdit').value = marker.mydesc;
            document.getElementById('tempEdit').value = marker.mycategory;
            document.getElementById('typeEdit').selectedIndex = marker.mycatid - 1;

            document.getElementById('loc').value = marker.myid;
            document.getElementById('event').value = marker.myevent;
        };
    }
    ;
    function del() {
        $(document).ready(function() {
            $("#popupDelete").bPopup({
                escClose: true
            });
        });
    }
    function edit() {
        $(document).ready(function() {
            $("#popupEdit").bPopup({
                escClose: true
            });
        });
        $.ajax({
            url: '<?php echo base_url() . "getEditContents"; ?>',
            type: 'POST',
            data: {'city': $('#cmEdit').val()},
            dataType: 'JSON',
            success: function(data) {
                $('#provSelect').val(data);
                document.getElementById('provEdit').value = data;
                $.ajax({
                    url: "<?php echo base_url() . 'getContents'; ?>",
                    type: 'POST',
                    data: {'prov': $('#provEdit').val()},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#cmSelect').empty();
                        var splitter = data.split("|");
                        var ctr = 0;
                        do {
                            $('#cmSelect').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                            ctr++;
                        } while (ctr < splitter.length - 1)
                        $('#cmSelect').val($('#cmEdit').val());
                        $.ajax({
                            url: "<?php echo base_url() . 'getMapBrgy'; ?>",
                            type: 'POST',
                            data: {'muni': $('#cmEdit').val()},
                            dataType: 'JSON',
                            success: function(data) {
                                $('#brgySelect').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('#brgySelect').append('<option>' + splitter[ctr] + '</option>');
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                                $('#brgySelect').val($('#brgyEdit').val());
                            },
                            error: function() {
                                alert("fail1");
                            }
                        });

                    },
                    error: function() {
                        alert("fail2");
                    }
                });
            },
            error: function() {
                alert("fail3");
            }
        });
    }
<?php
if ($location != null) {
    foreach ($location as $lolo) {
        if ($lolo->x != null && $lolo->y != null) {
            ?>

                var lolo = new google.maps.LatLng(<?php echo $lolo->x; ?>, <?php echo $lolo->y; ?>);

                marker = new google.maps.Marker({
                    position: (lolo),
                    icon: "<?php echo base_url() . 'images/'; ?><?php echo $lolo->classification; ?>.png",
                    map: Googlemap,
                    id: <?php echo $lolo->locationID ?>,
                    draggable: true

                });
                google.maps.event.addListener(
                        marker,
                        'click',
                        infoCallback(infowindow, marker)
                        );
                marker.mycategory = '<?php echo $lolo->classification; ?>';
                marker.myid = '<?php echo $lolo->locationID; ?>';
                marker.mytitle = '<?php echo $lolo->incidentname; ?>';
                marker.mycity = '<?php echo $lolo->name; ?>';
                marker.mystreet = '<?php echo $lolo->barangay; ?>';
                marker.mydate = '<?php echo date_format(date_create($lolo->incidentDate), "M. j, Y"); ?>';
                marker.mydesc = '<?php echo $lolo->description; ?>';
                marker.mytime = '<?php echo $lolo->incidentTime; ?>';
                marker.mycatid = '<?php echo $lolo->typeID; ?>';
                marker.myevent = '<?php echo $lolo->eventID; ?>';
                marker.mymunicity = '<?php echo $lolo->muniCityID; ?>';
                oldMarkers.push(marker);
                dragMarker(marker);


        <?php } ?>
    <?php } ?>
<?php } ?>

    function dragMarker(marker) {
        google.maps.event.addListener(
                marker,
                'dragend',
                function() {
                    document.getElementById('lat').value = marker.position.lat();
                    document.getElementById('long').value = marker.position.lng();
                    document.getElementById('tempMarkerID2').value = marker.myid;
                    $(document).ready(function() {
                        $("#popupEdit").bPopup({
                            escClose: true
                        });
                    });
                    document.getElementById('titleEdit').value = marker.mytitle;
                    document.getElementById('cmEdit').value = marker.mycity;
                    document.getElementById('brgyEdit').value = marker.mystreet;
                    document.getElementById('hrEdit').value = marker.mytime.split(":")[0];
                    document.getElementById('minEdit').value = marker.mytime.split(":")[1];
                    document.getElementById('dateEdit').value = marker.mydate;
                    document.getElementById('descriptionEdit').value = marker.mydesc;
                    document.getElementById('tempEdit').value = marker.mycategory;
                    document.getElementById('typeEdit').selectedIndex = marker.mycatid - 1;

                    document.getElementById('loc').value = marker.myid;
                    document.getElementById('event').value = marker.myevent;

                    $.ajax({
                        url: '<?php echo base_url() . "getEditContents"; ?>',
                        type: 'POST',
                        data: {'city': marker.mycity},
                        dataType: 'JSON',
                        success: function(data) {
                            $('#provSelect').val(data);
                            document.getElementById('provEdit').value = data;
                            $.ajax({
                                url: "<?php echo base_url() . 'getContents'; ?>",
                                type: 'POST',
                                data: {'prov': $('#provEdit').val()},
                                dataType: 'JSON',
                                success: function(data) {
                                    $('#cmSelect').empty();
                                    var splitter = data.split("|");
                                    var ctr = 0;
                                    do {
                                        $('#cmSelect').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                                        ctr++;
                                    } while (ctr < splitter.length - 1)
                                    $('#cmSelect').val(marker.mycity);
                                    $.ajax({
                                        url: "<?php echo base_url() . 'getMapBrgy'; ?>",
                                        type: 'POST',
                                        data: {'muni': marker.mycity},
                                        dataType: 'JSON',
                                        success: function(data) {
                                            $('#brgySelect').empty();
                                            var splitter = data.split("|");
                                            var ctr = 0;
                                            do {
                                                $('#brgySelect').append('<option>' + splitter[ctr] + '</option>');
                                                ctr++;
                                            } while (ctr < splitter.length - 1)
                                            $('#brgySelect').val(marker.mystreet);
                                        },
                                        error: function() {
                                            alert("fail");
                                        }
                                    });

                                },
                                error: function() {
                                    alert("fail");
                                }
                            });
                        },
                        error: function() {
                            alert("fail");
                        }
                    });
                }
        );

    }
    function goToMarker(location){
        Googlemap.panTo(location);
    }
    function placeMarker(location) {
        Googlemap.panTo(location);
        $(document).ready(function() {
            $("#popup").bPopup({
                escClose: true
            });
        });
        marker = new google.maps.Marker({
            position: (location),
            icon: "<?php echo base_url() . 'images/temp markers/'; ?>" + document.getElementById("temp").value + ".png",
            map: Googlemap,
            draggable: true
        });

        markersArray.push(marker);
        if (markersArray.length > 1) {
            markersArray[0].setMap(null);
            markersArray.splice(0, 1);
        }
        infowindow = new google.maps.InfoWindow({
            content: location.lat() + ''
        });

        google.maps.event.addListener(
                marker,
                'click',
                infoCallback(infowindow, marker)
                );
        infowindow.close();
        google.maps.event.addListener(
                marker,
                'dragend',
                function() {

                    document.getElementById('latitude').value = marker.position.lat();
                    document.getElementById('longitude').value = marker.position.lng();


                    $(document).ready(function() {
                        $("#popup").bPopup({
                            escClose: true

                        });
                    });


                }

        );

    }

//    google.maps.event.addListener(Googlemap, 'bounds_changed', function() {
//        if (strictBounds.contains(Googlemap.getCenter()))
//            return;
//        var c = Googlemap.getCenter(),
//                x = c.lng(),
//                y = c.lat(),
//                maxX = strictBounds.getNorthEast().lng(),
//                maxY = strictBounds.getNorthEast().lat(),
//                minX = strictBounds.getSouthWest().lng(),
//                minY = strictBounds.getSouthWest().lat();
//        if (x < minX)
//            x = minX;
//        if (x > maxX)
//            x = maxX;
//        if (y < minY)
//            y = minY;
//        if (y > maxY)
//            y = maxY;
//
//        Googlemap.setCenter(new google.maps.LatLng(y, x));
//    });

    function getType(incident) {
        var type = incident.options[incident.selectedIndex].value;
        document.getElementById("temp").value = type;
        var temp = document.getElementById("temp").value;
        marker.setIcon("<?php echo base_url() ?>" + "images/temp markers/" + temp + ".png");
    }

    function getTypeEdit(incident) {
        var type = incident.options[incident.selectedIndex].value;
        document.getElementById("tempEdit").value = type;
        var temp = document.getElementById("tempEdit").value;
        marker.setIcon("<?php echo base_url() ?>" + "images/temp markers/" + temp + ".png");
    }

    function getProv(prov) {
        var type = prov.options[prov.selectedIndex].value;
        document.getElementById("prov").value = type;

    }
    google.maps.event.addListener(Googlemap, 'zoom_changed', function() {
        if (Googlemap.getZoom() < minzoom)
            Googlemap.setZoom(minzoom);
    });

    $(function() {

        $("#date").datepicker().datepicker("setDate", new Date()).attr('readonly', 'readonly');
        $("#dateEdit").datepicker().attr('readonly', 'readonly');
    });

</script>
<?php include ('adminMap_view.php'); ?>
<?php include ('adminMap_endScript.php'); ?>