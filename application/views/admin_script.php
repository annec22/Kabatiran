<script type="text/javascript">
    //=====Bulletin function=====
    function copyTxt(){
        var bullText = document.bullForm.bullTxt.value;
        document.fbForm.msg.value += bullText;
        if($('#facebookCB').is(':checked')){
            $('#fbSubmit').click();
        } 
    }
   
    //=====

    
    function updateReports(){
        $.get("<?php echo base_url() ?>" + "reportIndex/", function(data) {
            $("#inbox_view").html(data);
            window.setTimeout(updateReports, 300000);
        });
    }
    
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    
    function IsLetter(letter) {
        var regex = /^[a-zA-Z]+$/;
        return regex.test(letter);
    }
        
    $(document).ready(function() {  
    updateReports();  
    
    setInterval(function() {
       $.ajax({
            url: "<?php echo base_url() . "checkAcc/" ?>",
            success: function(data)
            {
                if(data == 0){
                    alert("Your account has been deleted.");
                    $.ajax({url: "<?php echo base_url() . "logout/" ?>",});
                    window.location.replace("<?php echo base_url() . "main/"?>");
                }
            },
            error: function()
            {
                
            }
        });  
    }, 5000);
    var s = window.location;
    var style_url = s.protocol + "//" + s.host + "/" + s.pathname.split('/')[1] + "/admin-system/styles/pictures/";
    $('.crsXImage').attr("src", style_url+"x.png");

    $('#creationDate').attr("value", "<?php date_default_timezone_set('Hongkong'); echo date('Y-m-d H:i:s')?>");    
  
    
        $("ul.navList li").click(make_button_active);        

        /* For the popup of adding a new item*/
        
        $('.addNewAccountTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowAccount').bPopup({
                  modalClose: false,
            });
        });
        
        
        $('.addNewDirTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowDir').bPopup();
        });
        
        $('.changePwTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowChangePw').bPopup();
        });
        
        $('#accInfo').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowAccInfo').bPopup();
        });
        
        $('.editAcc').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowEditAccount').bPopup();
        });
        
        $('#no').click(function(){
           alert('no') ;
        });

        var oTable;
        
        var oAccTable = $('#accTable').dataTable({   
            "bAutoWidth": false,
            "aaSorting": [],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                $(nRow).children().attr('class', 'acc');
                return nRow;
             }
        });
        
        
        var oDirTable = $('#dirTable').dataTable({   
            "bAutoWidth": false,
            "aaSorting": [],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                $(nRow).children().attr('class', 'dir');
                return nRow;
             }
        });
        
        var oLogs = $('#logTable').dataTable({
            "aaSorting": [[ 0, "desc" ]], 
            "bAutoWidth": false,
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                $(nRow).children().attr('class', 'log');
                return nRow;
             }
        });
        
        $('#postTable').dataTable({
            "aaSorting": [[ 2, "desc" ]], 
            "bAutoWidth": false,
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                $(nRow).children().attr('class', 'bull');
                return nRow;
             }
        });

        var nEditingAcc = null;
        var nEditingDir = null;
               
            //======= HEADER COOKIES =====
            
            $(document).ready(function(){
                
                $('#AnewNavHome').click(function(){
                    $.removeCookie("test");
                });
                $('#logout').click(function(){
                    $.removeCookie("test");
                });
                $('#dm').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "accts");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#fc6749";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                    
                });
                $('#social').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "social");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#fc6749";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                });
                $('#contacts').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "contacts");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#fc6749";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                });
                $('#inbox').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "inbox");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#fc6749";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                });
                $('#loc').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "loc");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#fc6749";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                });
                $('#logs').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "logs");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#fc6749";
                    document.getElementById("newNavMaps").style.background="#2c312b";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                });
                $('#mapHaz').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "mapHaz");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#fc6749";
                    document.getElementById("mapsmenuHazard").style.background="#fc6749";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                    
                    
                });
                $('#maps').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "maps");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#fc6749";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#fc6749";
                    document.getElementById("mapsmenuDirectory").style.background="#2c312b";
                    google.maps.event.trigger(Googlemap, 'resize');
                    
                });
                $('#dir').click(function(){
                    $.removeCookie("test");
                    $.cookie("test", "dir");
//                    document.getElementById("newNavHome").style.background="#2c312b";
                    document.getElementById("newNavAccounts").style.background="#2c312b";
                    document.getElementById("newNavBulletin").style.background="#2c312b";
                    document.getElementById("newNavDirectory").style.background="#2c312b";
                    document.getElementById("newNavInbox").style.background="#2c312b";
                    document.getElementById("newNavLocations").style.background="#2c312b";
                    document.getElementById("newNavLogs").style.background="#2c312b";
                    document.getElementById("newNavMaps").style.background="#fc6749";
                    document.getElementById("mapsmenuHazard").style.background="#2c312b";
                    document.getElementById("mapsmenuIncident").style.background="#2c312b";
                    document.getElementById("mapsmenuDirectory").style.background="#fc6749";
                });           
            });
            
            
            
            
            //======= INFORMAPP ACCOUNT FUNCTION ======
            /**
            * Adding a new admin in the database
            *
            * @access   public
            * @param    none
            * @return   string
            * 
            * @author Abby Manio
            *
            */
           
            $(document).ready(function()
            {                                      
                $('#SaveAcc').click(function(){

                    var id = 0;
                    var uname = $('#user').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var fname = $('#first').val().trim().replace(/<(?:.|\n)*?>/gm, '');                   
                    var email = $('#email').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var init = $('#i').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var lname = $('#last').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var type = $('#adminType').val();
                    
                    if(uname == "" || fname == "" || init == ""  || lname == "" || email == ""){
                        alert("Each field is important. Please don't leave them blank.");
                        return false;         
                    }else if(IsLetter(uname) == false||IsLetter(fname) == false||IsLetter(init) == false||IsLetter(lname) == false){
                        alert("No special characters allowed");
                        return false
                    }else if(type == null){
                        alert("Please select an account type.");
                        return false;
                    }else if(IsEmail(email) == false){    
                        alert("Email is invalid");
                        return false;
                    }else{
                        $.ajax({
                            url: "<?php echo base_url() . "ifUsernameExist/" ?>",
                            type: 'POST',
                            data: {'username': uname},
                            dataType: 'JSON',
                            success: function(data)
                            {
                                if(data == "Y"){
                                    alert("Username already exists.");
                                    return false;
                                }else{
                                    $('#spinner').spin("modal");
                                    $.ajax({
                                        url: "<?php echo base_url() . "addAcc/" ?>",
                                        type: 'POST',
                                        data: {'id':id, 'uname':uname,'fname':fname, 'email':email, 'init':init,'lname':lname, 'type': type},
                                        dataType: 'JSON',
                                        success: function(data)
                                        {
                                            $('#accTable').dataTable().fnAddData([fname, init, lname, email, uname, type,
                                                '<button class="resetAccBtn" id="' + data + '" >Reset</button>','<a class="editAcc" href="" id="'+data+'" ><pre id="edit-opt">    </pre></a>',
                                                '<a class="deleteAcc" href="" id="' + data + '"><pre id="del-opt">    </pre></a>']);
                                            $('#user').val("");
                                            $('#pword').val(""); 
                                            $('#first').val("");
                                            $('#i').val("");
                                            $('#last').val("");
                                            $('#email').val("");

                                            $('#accTable').dataTable().fnPageChange( 'last' );
                                            alert("Successfully Added. Page will now refresh.");
                                            $('#spinner').spin(false);
                                            location.reload();
                                        },
                                        error: function()
                                        {
                                            alert("Saving Error.");
                                        }
                                    });  
                                }
                            },
                            error: function()
                            {
                                alert("Username Checking Error.");
                            }
                         });
                         return false;
                    }
                });

                /**
                * Clears the inputs in the div
                *
                * @access   public
                * @param    none
                * @return   none
                */ 
                $('#ClearAcc').click(function(){                    
                    $('#user').val("");
                    $('#pword').val(""); 
                    $('#first').val("");
                    $('#email').val("");
                    $('#i').val("");
                    $('#last').val("");

                });
                
                $('#accTable').on('click', 'a.deleteAcc' ,function(e) 
                {
                    e.preventDefault();
                    
                    var nRow = $(this).parents('tr')[0];
                    var id = $(this).attr('id');
                    var user = $('td#user'+id).attr('name');
                    
                    var r=confirm("Are you sure you want to delete "+user+"'s account?");
                    if (r==true)
                    {
                        $.ajax({
                            url: "<?php echo base_url() ?>" + "deleteAcc",
                            type: 'POST',
                            data: {'id':id, 'user':user},
                            dataType: 'JSON',
                            success: function(data)
                            {
                                if(data)
                                {
                                    alert("Successfully deleted the data.");
                                    oAccTable.fnDeleteRow(nRow);
                                }
                            },
                            error: function()
                            {
                                alert("Error.");
                            }
                        });
                    }
                });
            
                $('.editAcc').click (function() 
                {
                    var id = $(this).attr('id');
                    $.ajax({
                            url: "<?php echo base_url() ?>" + "getAcc",
                            type: 'POST',
                            data: {'adminID':id},
                            dataType: 'JSON',
                            success: function(data)
                            {
                                $('#editId').val("");
                                $('#firstEdit').val("");
                                $('#iEdit').val("");
                                $('#lastEdit').val("");
                                $('#emailEdit').val("");
                                $('#userEdit').val("");
                                
                                var splitter = data.split("|");

                                $('#editId').val(id);
                                $('#firstEdit').val(splitter[0]);
                                $('#iEdit').val(splitter[1]);
                                $('#lastEdit').val(splitter[2]);
                                $('#emailEdit').val(splitter[3]);
                                $('#userEdit').val(splitter[4]);
                                $('#userHolder').val(splitter[4]);
                                $('#adminTypeEdit').val(splitter[5]);
                            },
                            error: function()
                            {
                                alert("Error.");
                            }
                    });
                    
                    $('#SaveAccEdit').click(function(){

                        var id =  $('#editId').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var uname = $('#userEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var fname = $('#firstEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');                   
                        var email = $('#emailEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var init = $('#iEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var lname = $('#lastEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var oldUname = $('#userHolder').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                        var type = $('#adminTypeEdit').val().trim().replace(/<(?:.|\n)*?>/gm, '');

                        if(uname == "" || fname == "" || init == ""  || lname == "" || type == null || email == ""){
                            alert("Each field is important. Please don't leave them blank.");
                            return false;         
                        }else if(IsLetter(uname) == false||IsLetter(fname) == false||IsLetter(init) == false||IsLetter(lname) == false){
                            alert("No special characters allowed");
                            return false
                        }else if(IsEmail(email) == false){    
                            alert("Email is invalid");
                            return false;
                        }else if(uname == oldUname){
                            $.ajax({
                                url: "<?php echo base_url() . "editAcc/" ?>",
                                type: 'POST',
                                data: {'id':id, 'uname':uname,'fname':fname, 'email':email, 'init':init,'lname':lname, 'type': type},
                                dataType: 'JSON',
                                success: function(data)
                                {
                                    alert("Edit Successful. Page will now Reload.");
                                        
                                    $('#editId').val("");
                                    $('#firstEdit').val("");
                                    $('#iEdit').val("");
                                    $('#lastEdit').val("");
                                    $('#emailEdit').val("");
                                    $('#userEdit').val("");
                                    
                                    location.reload();
                                },
                                error: function()
                                {
                                    alert("Edit Saving Error.");
                                }
                            });  
                        }else{
                            $.ajax({
                                url: "<?php echo base_url() . "ifUsernameExist/" ?>",
                                type: 'POST',
                                data: {'username': uname},
                                dataType: 'JSON',
                                success: function(data)
                                {
                                    if(data == "Y"){
                                        alert("Username already exists.");
                                        return false;
                                    }else{
                                        $.ajax({
                                            url: "<?php echo base_url() . "editAcc/" ?>",
                                            type: 'POST',
                                            data: {'id':id, 'uname':uname,'fname':fname, 'email':email, 'init':init,'lname':lname, 'type': type},
                                            dataType: 'JSON',
                                            success: function(data)
                                            {
                                                $('#editId').val("");
                                                $('#firstEdit').val("");
                                                $('#iEdit').val("");
                                                $('#lastEdit').val("");
                                                $('#emailEdit').val("");
                                                $('#userEdit').val("");
                                                alert("Edit Successful. Page will now Reload.");
                                                location.reload();
                                            },
                                            error: function()
                                            {
                                                alert("Edit Saving Error.");
                                            }
                                        });  
                                    }
                                },
                                error: function()
                                {
                                    alert("Username Checking Error.");
                                }
                             });
                             return false;
                        }
                    });
                });
                            
                 //Reset password Script
                $('#accTable').on ('click', 'button.resetAccBtn',function(e){
                   e.preventDefault();

                   var id = $(this).attr('id');
                   var email = $('td#email'+id).attr('name');
                   var user = $('td#user'+id).attr('name');

                   var r=confirm("Are you sure you want to reset "+user+"'s password?");
                   if (r==true)
                   {
                        $('#spinner').spin("modal");
                        $.ajax({
                            url: "<?php echo base_url() . 'resetPw' ?>",
                            type: "POST",
                            data: {'id': id, 'email':email, 'user': user},
                            success: function() {
                                $("#spin_modal_overlay").remove();
                                $('#spinner').spin(false);
                                if (email == "" || email == null) {
                                    alert("Unable to send message. Email has no value. Page will now refresh");
                                    location.reload();
                                } else {
                                    alert("Message Sent to the User's Email.");
                                    location.reload();
                                }
                            },error:function(){
                              alert("Error Resetting");  
                            }
                        });
                   }
               });
            });
            
            //======= INFORMAPP DIRECTORY FUNCTION ======
            /**
            * Allows the user to edit the row by changing the values in the cells into text fields.
            *
            * @access   public
            * @param    string
            * @return   string
            */
            function editDirRow(oTable, nRow)
            {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var id = aData[0];
                $.ajax({
                        url: "<?php echo base_url() ?>" + "getDir/",
                        type: 'POST',
                        data: {'id':id},
                        dataType: 'JSON',
                        success: function(data)
                        {
                            jqTds[0].innerHTML = '<input id="ageId" value="'+aData[0]+'" type="text" disabled />';
                            jqTds[1].innerHTML = '<input id="conNum" value="'+aData[1]+'" type="text" required />';
                            jqTds[2].innerHTML = '<input id="specifics" value="'+aData[2]+'" type="text" required />';                     
                            jqTds[3].innerHTML = '<a class="editDir" href="">Save</a>';
                            jqTds[4].innerHTML = '<a class="cancelDir" href="">Cancel</a>';
                        }
                });
            }
            
            /**
            * Restores the row that was edited without having to redraw the table.
            *
            * @access   public
            * @param    string
            * @return   string
            */
            function resDirRow(oTable, nRow)
            {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = aData[0];
                jqTds[1].innerHTML = aData[1];
                jqTds[2].innerHTML = aData[2];
                jqTds[3].innerHTML = '<a class="editDir" href=""><pre id="edit-opt">    </pre></a>';
                jqTds[4].innerHTML = '<a class="deleteDir" href=""><pre id="del-opt">    </pre></a>';
            }
            
            /**
            * Saves the edited data
            *
            * @access   public
            * @param    string
            * @return   string
            */
            function saveDirRow (oTable, nRow)
            {
                var jqInputs = $('input', nRow);
                
                var id = jqInputs[0].value;
                var contact = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
                var specifics = jqInputs[2].value.trim().replace(/<(?:.|\n)*?>/gm, '');
                var edit = '<a class="editDir" href=""><pre id="edit-opt">    </pre></a>';
                var del = '<a class="deleteDir" href=""><pre id="del-opt">    </pre></a>';
            
                if(contact == "" || specifics == "" ){
                    alert("Each field is important. Please don't leave them blank.");
                }else{
                   
                    $.ajax({
                        url: "<?php echo base_url() ?>" + "editDir/",
                        type: 'POST',
                        data: {'id':id, 'contact':contact, 'specifics':specifics},
                        dataType: 'JSON',
                        success: function(data)
                        {
                            alert("Successfully Edited");
                            oTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                            oTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                            oTable.fnUpdate($('<div/>').text(jqInputs[2].value).html(), nRow, 2, false);
                            oTable.fnUpdate(edit, nRow, 3, false);
                            oTable.fnUpdate(del, nRow, 4, false);
                            oTable.fnDraw();								
                        }, error: function() {
                                
                                alert("Failed saving edited data.");
                           
                            }
                        });
                        }                 
                    resRow(oDirTable, nRow);
                }
           
           
         //======= INFORMAPP CHANGE PASSWORD AND ACCOUNT INFORMATION FUNCTION ======  
         /**
            * Adding a new client default in the database
            *
            * @access   public
            * @param    none
            * @return   string
            */
            $(document).ready(function()
            {                                      
                $('#SavePw').click(function(){

                    var cpuserid = $('#cPwUser').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var oldPassword = $('#oPw').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var newPassword = $('#nPw').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    var rePassword = $('#rPw').val().trim().replace(/<(?:.|\n)*?>/gm, '');
                    
                    if(newPassword == "" || rePassword == "" || oldPassword == ""){
                        alert("Each field is important. Please don't leave them blank.");
                        return false;
                    }else if(IsLetter(oldPassword) == false||IsLetter(newPassword) == false||IsLetter(rePassword) == false){
                        alert("No special characters allowed");
                        return false;
                    }else if(oldPassword == newPassword && oldPassword == rePassword){
                        alert("Your old password and new password are the same");   
                        return false;
                    }else{
                       $.ajax({
                            url: "<?php echo base_url() ?>" + "changePassword/",
                            type: 'POST',
                            data: {'cpuserid':cpuserid, 'oldPassword':oldPassword, 'newPassword':newPassword, 'rePassword':rePassword},
                            dataType: 'JSON',
                            success: function(data)
                            {
                                $('#rPw').val("");
                                $('#oPw').val("");
                                $('#nPw').val(""); 
                                alert(data);
                            },
                            error: function()
                            {
                                alert("Update Error.");
                            }
                        }); 
                    }
                                $('#rPw').val("");
                                $('#oPw').val("");
                                $('#nPw').val("");
                });
                
                /**
                * Clears the inputs in the div
                *
                * @access   public
                * @param    none
                * @return   none
                */ 
                $('#ClearPw').click(function(){                    
                    $('#rPw').val("");
                    $('#oPw').val("");
                    $('#nPw').val(""); 

                });
                
                $('#accInfo').click(function(){
                    $.ajax({
                        url: "<?php echo base_url() ?>" + "getadminID/",
                        success: function(data)
                        {
                            var adminID = data.trim().replace(/\"/g,'');

                            $.ajax({
                                url: "<?php echo base_url() ?>" + "getAcc/",
                                type: 'POST',
                                data: {'adminID':adminID},
                                dataType: 'JSON',
                                success: function(data)
                                {
                                    var splitter = data.split("|");
                                    $('#fullName').text(splitter[0] + " " + splitter[1] + " " + splitter[2]);
                                    $('#emailinfo').text(splitter[3]);
                                    $('#usernameinfo').text(splitter[4]);
                                    $('#typeinfo').text(splitter[5]);
                                },
                                error: function()
                                {
                                    alert("Unable to retrieve account information");
                                }
                            });
                        },
                        error: function()
                        {
                            alert("Unable to get id of the admin.");
                        }
                    });
                });
            });
            
            
             //======= INFORMAPP BULLETIN FUNCTION ======  
            $(document).ready(function()
            {  
                $('#twitterCB').click(function(){
                    if( $(this).is(':checked') ) {
                        $('#bullTxt').attr("maxlength",140);
                    }else{
                        $('#bullTxt').attr("maxlength",500);
                    }
                });
                
                $('#bulletinBtn').click(function(){
                    var bullTxt = $('#bullTxt').val().trim().replace(/<(?:\n)*?>/gm, '');
                    var date;
                    var province = $('#bullProv').val();
                    
                    if(bullTxt == ""){
                        alert("Each field is important. Please don't leave them blank.");
                    }else{
                        $.ajax({
                            url: "<?php echo base_url() ?>" + "getServerDateTime/",
                            success: function(data)
                            {
                                date = data.trim().replace(/\"/g,'');
                                $('#spinner').spin("modal");
                                $.ajax({
                                    url: "<?php echo base_url() ?>" + "addPost/",
                                    type: 'POST',
                                    data: {'bullTxt':bullTxt, 'date':date, 'province':province},
                                    dataType: 'JSON',
                                    success: function(data)
                                    {
                                        if(!$('#facebookCB').is(':checked')){
                                            location.reload();
                                        } 
                                        alert("Post Success. Please wait for the page to reload after clicking OK."); 
                                        $('#bullTxt').val("");
                                        $('#fbtxt').val("");   
                                        
                                    },
                                    error: function()
                                    {
                                        alert("Post Failed.");
                                    }
                                }); 
                            },
                            error: function()
                            {
                                alert("Post Failed.");
                            }
                        });
                        if($('#twitterCB').is(':checked')){
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "tweetPost",
                                type: 'POST',
                                data: {'bullTxt':bullTxt},
                                dataType: 'JSON',
                                success: function(data){
                                        alert("Successfully Tweeted.");
                                },
                                error: function(){
                                        alert(bullTxt+" error");
                                }
                            });
                        }
                    }
                    $('#bullTxt').val("");
                    $('#fbtxt').val("");
                });
                
              $("#deleteBullButton").click(function() {
                    var mergedDeleteID = getCheckCount();

                    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                    if(mergedDeleteID == ","){
                        alert('Please check at least one checkbox');
                    }else{
                        var r=confirm("Are you sure you want to delete the post/s?");
                        if (r==true)
                        {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "deleteBulletin/", 
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
                
                $('#select-allBulletin').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.checkmeBulletin').each(function() {
                            this.checked = true;                        
                        });
                    }else if(!this.checked){
                        $('.checkmeBulletin').each(function() {
                            this.checked = false;                        
                        });
                    }
                });

                $('.checkmeBulletin').click(function(event) {   
                    if(!this.checked){
                        $('#select-allBulletin').each(function() {
                            this.checked = false;                        
                        });
                    }
                });
            });
 
          //===== LOGS FUNCTION =====
          $(document).ready(function()
          {  
            $("#deleteLogButton").click(function() {
                  var mergedDeleteID = getCheckCount();

                  /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                  if(mergedDeleteID == ","){
                      alert('Please check at least one checkbox');
                  }else{
                        var r=confirm("Are you sure you want to delete the log/s?");
                        if (r==true)
                        {
                            $('#spinner').spin("modal");
                            $.ajax({
                                  url: "<?php echo base_url() ?>" + "deleteLog/", 
                                  type: 'POST',
                                  data: {'mergedDeleteID': mergedDeleteID},
                                  dataType: 'JSON',
                                  success: function(data) {
                                      alert(data);
                                      $("#spin_modal_overlay").remove();
                                      $('#spinner').spin(false);
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
            
            $('#select-allLogs').click(function(event) {   
                if(this.checked) {
                    // Iterate each checkbox
                    $('.checkmeLog').each(function() {
                        this.checked = true;                        
                    });
                }else if(!this.checked){
                    $('.checkmeLog').each(function() {
                        this.checked = false;                        
                    });
                }
            });
            
            $('.checkmeLog').click(function(event) {   
                if(!this.checked){
                    $('#select-allLogs').each(function() {
                        this.checked = false;                        
                    });
                }
            });
        });
    });
</script>
