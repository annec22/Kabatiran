<script type ="text/javascript">
     //=====INBOX function=====
    function clickChild(chClass){
        var child = "parent" + chClass + ".1";
        if(!document.getElementsByClassName(child).checked){
            for(var ctr=0; document.getElementsByClassName(child).length > ctr;ctr++){
                document.getElementsByClassName(child)[ctr].click(); 
            }           
        }else{
            for(var ctr=0; document.getElementsByClassName(child).length > ctr;ctr++){
                 document.getElementsByClassName(child)[ctr].click(); 
            }         
        }
    }
    
    function getCheckCount(){
        /* declare a checkbox array */
        var chkArray = [];

        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".checkme:checked,.checkmeTrash:checked,.checkmeSpam:checked, .checkmeConfirmed:checked, .checkmeLog:checked, .checkmeBulletin:checked").each(function() {
            chkArray.push($(this).val());
        });

        /* we join the array separated by the comma */
        var selected;
        selected = chkArray.join(',') + ",";

        return selected;
    }

    
    $(document).ready(function() {  
         var one = 1;
         var table = document.getElementById('repInboxTable');
         
         for (var row = 2, n = table.rows.length; row < n; row++) {
            var ctr = 1;
            for(var count = 1; count<n; count++){
                var next = row+count;
                if(next < n){
                    if(table.rows[row].cells[1].innerHTML == table.rows[next].cells[1].innerHTML && 
                            table.rows[row].cells[2].innerHTML == table.rows[next].cells[2].innerHTML && 
                            table.rows[row].cells[3].innerHTML == table.rows[next].cells[3].innerHTML && 
                            table.rows[row].cells[4].innerHTML == table.rows[next].cells[4].innerHTML){
                        if(count == 1){
                            ctr++;
                            table.rows[row].setAttribute('data-tt-id',row);
                            table.rows[next].setAttribute('data-tt-id',row+".1");
                            table.rows[next].setAttribute('data-tt-parent-id',row);

                            table.rows[row].cells[8].innerHTML = ctr;
                            if(ctr < 10){
                                table.rows[row].cells[8].style.color="#00CC00";
                            }else if(ctr < 10 && ctr > 20){
                                table.rows[row].cells[8].style.color="#FF9900";
                            }else{
                                table.rows[row].cells[8].style.color="#FF0000";
                            }
                            
                            table.rows[next].cells[8].innerHTML = one;
                            table.rows[row].cells[0].firstChild.setAttribute("onclick","clickChild('"+row+"')");
                            table.rows[next].cells[0].firstChild.setAttribute("class","checkme parent"+row+".1");
                        }else{
                            ctr++;
                            table.rows[next].setAttribute('data-tt-id',row+".1");
                            table.rows[next].setAttribute('data-tt-parent-id',row);
                            table.rows[next].cells[8].innerHTML = one;
                            table.rows[next].cells[0].firstChild.setAttribute("class","checkme parent"+row+".1");
                        }
                    }else{        
                       table.rows[row].cells[8].innerHTML = ctr;
                       table.rows[row].cells[8].style.color="#00CC00";
                       row = next-1;
                       break;
                    }
                }else{
                    table.rows[row].cells[8].innerHTML = ctr;
                    table.rows[row].cells[8].style.color="#00CC00";
                    row = next-1;
                    break;
                } 
            }        
         }

         var trashTable = document.getElementById('repTrashTable');

         for (var row = 2, n = trashTable.rows.length; row < n; row++) {
            var ctr = 1;
            for (var count = 1; count < n; count++) {
                var next = row + count;
                if (next < n) {
                    if (trashTable.rows[row].cells[1].innerHTML == trashTable.rows[next].cells[1].innerHTML &&
                            trashTable.rows[row].cells[2].innerHTML == trashTable.rows[next].cells[2].innerHTML &&
                            trashTable.rows[row].cells[3].innerHTML == trashTable.rows[next].cells[3].innerHTML &&
                            trashTable.rows[row].cells[4].innerHTML == trashTable.rows[next].cells[4].innerHTML) {
                        if (count == 1) {
                            ctr++;
                            trashTable.rows[row].setAttribute('data-tt-id', row);
                            trashTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            trashTable.rows[next].setAttribute('data-tt-parent-id', row);

                            trashTable.rows[row].cells[8].innerHTML = ctr;
                            if (ctr < 10) {
                                trashTable.rows[row].cells[8].style.color = "#00CC00";
                            } else if (ctr < 10 && ctr > 20) {
                                trashTable.rows[row].cells[8].style.color = "#FF9900";
                            } else {
                                trashTable.rows[row].cells[8].style.color = "#FF0000";
                            }

                            trashTable.rows[next].cells[8].innerHTML = one;
                            trashTable.rows[row].cells[0].firstChild.setAttribute("onclick", "clickChild('" + row + "')");
                            trashTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        } else {
                            ctr++;
                            trashTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            trashTable.rows[next].setAttribute('data-tt-parent-id', row);
                            trashTable.rows[next].cells[8].innerHTML = one;
                            trashTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        }
                    } else {
                        trashTable.rows[row].cells[8].innerHTML = ctr;
                        trashTable.rows[row].cells[8].style.color = "#00CC00";
                        row = next - 1;
                        break;
                    }
                } else {
                    trashTable.rows[row].cells[8].innerHTML = ctr;
                    trashTable.rows[row].cells[8].style.color = "#00CC00";
                    row = next - 1;
                    break;
                }
            }
        }

         var spamTable = document.getElementById('repSpamTable');

         for (var row = 2, n = spamTable.rows.length; row < n; row++) {
            var ctr = 1;
            for (var count = 1; count < n; count++) {
                var next = row + count;
                if (next < n) {
                    if (spamTable.rows[row].cells[1].innerHTML == spamTable.rows[next].cells[1].innerHTML &&
                            spamTable.rows[row].cells[2].innerHTML == spamTable.rows[next].cells[2].innerHTML &&
                            spamTable.rows[row].cells[3].innerHTML == spamTable.rows[next].cells[3].innerHTML &&
                            spamTable.rows[row].cells[4].innerHTML == spamTable.rows[next].cells[4].innerHTML) {
                        if (count == 1) {
                            ctr++;
                            spamTable.rows[row].setAttribute('data-tt-id', row);
                            spamTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            spamTable.rows[next].setAttribute('data-tt-parent-id', row);

                            spamTable.rows[row].cells[8].innerHTML = ctr;
                            if (ctr < 10) {
                                spamTable.rows[row].cells[8].style.color = "#00CC00";
                            } else if (ctr < 10 && ctr > 20) {
                                spamTable.rows[row].cells[8].style.color = "#FF9900";
                            } else {
                                spamTable.rows[row].cells[8].style.color = "#FF0000";
                            }

                            spamTable.rows[next].cells[8].innerHTML = one;
                            spamTable.rows[row].cells[0].firstChild.setAttribute("onclick", "clickChild('" + row + "')");
                            spamTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        } else {
                            ctr++;
                            spamTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            spamTable.rows[next].setAttribute('data-tt-parent-id', row);
                            spamTable.rows[next].cells[8].innerHTML = one;
                            spamTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        }
                    } else {
                        spamTable.rows[row].cells[8].innerHTML = ctr;
                        spamTable.rows[row].cells[8].style.color = "#00CC00";
                        row = next - 1;
                        break;
                    }
                } else {
                    spamTable.rows[row].cells[8].innerHTML = ctr;
                    spamTable.rows[row].cells[8].style.color = "#00CC00";
                    row = next - 1;
                    break;
                }
            }
        }

         var confTable = document.getElementById('repConfTable');

         for (var row = 2, n = confTable.rows.length; row < n; row++) {
            var ctr = 1;
            for (var count = 1; count < n; count++) {
                var next = row + count;
                if (next < n) {
                    if (confTable.rows[row].cells[1].innerHTML == confTable.rows[next].cells[1].innerHTML &&
                            confTable.rows[row].cells[2].innerHTML == confTable.rows[next].cells[2].innerHTML &&
                            confTable.rows[row].cells[3].innerHTML == confTable.rows[next].cells[3].innerHTML &&
                            confTable.rows[row].cells[4].innerHTML == confTable.rows[next].cells[4].innerHTML) {
                        if (count == 1) {
                            ctr++;
                            confTable.rows[row].setAttribute('data-tt-id', row);
                            confTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            confTable.rows[next].setAttribute('data-tt-parent-id', row);

                            confTable.rows[row].cells[8].innerHTML = ctr;
                            if (ctr < 10) {
                                confTable.rows[row].cells[8].style.color = "#00CC00";
                            } else if (ctr < 10 && ctr > 20) {
                                confTable.rows[row].cells[8].style.color = "#FF9900";
                            } else {
                                confTable.rows[row].cells[8].style.color = "#FF0000";
                            }

                            confTable.rows[next].cells[8].innerHTML = one;
                            confTable.rows[row].cells[0].firstChild.setAttribute("onclick", "clickChild('" + row + "')");
                            confTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        } else {
                            ctr++;
                            confTable.rows[next].setAttribute('data-tt-id', row + ".1");
                            confTable.rows[next].setAttribute('data-tt-parent-id', row);
                            confTable.rows[next].cells[8].innerHTML = one;
                            confTable.rows[next].cells[0].firstChild.setAttribute("class", "checkme parent" + row + ".1");
                        }
                    } else {
                        confTable.rows[row].cells[8].innerHTML = ctr;
                        confTable.rows[row].cells[8].style.color = "#00CC00";
                        row = next - 1;
                        break;
                    }
                } else {
                    confTable.rows[row].cells[8].innerHTML = ctr;
                    confTable.rows[row].cells[8].style.color = "#00CC00";
                    row = next - 1;
                    break;
                }
            }
        }
        
        /*Datepicker*/
        $.datepicker.regional[""].dateFormat = 'M. dd, yy';
        $.datepicker.setDefaults($.datepicker.regional['']);
        $.datepicker.setDefaults({
            dateFormat: "M. dd, yy",
            changeMonth: true,
            changeYear: true, 
            maxDate: "+0D"
        });
        
        $('#repInboxTable').treetable({expandable: true, indent:20});
        $('#repTrashTable').treetable({expandable: true, indent:20});
        $('#repSpamTable').treetable({expandable: true, indent:20});
        $('#repConfTable').treetable({expandable: true, indent:20});
        
        /*Initializing the corresponding data table of the database that will be chosen*/
        
         var oInbox = $('#repInboxTable').dataTable({ 
            "bAutoWidth": false, 
            "aaSorting": [],
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                $(nRow).children().attr('class', 'inbox');
                return nRow;
             }
        }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: [ 	null,
                                { type: "select", values: [ 'Drowning Incident', 'Earthquake', 'Fire', 'Insurgence', 'Landslide', 'Road Block', 'Rock Fall', 'Vehicular Accident']},
                                null,
                                null,
                                { type: "select", values: [ 'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province']},
                                { type: "date-range"},
                                null,
                                null,
                                null
                        ]
            });
                  
        var oTrash = $('#repTrashTable').dataTable({   
            "bAutoWidth": false,
            "aaSorting": [],
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }]
        }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: [ 	null,
                                { type: "select", values: [ 'Drowning Incident', 'Earthquake', 'Fire', 'Insurgence', 'Landslide', 'Road Block', 'Rock Fall', 'Vehicular Accident']},
                                null,
                                null,
                                { type: "select", values: [ 'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province']},
                                { type: "date-range"},
                                null,
                                null,
                                null
                        ]
            });
        
        var oSpam = $('#repSpamTable').dataTable({   
            "bAutoWidth": false,
            "aaSorting": [],
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }]
        }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: [ 	null,
                                { type: "select", values: [ 'Drowning Incident', 'Earthquake', 'Fire', 'Insurgence', 'Landslide', 'Road Block', 'Rock Fall', 'Vehicular Accident']},
                                null,
                                null,
                                { type: "select", values: [ 'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province']},
                                { type: "date-range"},
                                null,
                                null,
                                null
                        ]
            });

        var oConf = $('#repConfTable').dataTable({ 
            "bAutoWidth": false,
            "aaSorting": [],
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }]
        }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: [ 	null,
                                { type: "select", values: [ 'Drowning Incident', 'Earthquake', 'Fire', 'Insurgence', 'Landslide', 'Road Block', 'Rock Fall', 'Vehicular Accident']},
                                null,
                                null,
                                { type: "select", values: [ 'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province']},
                                { type: "date-range"},
                                null,
                                null,
                                null
                        ]
            });
            
            //======= INFORMAPP INBOX SCRIPT ====== //
            $(document).ready(function()
            {          
                //navigation
                $(document).on("mousedown","#inbox",function(){
                    $('input[type=checkbox]').prop('checked',false);             
                    
                    $('#inboxTable').removeClass('hidden').addClass('show');
                    $('#trashTable').removeClass('show').addClass('hidden');
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').show();
                    $('#deleteButton').hide();
                    $('#restoreButton').hide();
                    $('#trashButton').show();
                    $('#spamButton').show();
                });
                
                $('#trash').click(function(e){
                    e.preventDefault();
                
                    $('input[type=checkbox]').prop('checked',false);
                
                    $('#trashTable').removeClass('hidden').addClass('show');
                    $('#inboxTable').removeClass('show').addClass('hidden'); 
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').show();
                    $('#restoreButton').show();
                    $('#trashButton').hide();
                    $('#spamButton').hide();
                });
                
                $('#spam').click(function(e){
                    
                    $('input[type=checkbox]').prop('checked',false);
                
                    $('#spamTable').removeClass('hidden').addClass('show');
                    $('#inboxTable').removeClass('show').addClass('hidden');
                    $('#trashTable').removeClass('show').addClass('hidden'); 
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').show();
                    $('#restoreButton').hide();
                    $('#trashButton').hide();
                    $('#spamButton').hide();
                });
                
                $('#confirmed').click(function(e){
                    e.preventDefault();
                
                    $('input[type=checkbox]').prop('checked',false);
                
                    $('#trashTable').removeClass('show').addClass('hidden');
                    $('#inboxTable').removeClass('show').addClass('hidden'); 
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('hidden').addClass('show');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').hide();
                    $('#restoreButton').hide();
                    $('#trashButton').show();
                    $('#spamButton').hide();
                });
                               
                               
                               $('#inboxNavSelect').on('change',function(){
                    if($('#inboxNavSelect').find(":selected").text()==="Inbox"){
                        $('input[type=checkbox]').prop('checked',false);             
                    
                    $('#inboxTable').removeClass('hidden').addClass('show');
                    $('#trashTable').removeClass('show').addClass('hidden');
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').show();
                    $('#deleteButton').hide();
                    $('#restoreButton').hide();
                    $('#trashButton').show();
                    $('#spamButton').show();
                   }else if($('#inboxNavSelect').find(":selected").text()==="Confirmed"){
                       $('input[type=checkbox]').prop('checked',false);
                
                    $('#trashTable').removeClass('show').addClass('hidden');
                    $('#inboxTable').removeClass('show').addClass('hidden'); 
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('hidden').addClass('show');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').hide();
                    $('#restoreButton').hide();
                    $('#trashButton').show();
                    $('#spamButton').hide();
                   }else if($('#inboxNavSelect').find(":selected").text()==="Trash"){
                       $('input[type=checkbox]').prop('checked',false);
                
                    $('#trashTable').removeClass('hidden').addClass('show');
                    $('#inboxTable').removeClass('show').addClass('hidden'); 
                    $('#spamTable').removeClass('show').addClass('hidden');
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').show();
                    $('#restoreButton').show();
                    $('#trashButton').hide();
                    $('#spamButton').hide();
                   }else if($('#inboxNavSelect').find(":selected").text()==="Spam"){
                        $('input[type=checkbox]').prop('checked',false);
                
                    $('#spamTable').removeClass('hidden').addClass('show');
                    $('#inboxTable').removeClass('show').addClass('hidden');
                    $('#trashTable').removeClass('show').addClass('hidden'); 
                    $('#confirmedTable').removeClass('show').addClass('hidden');
                    
                    $('#confirmButton').hide();
                    $('#deleteButton').show();
                    $('#restoreButton').hide();
                    $('#trashButton').hide();
                    $('#spamButton').hide();
                   }           
                });
                
                $('.checkme').click(function(event) {   
                    if(!this.checked){
                        $('#select-all').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('.checkmeTrash').click(function(event) {   
                    if(!this.checked){
                        $('#select-allTrash').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('.checkmeSpam').click(function(event) {   
                    if(!this.checked){
                        $('#select-allSpam').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('.checkmeConfirmed').click(function(event) {   
                    if(!this.checked){
                        $('#select-allConf').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('#select-all').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.checkme,.check').each(function() {
                            this.checked = true;                        
                        });
                    }else if(!this.checked){
                        $('.checkme').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('#select-allTrash').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.checkmeTrash').each(function() {
                            this.checked = true;                        
                        });
                    }else if(!this.checked){
                        $('.checkmeTrash').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('#select-allSpam').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.checkmeSpam').each(function() {
                            this.checked = true;                        
                        });
                    }else if(!this.checked){
                        $('.checkmeSpam').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
                
                $('#select-allConf').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.checkmeConfirmed').each(function() {
                            this.checked = true;                        
                        });
                    }else if(!this.checked){
                        $('.checkmeConfirmed').each(function() {
                            this.checked = false;                        
                        });
                    }
                });

                /* Get the checkboxes values based on the class attached to each check box */
                $("#trashButton").click(function() {
                    var mergedTrashID = getCheckCount();
                    
                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedTrashID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var r=confirm("Are you sure you want to send the report/s to trash?");
                        if (r==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "trashReport/", 
                                type: 'POST',
                                data: {'mergedTrashID':mergedTrashID},
                                dataType: 'JSON',
                                success: function(data){
                                     alert(data);
                                     location.reload();
                                },
                                 error: function()
                                 {
                                     alert("Unable to retrieve Trashables.");
                                 } 

                             });
                         }
                    }
                });
                
                /* Get the checkboxes values based on the class attached to each check box */
                $("#confirmButton").click(function() {
                    var mergedConfirmedID = getCheckCount();
                    var getOne = mergedConfirmedID.split(",");
                    var retrieveID = getOne[0];
                    
                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedConfirmedID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var s=confirm("Are you sure you want to confirm the report/s?");
                        if (s==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "checkIfConfirmed", 
                                type: 'POST',
                                data: {'mergedConfirmedID':mergedConfirmedID, 'id': retrieveID},
                                dataType: 'JSON',
                                success: function(data){
                                    
                                    var separate = data.split("|");
                                    var length = separate.length-2;
                                    var afterCheck = "";
                                    var confirmables = "";
                                    for(var ctr = 0;length >= ctr ; ctr++){
                                        if(separate[ctr].indexOf("C")>=0){
                                            afterCheck = "OK";
                                        }else{
                                            confirmables += separate[ctr].replace( /^\D+/g, '') + ",";   
                                        }
                                    }

                                    if(afterCheck == "OK"){
                                        alert("Report/s is/are already Confirmed. Page will reload.");
                                        location.reload();
                                    }else if (confirmables != "" || confirmables != null){
                                        afterCheck = "0";
                                        $.ajax({
                                        url: "<?php echo base_url() ?>" + "confirmReport", 
                                        type: 'POST',
                                        data: {'mergedConfirmedID':confirmables, 'id': retrieveID},
                                        dataType: 'JSON',
                                        success: function(data){
                                            
                                            var splitter = data.split("|");
                                            var inciDate = splitter[3];
                                            var inciTime = splitter[4];
                                            var province = splitter[7];
                                            var municipality = splitter[8];
                                            var barangay = splitter[9];
                                            var inciType = splitter[10];
                                            var timeSplit = inciTime.split(":");
                                            var minutes = timeSplit[1];
                                           
                                            var hour = "";
                                            var meridian = "AM";
                                            if(timeSplit[0] >= 12){
                                                hour = timeSplit[0]-12;
                                                meridian = "PM";
                                            }
                                        
                                            var r=confirm("Confirmation Successful. Press OK to plot an incident otherwise Cancel.");
                                            if (r==true)
                                            {
                                               $('#hr').val(hour);
                                               $('#min').val(minutes);
                                               $('#timeOfDay').val(meridian);
                                               $('#cityHolder').val(municipality);
                                               $('#brgyHolder').val(barangay);
                                               $('#optionProvince').val(province);
                                               $('#optionProvince').trigger('change');
                                               $('#maps').click();
                                               var location1;
                                               $.ajax({
                                                   url: "<?php echo base_url() ?>" + "getBrgyLoc",
                                                   type: 'POST',
                                                   data: {'brgy': barangay},
                                                   dataType: 'JSON',
                                                   success: function(data){
                                                        
                                                        var x = data.split("|")[1];
                                                        var y = data.split("|")[0];
                                                        location1 = new google.maps.LatLng(x,y);
                                                        goToMarker(location1);
                                                        $("#longitude").val(x);
                                                        $("#latitude").val(y);
                                                        $("#optionBrgy").val(barangay);
                                                        $("#optionBrgy").trigger("change");
                                                   },
                                                   error: function(){
                                                        alert("no barangay");
                                                   }
                                               });
                                               $('#type').val(inciType);
                                               $('#type').trigger('change');
                                               $('#temp').val(inciType);
                                               $("#date").val(inciDate);
                                            }
                                            else
                                            {
                                               location.reload();
                                            } 
                                        },
                                         error: function()
                                         {
                                             alert("Unable to retrieve Confirmables.");
                                         } 
                                     });
                                    } 
                                },error: function(){
                                    alert("Error in checking if the report is confirmed.");
                                }
                            });
                        }
                    }
                });
                
                /* Get the checkboxes values based on the class attached to each check box */
                $("#spamButton").click(function() {
                    var mergedSpamID = getCheckCount();

                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedSpamID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var r=confirm("Are you sure you want to mark the report/s as spam?");
                        if (r==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "spamReport/", 
                                type: 'POST',
                                data: {'mergedSpamID':mergedSpamID},
                                dataType: 'JSON',
                                success: function(data){
                                     alert(data);
                                     location.reload();
                                },
                                 error: function()
                                 {
                                     alert("Unable to retrieve Spammables.");
                                 } 

                             });
                         }
                    }
                });
                
                /* Get the checkboxes values based on the class attached to each check box */
                $("#deleteButton").click(function() {
                    var mergedDeleteID = getCheckCount();

                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedDeleteID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var r=confirm("Are you sure you want to delete the report/s?");
                        if (r==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "deleteReport/", 
                                type: 'POST',
                                data: {'mergedDeleteID':mergedDeleteID},
                                dataType: 'JSON',
                                success: function(data){
                                     alert(data); 
                                     location.reload();
                                },
                                 error: function()
                                 {
                                     alert("Unable to Delete Report.");
                                 } 

                             });
                         }
                    }
                });
                
                $("#restoreButton").click(function() {
                    var mergedRestoreID = getCheckCount();

                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedRestoreID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var r=confirm("Are you sure you want to restore the report/s from trash?");
                        if (r==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "restoreReport/", 
                                type: 'POST',
                                data: {'mergedRestoreID':mergedRestoreID},
                                dataType: 'JSON',
                                success: function(data){
                                     alert(data);   
                                     location.reload();
                                },
                                 error: function()
                                 {
                                     alert("Unable to Restore Report.");
                                 } 

                             });
                         }
                    }
                });
                
                $("#reload").click(function() {
                   location.reload();
                });
                              
                $(document).on("mousedown","#viewRepTrigger,#viewRepTrigger1,#viewRepTrigger2,#viewRepTrigger3,#viewRepTrigger4,#viewRepTrigger5,#viewRepTrigger6",function(e){
                    if(e.which === 1){
                        var reportIndex = $(this).attr('name');

                        $(this).closest('tr').attr("style","background:#D8D8D8;"); 
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "readReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              success: function(data){
                              }
                        });
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "getReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              dataType: 'JSON',
                              success: function(data){
                                    $('#generateImage').html("");
                                    $('#generateAudio').html("");

                                    var splitter = data.split("|");
                                    var ctr = 13;
                                    var baseUrl =  "<?php echo base_url()."uploads/"?>";

                                    $(".reporterName").text(splitter[0]+" "+splitter[1]+" "+splitter[2]);
                                    $(".incidentTimestamp").text(splitter[3]+" "+splitter[4]);
                                    $(".reportTimestamp").text(splitter[5]+" "+splitter[6]);
                                    $(".reportLocation").text(splitter[8]+", "+splitter[7]);
                                    $(".reportBarangay").text(splitter[9]);
                                    $(".reportClassification").text(splitter[10]);
                                    $(".reportDescription").text(splitter[11]);

                                    do{                                
                                        var stringToCheck = splitter[ctr].toString().toLowerCase();
                                        if(stringToCheck.indexOf(".jpg") > -1 || stringToCheck.indexOf(".jpeg") > -1 || stringToCheck.indexOf(".png") > -1 || stringToCheck.indexOf(".bmp") > -1){
                                            $('#generateImage').append('<a class="example-image-link" href="' + baseUrl + "images/" + splitter[ctr] + '" data-lightbox="example-set" ><img class="example-image" src="' + baseUrl + "images/" + splitter[ctr] + '" height="150px" width="150px" /></a>');
                                        }else if(stringToCheck.indexOf(".mp3") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mpeg" />');
                                        }else if(stringToCheck.indexOf(".mp4") > -1 || stringToCheck.indexOf(".m4a") > -1 || stringToCheck.indexOf(".aac") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mp4" />');
                                        }else if(stringToCheck.indexOf(".oga") > -1 || stringToCheck.indexOf(".ogg") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/ogg" />');
                                        }else if(stringToCheck.indexOf(".wav") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/wav" />');
                                        }
                                        ctr++;
                                    }while(ctr < splitter.length-1)
                                  $('.PopUpWindowRep').bPopup({
                                      follow: [false, false], //x, y
                                      modalClose: false,
                                      onClose: function() { 
                                                    
                                                    $('audio').each(function(){
                                                        this.pause(); // Stop playing
                                                        this.currentTime = 0; // Reset time
                                                    }); 
                                               }
                                  });
                              },
                              error: function()
                              {
                                  alert("Data Retrieval Failed.");
                              }        
                      });
                    }
                });
                
                $(document).on("mousedown","#viewTrashTrigger,#viewTrashTrigger1,#viewTrashTrigger2,#viewTrashTrigger3,#viewTrashTrigger4,#viewTrashTrigger5,#viewTrashTrigger6",function(e){
                    if(e.which === 1){
                        var reportIndex = $(this).attr('name');

                        $(this).closest('tr').attr("style","background:#D8D8D8;"); 
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "readReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              success: function(data){
                              }
                        });
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "getReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              dataType: 'JSON',
                              success: function(data){
                                    $('#generateImage').html("");
                                    $('#generateAudio').html("");

                                    var splitter = data.split("|");
                                    var ctr = 13;
                                    var baseUrl =  "<?php echo base_url()."uploads/"?>";

                                    $(".reporterName").text(splitter[0]+" "+splitter[1]+" "+splitter[2]);
                                    $(".incidentTimestamp").text(splitter[3]+" "+splitter[4]);
                                    $(".reportTimestamp").text(splitter[5]+" "+splitter[6]);
                                    $(".reportLocation").text(splitter[8]+", "+splitter[7]);
                                    $(".reportBarangay").text(splitter[9]);
                                    $(".reportClassification").text(splitter[10]);
                                    $(".reportDescription").text(splitter[11]);

                                    do{                                
                                        var stringToCheck = splitter[ctr].toString().toLowerCase();
                                        if(stringToCheck.indexOf(".jpg") > -1 || stringToCheck.indexOf(".jpeg") > -1 || stringToCheck.indexOf(".png") > -1 || stringToCheck.indexOf(".bmp") > -1){
                                            $('#generateImage').append('<a class="example-image-link" href="' + baseUrl + "images/" + splitter[ctr] + '" data-lightbox="example-set" ><img class="example-image" src="' + baseUrl + "images/" + splitter[ctr] + '" height="150px" width="150px" /></a>');
                                        }else if(stringToCheck.indexOf(".mp3") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mpeg" />');
                                        }else if(stringToCheck.indexOf(".mp4") > -1 || stringToCheck.indexOf(".m4a") > -1 || stringToCheck.indexOf(".aac") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mp4" />');
                                        }else if(stringToCheck.indexOf(".oga") > -1 || stringToCheck.indexOf(".ogg") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/ogg" />');
                                        }else if(stringToCheck.indexOf(".wav") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/wav" />');
                                        }
                                        ctr++;
                                    }while(ctr < splitter.length-1)
                                  $('.PopUpWindowRep').bPopup({
                                      follow: [false, false], //x, y
                                      modalClose: false,
                                      onClose: function() { 
                                                    $('audio').each(function(){
                                                        this.pause(); // Stop playing
                                                        this.currentTime = 0; // Reset time
                                                    }); 
                                               }
                                  });
                              },
                              error: function()
                              {
                                  alert("Data Retrieval Failed.");
                              }        
                      });
                    }
                });
                
                 $(document).on("mousedown","#viewSpamTrigger,#viewSpamTrigger1,#viewSpamTrigger2,#viewSpamTrigger3,#viewSpamTrigger4,#viewSpamTrigger5,#viewSpamTrigger6",function(e){
                    if(e.which === 1){
                       var reportIndex = $(this).attr('name');

                        $(this).closest('tr').attr("style","background:#D8D8D8;"); 
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "readReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              success: function(data){
                              }
                        });
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "getReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              dataType: 'JSON',
                              success: function(data){
                                    $('#generateImage').html("");
                                    $('#generateAudio').html("");

                                    var splitter = data.split("|");
                                    var ctr = 13;
                                    var baseUrl =  "<?php echo base_url()."uploads/"?>";

                                    $(".reporterName").text(splitter[0]+" "+splitter[1]+" "+splitter[2]);
                                    $(".incidentTimestamp").text(splitter[3]+" "+splitter[4]);
                                    $(".reportTimestamp").text(splitter[5]+" "+splitter[6]);
                                    $(".reportLocation").text(splitter[8]+", "+splitter[7]);
                                    $(".reportBarangay").text(splitter[9]);
                                    $(".reportClassification").text(splitter[10]);
                                    $(".reportDescription").text(splitter[11]);
                                    
                                    do{                                
                                        var stringToCheck = splitter[ctr].toString().toLowerCase();
                                        if(stringToCheck.indexOf(".jpg") > -1 || stringToCheck.indexOf(".jpeg") > -1 || stringToCheck.indexOf(".png") > -1 || stringToCheck.indexOf(".bmp") > -1){
                                            $('#generateImage').append('<a class="example-image-link" href="' + baseUrl + "images/" + splitter[ctr] + '" data-lightbox="example-set" ><img class="example-image" src="' + baseUrl + "images/" + splitter[ctr] + '" height="150px" width="150px" /></a>');
                                        }else if(stringToCheck.indexOf(".mp3") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mpeg" />');
                                        }else if(stringToCheck.indexOf(".mp4") > -1 || stringToCheck.indexOf(".m4a") > -1 || stringToCheck.indexOf(".aac") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mp4" />');
                                        }else if(stringToCheck.indexOf(".oga") > -1 || stringToCheck.indexOf(".ogg") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/ogg" />');
                                        }else if(stringToCheck.indexOf(".wav") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/wav" />');
                                        }
                                        ctr++;
                                    }while(ctr < splitter.length-1)
                                  $('.PopUpWindowRep').bPopup({
                                      follow: [false, false], //x, y
                                      modalClose: false,
                                      onClose: function() { 
                                                   $('audio').each(function(){
                                                        this.pause(); // Stop playing
                                                        this.currentTime = 0; // Reset time
                                                    }); 
                                               }
                                  });
                              },
                              error: function()
                              {
                                  alert("Data Retrieval Failed.");
                              }        
                      });
                    }
                });
                
                 $(document).on("mousedown","#viewConfTrigger,#viewConfTrigger1,#viewConfTrigger2,#viewConfTrigger3,#viewConfTrigger4,#viewConfTrigger5,#viewConfTrigger6",function(e){
                    if(e.which === 1){
                        var reportIndex = $(this).attr('name');

                        $(this).closest('tr').attr("style","background:#D8D8D8;"); 
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "readReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              success: function(data){
                              }
                        });
                        $.ajax({
                              url: "<?php echo base_url() ?>" + "getReport/",
                              type: 'POST',
                              data: {'reportIndex':reportIndex},
                              dataType: 'JSON',
                              success: function(data){
                                    $('#generateImage').html("");
                                    $('#generateAudio').html("");

                                    var splitter = data.split("|");
                                    var ctr = 13;
                                    var baseUrl =  "<?php echo base_url()."uploads/"?>";

                                    $(".reporterName").text(splitter[0]+" "+splitter[1]+" "+splitter[2]);
                                    $(".incidentTimestamp").text(splitter[3]+" "+splitter[4]);
                                    $(".reportTimestamp").text(splitter[5]+" "+splitter[6]);
                                    $(".reportLocation").text(splitter[8]+", "+splitter[7]);
                                    $(".reportBarangay").text(splitter[9]);
                                    $(".reportClassification").text(splitter[10]);
                                    $(".reportDescription").text(splitter[11]);
                                    
                                    do{                                
                                        var stringToCheck = splitter[ctr].toString().toLowerCase();
                                        if(stringToCheck.indexOf(".jpg") > -1 || stringToCheck.indexOf(".jpeg") > -1 || stringToCheck.indexOf(".png") > -1 || stringToCheck.indexOf(".bmp")  > -1){
                                            $('#generateImage').append('<a class="example-image-link" href="' + baseUrl + "images/" + splitter[ctr] + '" data-lightbox="example-set" ><img class="example-image" src="' + baseUrl + "images/" + splitter[ctr] + '" height="150px" width="150px" /></a>');
                                        }else if(stringToCheck.indexOf(".mp3") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mpeg" />');
                                        }else if(stringToCheck.indexOf(".mp4") > -1 || stringToCheck.indexOf(".m4a") > -1 || stringToCheck.indexOf(".aac") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/mp4" />');
                                        }else if(stringToCheck.indexOf(".oga") > -1 || stringToCheck.indexOf(".ogg") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/ogg" />');
                                        }else if(stringToCheck.indexOf(".wav") > -1){
                                            $('#generateAudio').append('<audio id="audioPlayer" controls><source src="' + baseUrl + "audio/" + splitter[ctr] + '" type="audio/wav" />');
                                        }
                                        ctr++;
                                    }while(ctr < splitter.length-1)
                                  $('.PopUpWindowRep').bPopup({
                                      follow: [false, false], //x, y
                                      modalClose: false,
                                      onClose: function() { 
                                                    $('audio').each(function(){
                                                        this.pause(); // Stop playing
                                                        this.currentTime = 0; // Reset time
                                                    }); 
                                               }
                                  });
                              },
                              error: function()
                              {
                                  alert("Data Retrieval Failed.");
                              }        
                      });
                    }
                });
          });
    });
</script>