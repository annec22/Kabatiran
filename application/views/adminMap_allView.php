<div id="map_canvas"></div>

<script>
    var minzoom = 12;
    var markersArray = new Array();
    var oldMarkers = new Array();
    var info = null;
    var strictBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(16.23709060923828, 120.51727294921875),
            new google.maps.LatLng(16.904427878255003, 120.89630126953125)
            );
    var map_canvas = document.getElementById('map_canvas');//specify which element to print on
    var map_options = {
        center: new google.maps.LatLng(16.4089802, 120.59931329999995), //default start location
        zoom: 16, //zoom level 0-22
        mapTypeId: google.maps.MapTypeId.ROADMAP //type of map (ROADMAP, HYBRID, SATELLITE?)
    }//default options for the map
    var map = new google.maps.Map(map_canvas, map_options);
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
        document.getElementById("longitude").value = event.latLng.lng();
        document.getElementById("latitude").value = event.latLng.lat();
        info = (event.latLng.lat() + " " + event.latLng.lng());
    });
    var infowindow = new google.maps.InfoWindow();
    var content = '<div><button onclick="del()">Delete</button><button>Update</button></div>';
    infowindow.setContent(content);
    var marker = null;
    function infoCallback(infowindow, marker) {
        return function() {

            infowindow.open(map, marker);
            document.getElementById("delLoc").value = marker.id;
            document.getElementById("delEvent").value = marker.myevent;
            document.getElementById("delMuniCity").value = marker.mymunicity;

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
<?php
if ($location != null) {
    foreach ($location as $lolo) {
        ?>

            var lolo = new google.maps.LatLng(<?php echo $lolo->x; ?>, <?php echo $lolo->y; ?>, true);
            marker = new google.maps.Marker({
                position: (lolo),
                icon: "<?php echo base_url() . 'images/'; ?><?php echo $lolo->classification; ?>.png",
                map: map,
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
            marker.mystreet = '<?php echo $lolo->street; ?>';
            marker.mydate = '<?php echo $lolo->incidentDate; ?>';
            marker.mydesc = '<?php echo $lolo->description; ?>';
            marker.mytime = '<?php echo $lolo->incidentTime; ?>';
            marker.mycatid = '<?php echo $lolo->typeID; ?>';
            marker.myevent = '<?php echo $lolo->eventID; ?>';
            marker.mymunicity = '<?php echo $lolo->muniCityID; ?>';
            oldMarkers.push(marker);
            dragMarker(marker);


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
                    document.getElementById('provEdit').value = 'Benguet';
                    document.getElementById('loc').value = marker.myid;
                    document.getElementById('event').value = marker.myevent;
                }
        );

    }

    function placeMarker(location) {
        $(document).ready(function() {
            $("#popup").bPopup({
                escClose: true
            });
        });
        marker = new google.maps.Marker({
            position: (location),
            map: map,
            icon: "<?php echo base_url() . 'images/'; ?>" + document.getElementById("temp").value + ".png",
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
    google.maps.event.addListener(map, 'bounds_changed', function() {
        if (strictBounds.contains(map.getCenter()))
            return;

        var c = map.getCenter(),
                x = c.lng(),
                y = c.lat(),
                maxX = strictBounds.getNorthEast().lng(),
                maxY = strictBounds.getNorthEast().lat(),
                minX = strictBounds.getSouthWest().lng(),
                minY = strictBounds.getSouthWest().lat();
        if (x < minX)
            x = minX;
        if (x > maxX)
            x = maxX;
        if (y < minY)
            y = minY;
        if (y > maxY)
            y = maxY;

        map.setCenter(new google.maps.LatLng(y, x));
    });

    function getType(incident) {
        var type = incident.options[incident.selectedIndex].value;
        document.getElementById("temp").value = type;
        var temp = document.getElementById("temp").value;
        marker.setIcon("<?php echo base_url() ?>" + "images/" + temp + ".png");
    }
    function getTypeEdit(incident) {
        var type = incident.options[incident.selectedIndex].value;
        document.getElementById("tempEdit").value = type;
        var temp = document.getElementById("tempEdit").value;
        marker.setIcon("<?php echo base_url() ?>" + "images/" + temp + ".png");
    }

    function getProv(prov) {
        var type = prov.options[prov.selectedIndex].value;
        document.getElementById("prov").value = type;

    }
    google.maps.event.addListener(map, 'zoom_changed', function() {
        if (map.getZoom() < minzoom)
            map.setZoom(minzoom);
    });
</script>
<ul id="filterList">
    <li>Earthquake <img src="<?php echo base_url() . 'images/Earthquake.png' ?>"/><input type="checkbox" id="Earthquake" onclick="boxclick(this, 'Earthquake');" checked/>&nbsp;&nbsp;</li>
    <li>Landslide <img src="<?php echo base_url() . 'images/Landslide.png' ?>"/><input type="checkbox" id="Landslide" onclick="boxclick(this, 'Landslide');" checked/>&nbsp;&nbsp;</li>
    <li>Fire <img src="<?php echo base_url() . 'images/Fire.png' ?>"/><input type="checkbox" id="Fire" onclick="boxclick(this, 'Fire');" checked/>&nbsp;&nbsp;</li>
    <li>Insurgence <img src="<?php echo base_url() . 'images/Insurgence.png' ?>"/><input type="checkbox" id="Insurgence" onclick="boxclick(this, 'Insurgence');" checked/>&nbsp;&nbsp;</li>
    <li>Vehicular Accident <img src="<?php echo base_url() . 'images/Vehicular Accident.png' ?>"/><input type="checkbox" id="Vehicular Accident" onclick="boxclick(this, 'Vehicular Accident');" checked/>&nbsp;&nbsp;</li>
    <li>Rock Fall <img src="<?php echo base_url() . 'images/Rock Fall.png' ?>"/><input type="checkbox" id="Rock Fall" onclick="boxclick(this, 'Rock Fall');" checked/></li>
    <li>Road Block <img src="<?php echo base_url() . 'images/Road Block.png' ?>"/><input type="checkbox" id="Road Block" onclick="boxclick(this, 'Road Block');" checked/></li>
    <li>Drowning Incident <img src="<?php echo base_url() . 'images/Drowning Incident.png' ?>"/><input type="checkbox" id="Drowning Incident" onclick="boxclick(this, 'Drowning Incident');" checked/></li>
</ul>
<ul id="category">
    <li>Earthquake <img src="<?php echo base_url() . 'images/logo/Earthquake.png' ?>" onclick="imageClick('Earthquake', '1');"/>&nbsp;&nbsp;</li>
    <li>Landslide <img src="<?php echo base_url() . 'images/logo/Landslide.png' ?>" onclick="imageClick('Landslide', '2');"/>&nbsp;&nbsp;</li>
    <li>Fire <img src="<?php echo base_url() . 'images/logo/Fire.png' ?>" onclick="imageClick('Fire', '3');"/>&nbsp;&nbsp;</li>
    <li>Insurgence <img src="<?php echo base_url() . 'images/logo/Insurgency.png' ?>" onclick="imageClick('Insurgence', '4');"/>&nbsp;&nbsp;</li>
    <li>Vehicular Accident <img src="<?php echo base_url() . 'images/logo/car.png' ?>" onclick="imageClick('Vehicular Accident', '5');"/>&nbsp;&nbsp;</li>
    <li>Rock Fall <img src="<?php echo base_url() . 'images/logo/Rockfall.png' ?>" onclick="imageClick('Rockfall', '6');"/></li>
    <li>Road Block <img src="<?php echo base_url() . 'images/logo/Road Block.png' ?>" onclick="imageClick('Road Block', '7');"/></li>
    <li>Drowning Incident <img src="<?php echo base_url() . 'images/logo/Drowning Incident.png' ?>" onclick="imageClick('Drowning Incident', '8');"/></li>
</ul>

<div id="popup">
    <input type="text" id="tempMarkerID" name="tempMarkerID" hidden/>
    <form action="<?php echo base_url() . 'index.php/onlineMap/addLocation'; ?>" method="GET">
        <p>Title: <input type="text" id="title" name="title"/>
            Location: <select onchange="getProv(this)">
                <?php
                if ($province != null) {
                    foreach ($province as $prov) {
                        ?>
                        <option><?php echo $prov->name; ?></option>
                    <?php } ?>
                <?php } ?>
            </select></p>
        <p>City/Municipality:<input type="text" id="cm" name="cm"/>
            Barangay:<input type="text" id="brgy" name="brgy"/></p>
        <p><input type="text" id="longitude" name="longitude" hidden/>
            <input type="text" id="latitude" name="latitude" hidden/>
        </p>
        <p>Time: <input type="text" class="time" name="hr"/>:<input type="text" class="time" name="min"/>
            Date: <input type="date" id="date" name="date"/>
            Type: <select id="type" onchange="getType(this)">
                <option value="Earthquake">Earthquake</option>
                <option value="Landslide">Landslide</option>
                <option value="Fire">Fire</option>
                <option value="Insurgence">Insurgence</option>
                <option value="Vehicular Accident">Vehicular Accident</option>
                <option value="Rock Fall">Rock Fall</option>
                <option value="Drowning Incident">Drowning Incident</option>
                <option value="Road Block">Road Block</option>
            </select></p>
        <p>Description:</p><p><textarea id="description" rows="6" cols="27" name="description" placeholder="Enter description..."></textarea></p>                
        <p>Notification: <input type="checkbox" id="notification" name="notification"/>&nbsp;&nbsp;&nbsp; Active: <input type="checkbox" id="alert" name="alert"/>
            &nbsp;&nbsp;&nbsp;Publish on: <input type="checkbox" id="facebook" name="facebook" checked/> Facebook <input type="checkbox" id="twitter" name="twitter" checked/> Twitter</p>
        <input type="text" id="temp" name="temp" value="Earthquake" hidden/>
        <input type="text" id="prov" name="prov" value="Benguet" hidden/>
        <button>Submit</button>
    </form>
</div>
<div id="popupEdit">

    <form action="<?php echo base_url() . 'index.php/onlineMap/editMarker'; ?>" method="GET">
        <input type="text" id="tempMarkerID2" name="tempMarkerID" hidden/>
        <input type="text" name="action" value="1" hidden/>
        <p>Title: <input type="text" id="titleEdit" name="title"/>
            Location: <select onchange="getProv(this)">
                <?php
                if ($province != null) {
                    foreach ($province as $prov) {
                        ?>
                        <option><?php echo $prov->name; ?></option>
                    <?php } ?>
                <?php } ?>
            </select></p>
        <p>City/Municipality:<input type="text" id="cmEdit" name="cm"/>
            Barangay:<input type="text" id="brgyEdit" name="brgy"/></p>
        <p><input type="text" id="long" name="longitude" hidden/>
            <input type="text" id="lat" name="latitude" hidden/></p>
        <p>Time: <input type="text" id="hrEdit" name="hr"/>:<input type="text" id="minEdit" name="min"/>
            Date: <input type="date" id="dateEdit" name="date"/>
            Type: <select id="typeEdit" onchange="getTypeEdit(this)">
                <option value="Earthquake">Earthquake</option>
                <option value="Landslide">Landslide</option>
                <option value="Fire">Fire</option>
                <option value="Insurgence">Insurgence</option>
                <option value="Vehicular Accident">Vehicular Accident</option>
                <option value="Rock Fall">Rock Fall</option>
                <option value="Drowning Incident">Drowning Incident</option>
                <option value="Road Block">Road Block</option>
            </select></p>
        <p>Description:</p><p><textarea id="descriptionEdit" rows="6" cols="27" name="description" placeholder="Enter description..."></textarea></p>                
        <p>Notification: <input type="checkbox" id="notification" name="notification"/>&nbsp;&nbsp;&nbsp; Active: <input type="checkbox" id="alert" name="alert"/>
            &nbsp;&nbsp;&nbsp;Publish on: <input type="checkbox" id="facebook" name="facebook" checked/> Facebook <input type="checkbox" id="twitter" name="twitter" checked/> Twitter</p>
        <input type="text" id="tempEdit" name="temp" value="Earthquake" hidden/>
        <input type="text" id="provEdit" name="prov" value="Benguet" hidden/>
        <input type="text" id="event" name="event" hidden/>
        <input type="text" id="loc" name="loc" hidden/>
        <button>Submit</button>
    </form>
</div>

<div id="popupDelete">
    <form action="<?php echo base_url() . 'index.php/onlineMap/delMarker'; ?>" method="GET">
        <input type="text" id="delMuniCity" name="muniCity"  />
        <input type="text" id="delEvent" name="event"  />
        <input type="text" id="delLoc" name="loc"  />
        <button>Delete</button>
    </form>
    <button onclick="closeDelete()">Cancel</button>
</div>

<script>
    function closeDelete() {
        $(document).ready(function() {
            $("#popupDelete").bPopup().close();
        });
    }
    function imageClick(value, index) {
        $(document).ready(function() {
            $("#temp").val(value);
            $("#type")[0].selectedIndex = index - 1;
        });
    }

    function show(category) {
        for (var i = 0; i < oldMarkers.length; i++) {
            if (oldMarkers[i].mycategory == category) {
                oldMarkers[i].setVisible(true);
            }
        }
        document.getElementById(category).checked = true;
        infowindow.close();
    }
    function hide(category) {
        for (var i = 0; i < oldMarkers.length; i++) {
            if (oldMarkers[i].mycategory == category) {
                oldMarkers[i].setVisible(false);
            }
        }
        document.getElementById(category).checked = false;
        infowindow.close();
    }
    function boxclick(box, category) {
        if (box.checked) {
            show(category);
        } else {
            hide(category);
        }
    }
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;

    var today = year + "-" + month + "-" + day;
    document.getElementById("date").value = today;
</script>