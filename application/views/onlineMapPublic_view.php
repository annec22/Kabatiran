<html>
    <head>
        <title>public google map</title>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
        <script src="<?php echo base_url() . 'scripts/jquery-1.9.1.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.bpopup.min.js'; ?>"></script>
        <script>
            $(document).ready(function() {
                $('#optionProvince').on('change', function(e) {
                    var valueSelected = this.value;

                    $.ajax({
                        url: "<?php echo base_url() . 'getContents'; ?>",
                        type: 'POST',
                        data: {'prov': valueSelected},
                        dataType: 'JSON',
                        success: function(data) {
                            $('#optionCity').empty();
                            var splitter = data.split("|");
                            var ctr = 0;
                            $('#optionCity').append('<option>---Select City---</option>');
                            do {
                                $('#optionCity').append('<option value ="' + splitter[ctr] + '">' + splitter[ctr] + '</option>');
                                ctr++;
                            } while (ctr < splitter.length - 1)

                        },
                        error: function() {

                        }
                    });
                });
            });
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/map.css'; ?>"/>
    </head>
    <body>
<!--        <div id="search"><label>Search: <input type="text" id="searchbar" onkeyup="getCode(event)"/> <select id="searchtype" onchange="getIndex();">
                    <option value="1">Street/Baranagay</option>
                    <option value="2">City</option>
                    <option value="3">Incident Title</option>
                    <option value="4">Incident Type</option>
                    <option value="5">Incident Date</option>
                </select></label><input id="filterDate" type="date" hidden/><button id="searchbtn" onclick="filter()">Search</button></div>-->
        <ul id="searchOptions">
            <form action="<?php echo base_url() . 'searchLocation'; ?>" method="GET">
