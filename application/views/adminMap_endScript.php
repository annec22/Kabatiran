<script>
    function closeDelete() {
        $(document).ready(function() {
            $("#popupDelete").bPopup().close();
        });
    }
    function imageClick(value) {
        $(document).ready(function() {
            $("#temp").val(value);
//            $("#type")[0].selectedIndex = index - 1;
            $("#type").val(value);
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
//    var date = new Date();
//
//    var day = date.getDate();
//    var month = date.getMonth() + 1;
//    var year = date.getFullYear();
//
//    if (month < 10)
//        month = "0" + month;
//    if (day < 10)
//        day = "0" + day;
//
//    var today = year + "-" + month + "-" + day;
//    document.getElementById("date").value = today;
    $(document).ready(function() {  
        $('#facebook').prop('checked', true);
        $('#twitter').prop('checked', true);
        
        var fb = $("#facebookCB").val();
        if(fb !== "fb"){
            $('#facebook').hide();
            $('#publishOn').text("Please Log in to facebook through the bulletin module.");
        }
        
        $('#facebook').click(function() {
            if($(this).is(":checked")) {
                $('#facebook').prop('checked', true);
            }else{
                $('#facebook').prop('checked', false);
            }
        });
        
        $('#twitter').click(function() {
            if($(this).is(":checked")) {
                $('#twitter').prop('checked', true);
            }else{
                $('#twitter').prop('checked', false);
            }
        });
    });
    
    function fbPost() {
        var long = document.getElementById("longitude").value;
        var lat = document.getElementById("latitude").value;
        var title = document.getElementById("markerTitle").value;
        var cm = $('#optionCity').val();
        var brgy = document.getElementById("brgy").value;
        var hr = parseInt(document.getElementById("hr").value);
        if ($('#timeOfDay').val() === 'PM') {
            var timeOfDay = hr + 12;
        } else {
            var timeOfDay = hr;
        }
        
        var time = document.getElementById("hr").value + ":" + document.getElementById("min").value + " " + document.getElementById("timeOfDay");
        var date = document.getElementById("date").value;
        var dateVal = document.getElementById("date").value;
        var type = document.getElementById("temp").value;
        var desc = document.getElementById("description").value;
        var prov = document.getElementById("prov").value;
        var hour = timeOfDay;
        var min = document.getElementById("min").value;

        var msg = title + " " + cm + " " + brgy + " " + " " + time + " " + date + " " + type + " " + desc;

        var msgs = title + ": " + type + " @ " + brgy + ", " + cm + " \nWhen: " + date + " " + time + " \nDescription: " + desc;
        $.ajax({
            url: "<?php echo base_url() . 'addMapLocation'; ?>",
            type: 'POST',
            data: {'description': desc, 'temp': type, 'prov': prov, 'cm': cm, 'brgy': brgy, 'latitude': lat,
                'longitude': long, 'hr': hour, 'min': min, 'date': dateVal, 'title': title},
            dataType: 'JSON',
            success: function(data) {
                var fb = $('#facebook').is(':checked');
                var twitter = $('#twitter').is(':checked');
                
                if (fb) {
                    document.fbForm.msg.value += msg;
                    $('#fbSubmit').click();
                } 
                if ($('#twitter').is(':checked')) {
                    $.ajax({
                        url: "<?php echo base_url() ?>" + "tweetPost",
                        type: 'POST',
                        data: {'bullTxt': msgs},
                        dataType: 'JSON',
                        success: function(data) {
                            alert("Successfully Tweeted.");
                        },
                        error: function() {
                            //alert("error");
                        }
                    });
                } if(!fb && !twitter) {
                    location.reload();
                }
            },
            error: function() {
                alert("failed plotting");
            }
        });
    }

    function timeCheck() {
        if($('#timeOfDayEdit').val() === 'PM'){
            
            $('#hrs').val(parseInt($('#hrEdit').val()) + 12);
        }else{
            $('#hrs').val($('#hrEdit').val());
        }
    }
</script>