<!--                <label>Search: <input type="text" id="searchbar" onkeyup="getCode(event)" name="search"/></label>-->
                <a href="<?php echo base_url() . 'public_map'; ?>">home</a>
                <label id="eventListLabel" hidden>Recent Events <select id="eventList" onchange="getEvent(this);">
                        <option>---Select Event---</option>
                        <?php
                        if ($events != null) {
                            foreach ($events as $events) {
                                ?>
                                <option><?php echo $events->incidentname; ?></option>

                            <?php } ?>
                        <?php } ?>
                    </select></label>
                <input id="filterDate" type="date" name="incDate" hidden/>
                <select id="searchIncType" onchange="getType(this);" hidden>
                    <option>---Select Incident Type---</option>
                    <?php
                    if ($accident_type != null) {
                        foreach ($accident_type as $acc) {
                            ?>
                            <option><?php echo $acc->classification; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <select id="optionProvince" name="prov" hidden>
                    <option>---Select Province---</option>
                    <?php
                    if ($provinces != null) {
                        foreach ($provinces as $prov) {
                            ?>
                            <option><?php echo $prov->province; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <select id="optionCity" name="city" hidden>
                </select>
                <label><li>Province and City<input type="radio" id="street" name="option" value="1" onclick="openProvCity();"/>&nbsp;&nbsp;</li></label>
                <label><li>Province<input type="radio" id="city" name="option" value="2" onclick="openProv();"/>&nbsp;&nbsp;</li></label>
                <label><li>Incident Title<input type="radio" id="incidentTitle" name="option" value="3" onclick="openEvent();"/>&nbsp;&nbsp;</li></label>
                <label><li>Incident Type<input type="radio" id="incidentType" name="option" value="4" onclick="openType();"/>&nbsp;&nbsp;</li></label>
                <label><li>Incident Date<input type="radio" id="incidentDate" name="option" onclick="openDate();" value="5"/>&nbsp;&nbsp;</li></label>

                <input type="text" id="temp" name="incType" hidden/>
                <input type="text" id="tempEvent" name="eventTitle" hidden/>
                <button>Search</button>
            </form>
        </ul>
        <div id="map_canvas" style="width: 130%; height: 130%;"></div>
        <script>
            function openProvCity() {
                $('#optionProvince').show();
                $('#optionCity').show();
                $('#filterDate').hide();
                $('#searchIncType').hide();
                $('#eventListLabel').hide();
            }
            function openProv() {
                $('#optionProvince').show();
                $('#optionCity').hide();
                $('#filterDate').hide();
                $('#searchIncType').hide();
                $('#eventListLabel').hide();
            }
            function openDate() {
                $('#filterDate').show();
                $('#searchIncType').hide();
                $('#eventListLabel').hide();
                $('#optionProvince').hide();
                $('#optionCity').hide();
            }
            function openType() {
                $('#filterDate').hide();
                $('#eventListLabel').hide();
                $('#searchIncType').show();
                $('#optionProvince').hide();
                $('#optionCity').hide();
            }
            function openEvent() {
                $('#filterDate').hide();
                $('#searchIncType').hide();
                $('#eventListLabel').show();
                $('#optionProvince').hide();
                $('#optionCity').hide();
            }
            function getType(incident) {
                var type = incident.options[incident.selectedIndex].value;
                document.getElementById("temp").value = type;
            }
            function getEvent(event) {
                var type = event.options[event.selectedIndex].value;
                document.getElementById("tempEvent").value = type;
            }
            var date = new Date();

            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            if (month < 10)
                month = "0" + month;
            if (day < 10)
                day = "0" + day;
            var initialLocation;
            var today = year + "-" + month + "-" + day;
            document.getElementById("filterDate").value = today;
            var markersArray = new Array();
            var info = null;
            var strictBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(16.23709060923828, 120.51727294921875),
                    new google.maps.LatLng(17.904427878255003, 121.89630126953125)
                    );
            var minzoom = 10;
            var map_canvas = document.getElementById('map_canvas');//specify which element to print on
            var map_options = {
                center: new google.maps.LatLng(16.4089802, 120.59931329999995), //default start location
                zoom: 16, //zoom level 0-22
                mapTypeId: google.maps.MapTypeId.ROADMAP //type of map (ROADMAP, HYBRID, SATELLITE?)
            };//default options for the map
            var map = new google.maps.Map(map_canvas, map_options);
            //Geolocation
            if (navigator.geolocation) {
                browserSupportFlag = true;
                navigator.geolocation.getCurrentPosition(function(position) {
                    initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(initialLocation);
                }, function() {
                    handleNoGeolocation(browserSupportFlag);
                });
            }
            // Browser doesn't support Geolocation
            else {
                browserSupportFlag = false;
                handleNoGeolocation(browserSupportFlag);
            }

            function handleNoGeolocation(errorFlag) {
                if (errorFlag == true) {
                    alert("Geolocation service failed.");
                    initialLocation = new google.maps.LatLng(16.4089802, 120.59931329999995);
                } else {
                    alert("Your browser doesn't support geolocation.");
                    initialLocation = new google.maps.LatLng(16.4089802, 120.59931329999995);
                }
                map.setCenter(initialLocation);
            }
            var infowindow = new google.maps.InfoWindow();
            var marker = null;
<?php
if ($location != null) {
    foreach ($location as $lolo) {
        if ($lolo->x != null && $lolo->y != null) {
            ?>
                        var lolo = new google.maps.LatLng(<?php echo $lolo->x; ?>, <?php echo $lolo->y; ?>, true);
                        marker = new google.maps.Marker({
                            position: (lolo),
                            icon: "<?php echo base_url() ?>./images/<?php echo $lolo->classification; ?>.png",
                            icon: "<?php echo base_url() ?>./images/public/<?php echo $lolo->classification; ?>.png",
                            map: map,
                            id: <?php echo $lolo->locationID; ?>,
                            title: '<?php echo $lolo->classification; ?>'
                        });
                        marker.mycategory = '<?php echo $lolo->classification; ?>';
                        marker.myid = '<?php echo $lolo->locationID; ?>';
                        marker.mytitle = '<?php echo $lolo->incidentname; ?>';
                        marker.mycity = '<?php echo $lolo->name; ?>';
                        marker.mystreet = '<?php echo $lolo->barangay; ?>';
                        marker.mydate = '<?php echo $lolo->incidentDate; ?>';
                        marker.mydesc = '<?php echo $lolo->description; ?>';
                        markersArray.push(marker);

                        addInfoWindow(marker, '<h4><?php echo $lolo->incidentname; ?>\
                                                                                                                                                                    </h4><h6>Date: <?php echo $lolo->incidentDate; ?></h6><h6><?php echo $lolo->incidentTime; ?>\
                                                                                                                                                                    </h6></br><button id="moreInfo" onclick="moreInfo();" >more info</button>');
                        addInfoWindow(marker, '<h2><?php echo $lolo->incidentname; ?>\
                                                                                                                                                                    </h2><h4>Date: <?php echo $lolo->incidentDate; ?></h4><h4><?php echo $lolo->incidentTime; ?>\
                                                                                                                                                                    </h4></br><button id="moreInfo" onclick="moreInfo();" >more info</button>');

        <?php } ?>
    <?php } ?>
<?php } ?>
            function addInfoWindow(marker, message) {
                infowindow = new google.maps.InfoWindow();

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(message);
                    infowindow.open(map, marker);
                    document.getElementById("locID").value = marker.myid;
                });
                google.maps.event.addListener(marker, 'touchstart', function() {
                    infowindow.setContent(message);
                    infowindow.open(map, marker);
                    document.getElementById("locID").value = marker.myid;
                });
                google.maps.event.addListener(marker, 'rightclick', function() {
                    infowindow.setContent(message);
                    infowindow.open(map, marker);
                    document.getElementById("locID").value = marker.myid;
                });
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
            google.maps.event.addListener(map, 'zoom_changed', function() {
                if (map.getZoom() < minzoom)
                    map.setZoom(minzoom);
            });
        </script>

        <ul id="publicfilterList">
            
            <?php if($accident_type != null){
        foreach($accident_type as $acc){?>
    <label><li><input type="checkbox" id="<?php echo $acc->classification; ?>" onclick="boxclick(this, '<?php echo $acc->classification; ?>');" checked/>
            <img src="<?php echo base_url();?>images/<?php echo $acc->classification; ?>.png"/><?php echo $acc->classification; ?></li></label>
        <?php }
    }
?>








        </ul>
        <input type="text" id="locID" hidden/>
        <div id="markerContent">
        </div>
        <script type="text/javascript">

            function filter() {
                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setVisible(true);
                    infowindow.close();
                }
                var catType = document.getElementById("searchtype").value;
                var searchValue = document.getElementById("searchbar").value;
                var dateValue = document.getElementById("filterDate").value;
                var count = 0;
                var temp;
                switch (catType)
                {
                    case '1':
                        for (var i = 0; i < markersArray.length; i++) {
                            if (markersArray[i].mystreet !== searchValue) {
                                markersArray[i].setVisible(false);

                            } else {
                                count++;
                                temp = markersArray[i];
                            }
                        }
                        if (count === 1) {
                            map.setZoom(19);
                            map.panTo(temp.getPosition());
                            infowindow.setContent(temp.mycontent);
                            infowindow.open(map, temp);
                        }
                        break;
                    case '2':
                        for (var i = 0; i < markersArray.length; i++) {
                            if (markersArray[i].mycity !== searchValue) {
                                markersArray[i].setVisible(false);
                                count++;
                            } else {
                                count++;
                                temp = markersArray[i];
                            }
                        }
                        if (count === 1) {
                            map.setZoom(19);
                            map.panTo(temp.getPosition());
                            infowindow.setContent(temp.mycontent);
                            infowindow.open(map, temp);
                        }
                        break;
                    case '3':
                        for (var i = 0; i < markersArray.length; i++) {
                            if (markersArray[i].mytitle !== searchValue) {
                                markersArray[i].setVisible(false);
                                count++;
                            } else {
                                count++;
                                temp = markersArray[i];
                            }
                        }
                        if (count === 1) {
                            map.setZoom(19);
                            map.panTo(temp.getPosition());
                            infowindow.setContent(temp.mycontent);
                            infowindow.open(map, temp);
                        }
                        break;
                    case '4':
                        for (var i = 0; i < markersArray.length; i++) {
                            if (markersArray[i].mycategory !== searchValue) {
                                markersArray[i].setVisible(false);
                                count++;
                            } else {
                                count++;
                                temp = markersArray[i];
                            }
                        }
                        if (count === 1) {
                            map.setZoom(19);
                            map.panTo(temp.getPosition());
                            infowindow.setContent(temp.mycontent);
                            infowindow.open(map, temp);
                        }
                        break;
                    case '5':
                        for (var i = 0; i < markersArray.length; i++) {
                            if (markersArray[i].mydate !== dateValue) {
                                markersArray[i].setVisible(false);
                                count++;
                            } else {
                                count++;
                                temp = markersArray[i];
                            }
                        }
                        if (count === 1) {
                            map.setZoom(19);
                            map.panTo(temp.getPosition());
                            infowindow.setContent(temp.mycontent);
                            infowindow.open(map, temp);
                        }
                        break;
                }


            }
            function show(category) {
                for (var i = 0; i < markersArray.length; i++) {
                    if (markersArray[i].mycategory == category) {
                        markersArray[i].setVisible(true);
                    }
                }
                document.getElementById(category).checked = true;
                infowindow.close();
            }
            function hide(category) {
                for (var i = 0; i < markersArray.length; i++) {
                    if (markersArray[i].mycategory == category) {
                        markersArray[i].setVisible(false);
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

            function getCode(event) {
                if (event.which == 13 || event.keyCode == 13)
                    filter();
            }

            function getIndex() {
                var index = document.getElementById("searchtype").value;
                if (index == '5') {
                    document.getElementById("filterDate").removeAttribute("hidden");
                }
            }
            function moreInfo() {
                var id = $('#locID').val();
                $.ajax({
                    url: "<?php echo base_url() ?>" + "seeMore/",
                    type: 'POST',
                    data: {'locationID': id},
                    dataType: 'JSON',
                    success: function(data) {
                        var content = data.split(",");

                        document.getElementById("markerContent").innerHTML = "<h1>" + content[1] +
                                "</h1>" + "<h2>" + content[0] + "</h2>" + "<h2>"
                                + content[2] + "&nbsp; " + content [3] + "</h2>" + "<p>" + content[5] + "</p>";
                    }, error: function() {
                        alert('error');
                    }
                });

                $(document).ready(function() {
                    $("#markerContent").bPopup({
                        escClose: true
                    });
                });
            }
        </script>

    </body>
</html>
