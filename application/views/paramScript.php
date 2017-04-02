<script type="text/javascript">
    /*
     * @author: Christopher Lance S. Tungcul
     * Script used for the following modules of adminitrator system:
     *      -Database module
     *      -Directory module
     *      -Directory maps 
     * script executes once the page DOM is ready
    */
    $(document).ready(function() {
        /*
         * Checks if an input is a decimal number or not
         * @param {type} num
         * @returns {@exp;regex@call;test}
         */
        function IsNumber(num) {
            var regex = /^\d+(\.\d{1,2})?$/;
            return regex.test(num);
        }

        function IsLetter(letter) {
            var regex = /^[a-zA-Z]+$/;
            return regex.test(letter);
        }        
    
        /*
         * Bind on-change events for the dependent combo boxes
         * using AJAX to retrieve data
         */
        $('#contactCatID').on('change', function() {
            var categoryID = $('#contactCatID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (categoryID === "") {
                $('#contactAgencyID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFAgency/",
                    type: 'POST',
                    data: {'categoryID': categoryID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#contactAgencyID').empty();                        
                        $('#contactAgencyID').append('<option value="">Choose Agency</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#contactAgencyID').append('<option value="' + data[ctr].agencyID + '">' + data[ctr].agencyName + '</option>');
                        }                        
                    }, error: function() {
                        alert('Error in retrieving agency information for agencies table');
                    }
                });
            }
        });                        
        $('#contactAgencyID').on('change', function(){
            var agencyID = $('#contactAgencyID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if(agencyID === ""){                
            } else {
                $.ajax({
                url: "<?php echo base_url() ?>" + "getAgency/",
                type: 'POST',
                data: {'id': agencyID},
                dataType: 'JSON',
                success: function(data){
                    $('#contactAgencyProv').val(data[0].province);
                    $('#contactAgencyMun').val(data[0].municipality);
                    $('#contactAgencyBrgy').val(data[0].barangay);
                },
                error: function(){}
                });
            }
        });
        $('#brgyProvID').on('change', function() {
            var provinceID = $('#brgyProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (provinceID === "") {
                $('#brgyMunID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFMun/",
                    type: 'POST',
                    data: {'provinceID': provinceID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#brgyMunID').empty();
                        $('#brgyMunID').append('<option value=""></option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#brgyMunID').append('<option value="' + data[ctr].muniCityID + '">' + data[ctr].name + '</option>');
                        }
                    }, error: function() {
                        alert('Error in retrieving province information for province table');
                    }
                });
            }
        });
        $('#aCatID').on('change', function() {
            var category = document.getElementById("aCatID");
            var municipality = document.getElementById("aCityMunID");
            if(municipality.options[municipality.selectedIndex] !== undefined){
                var agencyName = category.options[category.selectedIndex].text + " " + municipality.options[municipality.selectedIndex].text;
                $('#aLName').val(agencyName);
            } else {                
            }            
        });
        $('#aCityMunID').on('change', function() {
            var category = document.getElementById("aCatID");
            var municipality = document.getElementById("aCityMunID");
            var agencyName = category.options[category.selectedIndex].text + " " + municipality.options[municipality.selectedIndex].text;
            $('#aLName').val(agencyName);
        });
        $('#aEProvID').on('change', function() {
            var provinceID = $('#aEProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (provinceID === "") {
                $('#aECityMunID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFMun/",
                    type: 'POST',
                    data: {'provinceID': provinceID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#aECityMunID').empty();
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#aECityMunID').append('<option value="' + data[ctr].muniCityID + '">' + data[ctr].name + '</option>');
                        }
                    }, error: function() {
                        alert('Error in retrieving province information for province table');
                    }
                });
            }
        });
        $('#aProvID').on('change', function() {
            var provinceID = $('#aProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (provinceID === "") {
                $('#aCityMunID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFMun/",
                    type: 'POST',
                    data: {'provinceID': provinceID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#aCityMunID').empty();
                        
                        $('#aCityMunID').append('<option value="">Choose municipality</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#aCityMunID').append('<option value="' + data[ctr].muniCityID + '">' + data[ctr].name + '</option>');
                        }                         
                    }, error: function() {
                        alert('Error in retrieving province information for province table');
                    }
                });
            }
        });
        $('#aCityMunID').on('change', function(){            
            var municipalityID = $('#aCityMunID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (municipalityID === ""){
                $('#aBarangayID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFBrgy/",
                    type: 'POST',
                    data: {'munCityID': municipalityID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#aBarangayID').empty();
                        $('#aBarangayID').append('<option value="">Choose barangay</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#aBarangayID').append('<option value="' + data[ctr].idbarangay + '">' + data[ctr].name + '</option>');
                        }
                    }, error: function() {
                        alert('Error in retrieving municipality information for municipality_city table');
                    }
                    
                });
            }
        });
        $('#aECityMunID').on('change', function(){            
            var municipalityID = $('#aECityMunID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (municipalityID === ""){
                $('#aBarangayID').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFBrgy/",
                    type: 'POST',
                    data: {'munCityID': municipalityID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#aEBarangayID').empty();
                        $('#aEBarangayID').append('<option value="">Choose barangay</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#aEBarangayID').append('<option value="' + data[ctr].idbarangay + '">' + data[ctr].name + '</option>');
                        }
                    }, error: function() {
                        alert('Error in retrieving municipality information for municipality_city table');
                    }
                    
                });
            }
        });
        
        $('#ProvDir').on('change', function() {
            var provinceID = $('#ProvDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munCityDirHolder = $('#munCityDirHolder').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (provinceID === "") {
                $('#munCityDir').empty();                
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFMun/",
                    type: 'POST',
                    data: {'provinceID': provinceID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#munCityDir').empty();
                        $('#munCityDir').append('<option value="">Choose Municipality</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#munCityDir').append('<option value="' + data[ctr].muniCityID + '">' + data[ctr].name + '</option>');
                        }
                        $('#munCityDir').val(munCityDirHolder);
                        $('#munCityDir').trigger('change');
                    }, error: function() {
                        alert('Error in retrieving municipality information for municipality_city table');
                    }                    
                });
            }
        });
        $('#munCityDir').on('change', function() {            
            var munCityID = $('#munCityDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var brgyDirHolder = $('#brgyDirHolder').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            if (munCityID === "") {
                $('#brgyDir').empty();
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "getFBrgy/",
                    type: 'POST',
                    data: {'munCityID': munCityID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#brgyDir').empty();
                        $('#brgyDir').append('<option value="">Choose barangay</option>');
                        for (var ctr = 0; ctr < data.length; ctr++) {
                            $('#brgyDir').append('<option value="' + data[ctr].idbarangay + '">' + data[ctr].name + '</option>');
                        }
                        $('#brgyDir').val(brgyDirHolder);                        
                    }, error: function() {
                        alert('Error in retrieving municipality information for municipality_city table');
                    }
                });
            }
        });
        /*         
         * binding click events for the popup boxes           
         */
        $('.addNewAgencyTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowAgency').bPopup({
                modalClose: false
            });
        });
        $('.addNewProvinceTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowProvince').bPopup({
                modalClose: false
            });
        });
        $('.addNewCityMunTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowCityMun').bPopup({
                modalClose: false
            });
        });
        $('.addNewCategoryTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowCategory').bPopup({
                modalClose: false
            });
        });
        $('.addNewEstabTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowEstab').bPopup({
                modalClose: false
            });
        });
        $('.addNewBrgyTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowBrgy').bPopup({
                modalClose: false
            });
        });
        $('.addNewContactTrigger').bind('click', function(e) {
            e.preventDefault();
            $('#contactLName').val("");
            $('#cSpecificsLName').val("");
            $('.PopUpWindowContact').bPopup({
                modalClose: false
            });
        });
        $('.addNewAccidentTypeTrigger').bind('click', function(e) {
            e.preventDefault();
            $('.PopUpWindowAccidentType').bPopup({
                modalClose: false
            });
        });
        /*
         * Binding click events for clearing inputs
         */
        $('#clearAccidentType').on('click', function(){
            $('#aTypeName').val('');
        });
        $('#clearProvince').on('click', function(){
            $('#pLName').val('');
        });
        $('#clearCityMun').on('click', function(){
            $('#cMLName').val('');
            $('#munProvID').val('');
        });        
        $('#clearBrgy').on('click', function(){
            $('#brgyLName').val('');
            $('#brgyLX').val('');
            $('#brgyLY').val('');
            $('#brgyProvID').val('');
            $('#brgyMunID').val('');
        });
        $('#clearEType').on('click', function(){
            $('#eTypeLName').val('');            
        });
        $('#clearCategory').on('click', function(){
            $('#catLName').val('');            
        });
        $('#clearAgency').on('click', function(){
            $('#aCatID').val('');
            $('#aProvID').val('');
            $('#aLName').val('');
            $('#aAddLName').val('');
            $('#aEAddLName').val('');
            $('#aBarangayID').empty();
            $('#aProvID').trigger('change');         
        });
        $('#clearContacts').on('click', function(){
            $('#contactLName').val("");
            $('#cSpecificsLName').val("");
            $('#contactCatID').val("");
            $('#contactAgencyID').empty();
        });        
        /*
         * Binding click event for redirection to contacts.xml         
         */
        $('#exportContact').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url() ?>" + "exportContacts/",
                type: 'POST',                
                dataType: 'JSON',
                success:function(data){
                    if(data){
                        location.href = "<?php echo base_url()?>/uploads/contacts.xml";
                    }
                },
                error:function(){                    
                }
            });
        });
        /*          
         * variable  declarations: dataTable row holders         
         */
        var nEditingProv = null,
                nEditingMun = null,
                nEditingBrgy = null,
                nEditingEstab = null,
                nEditingCat = null,
                nEditingAgency = null,
                nEditingContact = null,
                nEditingAType = null,
                aRowData = null;
        /*          
         * variable  declarations: dataTable holders         
         */
        var oAgencyTable = $('#agencyTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oProvTable = $('#provTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oMunTable = $('#munTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oBrgyTable = $('#brgyTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oEstabTable = $('#estabTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oCategoryTable = $('#categoryTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oContactsTable = $('#contactTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        }),
        oAccidentTypeTable = $('#accidentTypeTable').dataTable({
            "bAutoWidth": false,
            "aaSorting": []
        });
        /*
         * binding click events for the save function of dataTables        
         */
        $('#saveBrgy').click(function() {
            var id = 0;
            var brgyName = $('#brgyLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var xCoordinate = $('#brgyLX').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var yCoordinate = $('#brgyLY').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munCity = $('#brgyMunID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var province = $('#brgyProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (brgyName === "" || xCoordinate === "" || yCoordinate === "" || munCity === "" || province === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            }  else if(brgyName.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(brgyName.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!xCoordinate.match(/^[0-9.]+$/) || !yCoordinate.match(/^[0-9.]+$/)){
                alert("INVALID INPUT. Your input should not contain letter and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddBrgy/",
                    type: 'POST',
                    data: {'id': id, 'brgyName': brgyName, 'xCoordinate': xCoordinate, 'yCoordinate': yCoordinate,
                        'munCity': munCity},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#brgyTable').dataTable().fnAddData([data, brgyName, xCoordinate, yCoordinate,
                            '<a class="editBrgy" href=""><pre id="edit-opt">    </pre></a>', '<a class="deleteBrgy" href=""><pre id="del-opt">    </pre></a>']);
                        alert('Adding new barangay information successful');
                    },
                    error: function() {
                        alert("Error in adding new barangay into the database");
                    }
                });
            }
        });
        $('#saveContacts').click(function() {        
            var contactNumber = $('#contactLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var specifics = $('#cSpecificsLName').val().trim().replace(/<(?:.|\n)*?>/gm, '') + "";
            var category = $('#contactCatID').val().trim().replace(/<(?:.|\n)*?>/gm, '');     
            var agencyName = $('#contactAgencyID').val().trim().replace(/<(?:.|\n)*?>/gm, '');                               
            var province = $('#contactAgencyProv').val().trim().replace(/<(?:.|\n)*?>/gm, '');;
            var municipality = $('#contactAgencyMun').val().trim().replace(/<(?:.|\n)*?>/gm, '');;
            var barangay = $('#contactAgencyBrgy').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            if (category === "" || contactNumber === "" || specifics === "" || agencyName === "") {
                alert("Each field is important.Please don't leave them blank.");
                return false;
            } else if(specifics.length < 3 || contactNumber.length < 3){
                alert("INVALID INPUT. specifics and contact number should not be SHORTER than 3 characters");
                return false;
            } else if(specifics.length > 50 || contactNumber.length > 20){
                alert("INVALID INPUT. Your specifics should not be LONGER than 50 characters. Contact number should not be LONGER than 20 characters");
                return false;
            } else {
                if (IsNumber(contactNumber)) {
                    $.ajax({
                        url: "<?php echo base_url() ?>" + "pAddDirectory/",
                        type: 'POST',
                        data: {'contact': contactNumber, 'specifics': specifics,'agencyID': agencyName, 'establishmentID': ''},
                        dataType: 'JSON',
                        success: function(data) {
                            $('#contactTable').dataTable().fnAddData([data, contactNumber, specifics,
                                '<a class="editContact" href=""><pre id="edit-opt">     </pre></a>', '<a class="deleteContact" href=""><pre id="del-opt">    </pre></a>']);
                            $('#contactLName').val("");
                            $('#cSpecificsLName').val("");                            
                            var redirect = confirm("Adding new contact information successful. Press OK to plot its location otherwise Cancel.");
                            if (redirect === true){                                
                                $('#dir').click();                                                                
                                $('#specDir').val(specifics);                                
                                //$('#agencyListDir').val(agencyName);
                                $('#eTypeDir').val(category);
                                $('#ProvDir').val(province);                                
                                $('#munCityDirHolder').val(municipality);
                                $('#brgyDirHolder').val(barangay);
                                $('#agencyListDirHolder').val(agencyName);
                                $('#dirIDHolder').val(data);                                
                                $('#ProvDir').trigger('change');                                
                            }
                        }, error: function() {
                            alert('Error in adding new contact information');
                        }
                    });
                } else {
                    alert('INVALID INPUT. Contacts should only contain numbers');
                    return false;
                }
            }
        });
        $('#saveEType').click(function() {
            var id = 0;
            var eType = $('#eTypeLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (eType === "") {
                alert("Each field is important.Please don't leave them blank.");
            } else if(eType.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(eType.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!eType.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddEType/",
                    type: 'POST',
                    data: {'id': id, 'eType': eType},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#estabTable').dataTable().fnAddData([data, eType,
                            '<a class="editEstab" href=""><pre id="edit-opt">     </pre></a>', '<a class="deleteEstab" href=""><pre id="del-opt">    </pre></a>']);
                        $('#eTypeLName').val("");
                        alert('Adding new establishment type successful');
                    },
                    error: function() {
                        alert("Error in adding establishment type information");
                    }
                });
            }
        });
        $('#saveCategory').click(function() {
            var id = 0;
            var category = $('#catLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (category === "") {
                alert("Each field is important.Please don't leave them blank.");
            } else if(category.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(category.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!category.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddCat/",
                    type: 'POST',
                    data: {'id': id, 'category': category},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#categoryTable').dataTable().fnAddData([data, category,
                            '<a class="editCategory" href=""><pre id="edit-opt">    </pre></a>', '<a class="deleteCategory" href=""><pre id="del-opt">    </pre></a>']);
                        $('#catLName').val("");                        
                        alert('Adding new adding new agency category successful');
                    },
                    error: function() {
                        alert("Error in adding new agency category into the database");
                    }
                });
            }
        });
        $('#saveCityMun').click(function() {
            var id = 0;
            var cityMunName = $('#cMLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munProvID = $('#munProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');

            if (cityMunName === "" || munProvID === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(cityMunName.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(cityMunName.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!cityMunName.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddMun/",
                    type: 'POST',
                    data: {'id': id, 'cityMunName': cityMunName, 'munProvID': munProvID},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#munTable').dataTable().fnAddData([data, cityMunName,
                            '<a class="editMun" href=""><pre id="edit-opt">    </pre></a>', '<a class="deleteMun" href=""><pre id="del-opt">    </pre></a>']);
                        $('#pLName').val("");

                        //oTable.fnPageChange('last');
                        alert('Adding new municipality successful');
                    },
                    error: function() {
                        alert("Error in adding new municipality into the database.");
                    }
                });
            }
        });
        $('#saveProvince').click(function() {
            var id = 0;
            var provinceName = $('#pLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            if (provinceName === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(provinceName.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(provinceName.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!provinceName.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddProv/",
                    type: 'POST',
                    data: {'id': id, 'provinceName': provinceName},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#provTable').dataTable().fnAddData([data, provinceName,
                            '<a class="editProv" href=""><pre id="edit-opt">    </pre></a>', '<a class="deleteProv" href=""><pre id="del-opt">    </pre></a>']);
                        $('#pLName').val("");                        
                        alert('Adding new province successful');
                        location.reload();
                    },
                    error: function() {
                        alert("Error in adding new province into the database.");
                    }
                });
            }
        });
        $('#saveAgency').click(function() {
            var id = 0;            
            var agencyName = $('#aLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var address = $('#aAddLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var email = $('#aEAddLName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var category = $('#aCatID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munCity = $('#aCityMunID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var province = $('#aProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var barangay = $('#aBarangayID').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            var cMember = $('input[name="chkbxCMemberY"]:checked').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            if (category === "" || agencyName === "" || address === "" || email === "" || province === "" || munCity === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            }  else if(agencyName.length < 3 || address.length < 3 || email.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(agencyName.length > 50 || address.length > 50 || email.length > 254){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!agencyName.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Agency name should not contain special characters");
                return false;
            } else if (email.indexOf('.com') === -1 && email.indexOf('@') === -1){
                alert('Your email format is invalid');
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddAgency/",
                    type: 'POST',
                    data: {'id': id, 'agencyName': agencyName, 'address': address, 'email': email,
                        'munCity': munCity, 'province': province, 'cMember': cMember, 'category': category, 
                        'barangay': barangay
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        $('#agencyTable').dataTable().fnAddData([data, agencyName, cMember, email, address,
                            '<a class="genAuth" href=""><pre id="gen-opt">     </pre></a>',
                            '<a class="editAgency" href=""><pre id="edit-opt">    </pre></a>',
                            '<a class="deleteAgency" href=""><pre id="del-opt">    </pre></a>']);
                        $('#aLName').val("");                        
                        alert("Successfully Added");
                    },
                    error: function() {
                        alert("Error in adding new agency into the database.");
                    }
                });
            }
        });
        $('#saveEAgency').click(function() {
            var agencyID = $('#aEAgencyID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var agencyName = $('#aELName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var address = $('#aAddELName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var categoryID = $('#aECatID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var council_member = $('input[name="chkbxCMemberY"]:checked').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var emailAdd = $('#aEAddELName').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var municipality = $('#aECityMunID').val().trim().replace(/<(?:.|\n){*?>/gm, '');
            var province = $('#aEProvID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var barangay = $('#aEBarangayID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if(agencyID === "" || agencyName === "" || address === "" || categoryID === "" || emailAdd === "" 
               || municipality === ""|| province === "" || barangay === ""){
               alert("All fields other than barangay is required.");                               
            } else {
                $.ajax({
                url: "<?php echo base_url() ?>" + "editAgency",
                type: "POST",
                data: {'agencyID': agencyID, 'agencyName': agencyName, 'address': address,
                    'categoryID': categoryID, 'council_member': council_member, 'emailAdd': emailAdd,
                    'municipality': municipality, 'province': province,'barangay': barangay},
                dataType: 'JSON',
                success: function() {
                    var jqTds = $('>td', aRowData);
                    jqTds[0].innerHTML = agencyID;
                    jqTds[1].innerHTML = agencyName;
                    jqTds[2].innerHTML = council_member;
                    jqTds[3].innerHTML = emailAdd;
                    jqTds[4].innerHTML = address;
                    jqTds[5].innerHTML = '<a class="genAuth" href=""><pre id="gen-opt">     </pre></a>';
                    jqTds[6].innerHTML = '<a class="editAgency" href=""><pre id="edit-opt">    </pre></a>';                    
                    jqTds[7].innerHTML = '<a class="deleteAgency" href=""><pre id="del-opt">    </pre></a>';
                }, error: function() {
                    alert('Error in editing');
                }
            });
            }            
        });
        $('#SaveDir').click(function() {
            var id = 0;
            var dirID = $('#dirIDHolder').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var agency = $('#agencyListDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var contact = $('#numDir :selected').text().trim().replace(/<(?:.|\n)*?>/gm, '');
            var specifics = $('#specDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var description = $('#dirDescription').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var name = $('#estabNameDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var eType = $('#eTypeDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munCity = $('#munCityDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var brgy = $('#brgyDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var x = $('#xCoordinate').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var y = $('#yCoordinate').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (agency === "" || description === "" || eType === "" || x === "" || y === "" || name === "") {                
                alert("Each field is important. Please don't leave them blank.");
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddLocation/",
                    type: 'POST',
                    data: {'locationID': id, 'muniCityID': munCity, 'brgy': brgy, 'xCoordinate': x, 'yCoordinate': y},
                    dataType: 'JSON',
                    success: function(data)
                    {
                        var locationID = data;
                        $.ajax({
                            url: "<?php echo base_url() ?>" + "pAddEOffice/",
                            type: 'POST',
                            data: {'name': name, 'description': description, 'esTypeID': eType, 'locationID': locationID, 'agencyID': agency},
                            dataType: 'JSON',
                            success: function(data) {
                                var estabID = data;
                                if (contact !== "" && specifics !== "") {
                                    $.ajax({
                                        url: "<?php echo base_url() ?>" + "editDirectory/",
                                        type: 'POST',
                                        data: {'directoryID': dirID,'establishmentID': estabID, 'contactNo': contact, 'specifics': specifics},
                                        dataType: 'JSON',
                                        success: function() {
                                            $.ajax({
                                                url: "<?php echo base_url() ?>" + "getEstabO/",
                                                type: 'POST',
                                                data: {'estabID': eType},
                                                dataType: 'JSON',
                                                success: function(data) {
                                                    alert('Adding new directory successful');
                                                    marker = L.icon({
                                                        iconUrl: "<?php echo base_url() ?>" + "images/markers/" + data[0].classification + ".png",
                                                        iconSize: [50, 50] // size of the icon                        
                                                    });
                                                    L.marker([y, x], {icon: marker}).addTo(map);
                                                    $('#dirIDHolder').val('');
                                                    $('#agencyListDir').val('');
                                                    $('#agencyListDir').text('');
                                                    $('#numDir').val('');
                                                    $('#specDir').val('');
                                                    $('#dirDescription').val('');
                                                    $('#estabNameDir').val('');
                                                    $('#eTypeDir').val('');
                                                    $('#munCityDir').val('');
                                                    $('#brgyDir').val('');
                                                }, error: function() {
                                                    alert('Error in adding markers');
                                                }
                                            });
                                        }, error: function() {
                                            alert('Error in adding new directory');
                                        }
                                    });
                                }
                            }, error: function() {
                                alert('Error in adding new establishment office');
                            }
                        });
                    },
                    error: function()
                    {
                        alert("Error in adding new location.");
                    }
                });
            }
        });
        $('#DeleteEDir').click(function() {            
            if ($('#markerClassification').val() === "PNP") {
                classPNP.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "BFP") {
                classBFP.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Communication Group") {
                classCOM.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "SCHOOL") {
                classSCH.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "HOSPITAL") {
                classHOSP.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "CRDRRMC") {
                classCRD.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "DPWH") {
                classDPWH.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "AFP") {                
                classAFP.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Agency") {
                classAGENCY.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Electricity") {
                classELEC.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Dams") {
                classDAM.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Malls") {
                classMALL.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Mines") {
                classMINES.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Responder") {
                classRES.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "OCD STAFF") {
                classOCD.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "LGU") {
                classLGU.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "DRRMO") {
                classDRRMO.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "LCE") {
                classLCE.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "TV AND RADIO") {
                classTVRAD.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "OCD-CO") {
                classOCDCO.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "OCD Regional Office") {
                classOCDREG.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Civic Action Group") {
                classCAG.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "DepEd") {
                classDEPED.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Radio Repeaters") {
                classRAD.removeLayer($('#markerID').val());
            } else if ($('#markerClassification').val() === "Evacuation Area") {
                classEVAC.removeLayer($('#markerID').val());
            }
            var estabID = $('#eEstabID').val();
            var locationID = $('#eLocationID').val();
            var directoryID = $('#eDirectoryID').val();
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteDirectory/",
                type: 'POST',
                data: {'directoryID': directoryID},
                dataType: 'JSON',
                success: function() {
                    $.ajax({
                        url: "<?php echo base_url() ?>" + "deleteEstabOffice/",
                        type: 'POST',
                        data: {'id': estabID},
                        dataType: 'JSON',
                        success: function() {
                            $.ajax({
                                url: "<?php echo base_url() ?>" + "deleteLocation/",
                                type: 'POST',
                                data: {'locationID': locationID},
                                dataType: 'JSON',
                                success: function() {
                                    alert('Successful in deleting location information');
                                },
                                error: function() {
                                    alert('Error in deleting information from location table');
                                }
                            });
                        }, error: function() {
                            alert("Error in deleting information from establishment_office table");
                        }
                    });
                },
                error: function() {
                    alert("Error in deleting information from directory table");
                }
            });
        });
        $('#SaveEDir').click(function() {
            var id = $('#eEstabID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var locationID = $('#eLocationID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var agency = $('#agencyListEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var directory = $('#eDirectoryID').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var contact = $('#numEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var specifics = $('#specEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var description = $('#eDescription').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var name = $('#estabNameEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var eType = $('#eTypeEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var munCity = $('#munCityEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var brgy = $('#brgyEDir').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var x = $('#xECoordinate').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            var y = $('#yECoordinate').val().trim().replace(/<(?:.|\n)*?>/gm, '');
            if (id === "" || agency === "" || description === "" ||
                    eType === "" || x === "" || y === "" || name === "") {
                alert("Each field is important. Please don't leave them blank.");
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "editLocation/",
                    type: 'POST',
                    data: {'locationID': locationID, 'muniCityID': munCity, 'brgy': brgy, 'xCoordinate': x, 'yCoordinate': y},
                    dataType: 'JSON',
                    success: function()
                    {
                        $.ajax({
                            url: "<?php echo base_url() ?>" + "editEOffice/",
                            type: 'POST',
                            data: {'agencyID': agency, 'description': description, 'establishmentID': id, 'locationID': locationID, 'esTypeID': eType, 'name': name},
                            dataType: 'JSON',
                            success: function() {
                                $.ajax({
                                    url: "<?php echo base_url() ?>" + "editDirectory/",
                                    type: 'POST',
                                    data: {'contactNo': contact, 'directoryID': directory, 'specifics': specifics, 'establishmentID': id},
                                    dataType: 'JSON',
                                    success: function() {
                                        alert('Successful in establishment office');
                                    }, error: function() {
                                        alert('Error in adding new directory');
                                    }
                                });
                            }, error: function() {
                                alert('Error in adding new establishment office');
                            }
                        });
                    },
                    error: function()
                    {
                        alert("Error in adding new location.");
                    }
                });
            }
        });
        $('#saveAccidentType').click(function() {
            var id = 0;
            var accidentType = $('#aTypeName').val().trim().replace(/<(?:.|\n)*?>/gm, '');            
            if (accidentType === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(accidentType.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(accidentType.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!accidentType.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "pAddAccidentType/",
                    type: 'POST',
                    data: {'id': id, 'accidentType': accidentType},
                    dataType: 'JSON',
                    success: function(data) {
                        $('#accidentTypeTable').dataTable().fnAddData([data, accidentType,
                            '<div></div>','<div></div>','<a class="editAccidentType" href=""><pre id="edit-opt">    </pre></a>', '<a class="deleteAccidentType" href=""><pre id="del-opt">    </pre></a>']);
                        $('#aTypeName').val("");                        
                        alert('Adding new accident type successful');
                    },
                    error: function() {
                        alert("Error in adding new accident type.");
                    }
                });
            }
        });
        /*
         * binding click event for deleting data table rows
         */
        $('#contactTable').on('click', 'a.deleteContact', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');            
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteContactLoc",
                type: "POST",
                data: {'id': id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        $.ajax({
                            url: "<?php echo base_url() ?>" + "deleteContactEstab",
                            type: "POST",
                            data: {'id': id},
                            dataType: "JSON",
                            success: function(data)
                            {
                                if (data) {
                                    $.ajax({
                                        url: "<?php echo base_url() ?>" + "deleteDirectory",
                                        type: "POST",
                                        data: {'directoryID': id},
                                        dataType: "JSON",
                                        success: function(data)
                                        {
                                            if (data) {
                                                alert("Successfully deleted contact data");
                                                oContactsTable.fnDeleteRow(nRow);
                                            }
                                        },
                                        error: function() {
                                            alert("Error in deleting contact data");
                                        }
                                    });                                    
                                }
                            },
                            error: function() {
                                alert("Error in deleting establishment data");
                            }
                        });
                        //alert("Successfully deleted contact data");
                        //oContactsTable.fnDeleteRow(nRow);
                    }
                },
                error: function() {
                    alert("Error in deleting contact data");
                }
            });
        });
        $('#provTable').on('click', 'a.deleteProv', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteProv",
                type: "POST",
                data: {'id': id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted province data");
                        oProvTable.fnDeleteRow(nRow);
                    }
                    location.reload();
                },
                error: function() {
                    alert("Error in deleting province data");
                }
            });
        });
        $('#munTable').on('click', 'a.deleteMun', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteMun",
                type: "POST",
                data: {"id": id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted municipality and city data");
                        oMunTable.fnDeleteRow(nRow);
                    }
                },
                error: function() {
                    alert("Error in deleting municipality/ city data");
                }
            });
        });
        $('#brgyTable').on('click', 'a.deleteBrgy', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteBrgy",
                type: "POST",
                data: {"id": id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted barangay data");
                        oBrgyTable.fnDeleteRow(nRow);
                    }
                },
                error: function() {
                    alert("Error in deleting barangay data");
                }
            });
        });
        $('#estabTable').on('click', 'a.deleteEstab', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteEstab",
                type: "POST",
                data: {"id": id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted establishment data");
                        oEstabTable.fnDeleteRow(nRow);
                    }
                },
                error: function() {
                    alert("Error in deleting establishment data");
                }
            });
        });
        $('#categoryTable').on('click', 'a.deleteCategory', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteCategory",
                type: "POST",
                data: {"id": id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted category data");
                        oCategoryTable.fnDeleteRow(nRow);
                    }
                },
                error: function()
                {
                    alert("Error in deleting category data");
                }
            });
        });
        $('#agencyTable').on('click', 'a.deleteAgency', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteAgency",
                type: "POST",
                data: {"id": id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted agency data");
                        oAgencyTable.fnDeleteRow(nRow);
                    }
                },
                error: function()
                {
                    alert("Error in deleting agency data");
                }
            });
        });
        $('#accidentTypeTable').on('click', 'a.deleteAccidentType', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parent().siblings(":first").text().replace(/<(?:.|\n)*?>/gm, '');
            $.ajax({
                url: "<?php echo base_url() ?>" + "deleteAccidentType",
                type: "POST",
                data: {'id': id},
                dataType: "JSON",
                success: function(data)
                {
                    if (data) {
                        alert("Successfully deleted accident type data");
                        oAccidentTypeTable.fnDeleteRow(nRow);
                    }
                },
                error: function() {
                    alert("Error in deleting accident type data");
                }
            });
        });
        /*
         *binding click event for the editing of datatable rows 
         */
        $('#contactTable').on('click', 'a.editContact', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingContact !== null && nEditingContact !== nRow) {
                resContactRow(nEditingContact);
                editContactRow(nRow);
                nEditingContact = nRow;
            } else if (nEditingContact === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveContactRow(nEditingContact);
                nEditingContact = null;
            } else {
                editContactRow(nRow);
                nEditingContact = nRow;
            }
        });
        $('#provTable').on('click', 'a.editProv', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingProv !== null && nEditingProv !== nRow) {
                resProvRow(nEditingProv);
                editProvRow(nRow);
                nEditingProv = nRow;
            } else if (nEditingProv === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveProvRow(nEditingProv);
                nEditingProv = null;
            } else {
                editProvRow(nRow);
                nEditingProv = nRow;
            }
        });
        $('#munTable').on('click', 'a.editMun', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingMun !== null && nEditingMun !== nRow) {
                resMunRow(nEditingMun);
                editMunRow(nRow);
                nEditingMun = nRow;
            } else if (nEditingMun === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveMunRow(nEditingMun);
                nEditingMun = null;
            } else {
                editMunRow(nRow);
                nEditingMun = nRow;
            }
        });
        $('#brgyTable').on('click', 'a.editBrgy', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingBrgy !== null && nEditingBrgy !== nRow) {
                resBrgyRow(nEditingBrgy);
                editBrgyRow(nRow);
                nEditingBrgy = nRow;
            } else if (nEditingBrgy === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveBrgyRow(nEditingBrgy);
                nEditingBrgy = null;
            } else {
                editBrgyRow(nRow);
                nEditingBrgy = nRow;
            }
        });
        $('#estabTable').on('click', 'a.editEstab', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingEstab !== null && nEditingEstab !== nRow) {
                resEstabRow(nEditingEstab);
                editEstabRow(nRow);
                nEditingEstab = nRow;
            } else if (nEditingEstab === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveEstabRow(nEditingEstab);
                nEditingEstab = null;
            } else {
                editEstabRow(nRow);
                nEditingEstab = nRow;
            }
        });
        $('#categoryTable').on('click', 'a.editCategory', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingCat !== null && nEditingCat !== nRow) {
                resCatRow(nEditingCat);
                editCatRow(nRow);
                nEditingCat = nRow;
            } else if (nEditingCat === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveCatRow(nEditingCat);
                nEditingCat = null;
            } else {
                editCatRow(nRow);
                nEditingCat = nRow;
            }
        });
        $('#agencyTable').on('click', 'a.editAgency', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingAgency !== null && nEditingAgency !== nRow) {
                editAgencyRow(nRow);
                nEditingAgency = nRow;
            } else if (nEditingAgency === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                nEditingAgency = null;
            } else {
                editAgencyRow(nRow);
                nEditingAgency = nRow;
            }
        });
        $('#accidentTypeTable').on('click', 'a.editAccidentType', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (nEditingAType !== null && nEditingAType !== nRow) {
                resATypeRow(nEditingAType);
                editATypeRow(nRow);
                nEditingAType = nRow;
            } else if (nEditingAType === nRow && this.innerHTML === '<pre id="edit-opt2"> </pre>') {
                saveATypeRow(nEditingAType);
                nEditingAType = null;
            } else {
                editATypeRow(nRow);
                nEditingAType = nRow;
            }
        });
        $('#agencyTable').on('click', 'a.genAuth', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            genAuth(nRow);
        });
        /*
         * binding click events for cancel buttons which sets the value of textboxes of
         * the selected row into its value before clicking edit
         */
        $('#provTable').on('click', 'a.cancelProv', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resProvRow(nRow);
        });
        $('#munTable').on('click', 'a.cancelMun', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resMunRow(nRow);
        });
        $('#brgyTable').on('click', 'a.cancelBrgy', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resBrgyRow(nRow);
        });
        $('#estabTable').on('click', 'a.cancelEstab', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resEstabRow(nRow);
        });
        $('#categoryTable').on('click', 'a.cancelCategory', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resEstabRow(nRow);
        });
        $('#agencyTable').on('click', 'a.cancelEAgency', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resAgencyRow(nRow);
        });
        $('#contactTable').on('click', 'a.cancelContact', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resContactRow(nRow);
        });
        $('#accidentTypeTable').on('click', 'a.cancelAccidentType', function(e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            resATypeRow(nRow);
        });
        function genAuth(nRow) {
            var id = 0;
            var aData = oAgencyTable.fnGetData(nRow);
            var agencyID = aData[0];
            var email = aData[3];
                      
            $('#spinnerAg').spin("modal");
            $.ajax({
                url: "<?php echo base_url() ?>" + "genCode/",
                type: 'POST',
                data: {'id': id, 'agencyID': agencyID, 'email':email},
                dataType: 'JSON',
                success: function() {
                    $("#spin_modal_overlay").remove();
                    $('#spinnerAg').spin(false);
                    alert("Generating authentication code successful");
                }, error: function() {
                    alert("Error in generating authentication code");
                }
            });
        }
        function editContactRow(nRow) {

            var aData = oContactsTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];
            $.ajax({
                url: "<?php echo base_url() ?>" + "getContact/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function(data)
                {
                    jqTds[0].innerHTML = '<input id="jqtdsDirectoryID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsContactNo" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<input id="jqtdsSpecifics" value="' + aData[2] + '" type="text" required />';
                    jqTds[3].innerHTML = '<a class="editContact" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[4].innerHTML = '<a class="cancelContact" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from directory table");
                }
            });
        }
        function editProvRow(nRow) {

            var aData = oProvTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];

            $.ajax({
                url: "<?php echo base_url() ?>" + "getProv/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function(data)
                {
                    jqTds[0].innerHTML = '<input id="jqtdsProvID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsProvName" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<a class="editProv" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[3].innerHTML = '<a class="cancelProv" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from province table");
                }
            });
        }
        function editMunRow(nRow) {

            var aData = oMunTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];

            $.ajax({
                url: "<?php echo base_url() ?>" + "getMun/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function(data)
                {
                    jqTds[0].innerHTML = '<input id="jqtdsMunID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsMunName" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<a class="editMun" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[3].innerHTML = '<a class="cancelMun" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from municipality_city table");
                }
            });
        }
        function editBrgyRow(nRow) {

            var aData = oBrgyTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];
            $.ajax({
                url: "<?php echo base_url() ?>" + "getBrgy/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function()
                {
                    jqTds[0].innerHTML = '<input id="jqtdsBrgyID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsBrgyName" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<input id="jqtdsBrgyX" value="' + aData[2] + '" type="text" required />';
                    jqTds[3].innerHTML = '<input id="jqtdsBrgyY" value="' + aData[3] + '" type="text" required />';
                    jqTds[4].innerHTML = '<a class="editBrgy" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[5].innerHTML = '<a class="cancelBrgy" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from barangay table");
                }
            });
        }
        function editEstabRow(nRow) {

            var aData = oEstabTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];
            $.ajax({
                url: "<?php echo base_url() ?>" + "getEstab/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function()
                {
                    jqTds[0].innerHTML = '<input id="jqtdsEstabID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsEstabName" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<a class="editEstab" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[3].innerHTML = '<a class="cancelEstab" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from establishment_type table");
                }
            });
        }
        function editCatRow(nRow) {

            var aData = oCategoryTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];
            $.ajax({
                url: "<?php echo base_url() ?>" + "getCat/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function()
                {
                    jqTds[0].innerHTML = '<input id="jqtdsCatID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsCatName" value="' + aData[1] + '" type="text" required />';
                    jqTds[2].innerHTML = '<a class="editCategory" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[3].innerHTML = '<a class="cancelCategory" href=""><pre id="cancel-opt"> </pre></a>';
                }, error: function() {
                    alert("Error in retrieving data from category table");
                }
            });
        }
        function editAgencyRow(nRow) {

            var aData = oAgencyTable.fnGetData(nRow);
            var id = aData[0];
            $.ajax({
                url: "<?php echo base_url() ?>" + "getAgency/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function(data)
                {
                    aRowData = nRow;
                    $('#aEAgencyID').val(data[0].agencyID);
                    $('#aELName').val(data[0].agencyName);
                    $('#aAddELName').val(data[0].address);
                    $('#aEAddELName').val(data[0].emailAdd);
                    $('#aECatID').val(data[0].categoryID);
                    $('#aECityMunID').val(data[0].municipality);
                    $('#aEProvID').val(data[0].province);
                    $('#aEBarangayID').val(data[0].barangay);
                    $('input[name="chkbxCMemberY"][value=' + data[0].council_member + ']').attr("checked", "checked");
                    $('.PopUpWindowEditAgency').bPopup();
                }, error: function() {
                    alert("Error in retrieving data from category table");
                }
            });
        }
        function editATypeRow(nRow) {

            var aData = oAccidentTypeTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var id = aData[0];            
            $.ajax({
                url: "<?php echo base_url() ?>" + "getAccidentType/",
                type: 'POST',
                data: {'id': id},
                dataType: 'JSON',
                success: function()
                {
                    jqTds[0].innerHTML = '<input id="jqtdsAtypeID" value="' + aData[0] + '" type="text" disabled />';
                    jqTds[1].innerHTML = '<input id="jqtdsATypeName" value="' + aData[1] + '" type="text" required />';                    
                    jqTds[2].innerHTML = '<div class="colorSelector"></div>';
                    jqTds[3].innerHTML = '<form id="uploadImage" action="<?php echo base_url()?>do_upload" method="post" enctype="multipart/form-data">\n\
                                            <input type="file" name="userfile" size="20" />\n\
                                            <input type="submit" name="submit" id="submit" />\n\
                                          </form>';
                    jqTds[4].innerHTML = '<a class="editAccidentType" href=""><pre id="edit-opt2"> </pre></a>';
                    jqTds[5].innerHTML = '<a class="cancelAccidentType" href=""><pre id="cancel-opt"> </pre></a>';                    
                    /*
                     * Image uploading using AJAX
                     */
                    $('#uploadImage').submit(function(){
                        $(this).ajaxSubmit();
                        $("input[name='userfile']").each(function() {
                            var fileName = $(this).val().split('/').pop().split('\\').pop();
                            $('#imageName').val(fileName);                            
                        });
                        return false;
                    });
                    /*
                    * Set up color picker for accident types
                    */                   
                   $('.colorSelector').attr('style', 'background-color:'+aData[2]+';');
                   $('#colorVal').val(aData[2]);
                   $('.colorSelector').ColorPicker({                       
                       onSubmit: function(hsb, hex, rgb, el) {
                           $(el).val(hex);
                           $(el).ColorPickerHide();
                           $('.colorSelector').attr('style', 'background-color:#'+hex+';');
                           $('#colorVal').val("#"+hex);
                       },
                       onShow: function (colpkr) {
                           $(colpkr).fadeIn(500);
                           return false;
                       },
                       onHide: function (colpkr) {
                           $(colpkr).fadeOut(500);
                           return false;
                       },
                       onChange: function (hsb, hex, rgb) {
                           $('.colorSelector').attr('style', 'background-color:#'+hex+';');
                        }
                   });
               }, error: function() {
                   alert("Error in retrieving data from accident_type table");
                   }
                   });
                   }
        function resContactRow(nRow) {
            var aData = oContactsTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = aData[2];
            jqTds[3].innerHTML = '<a class="editContact" href=""><pre id="edit-opt">     </pre></a>';
            jqTds[4].innerHTML = '<a class="deleteContact" href=""><pre id="del-opt">    </pre></a></td>';
        }
        function resProvRow(nRow) {
            var aData = oProvTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = '<a class="editProv" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[3].innerHTML = '<a class="deleteProv" href=""><pre id="del-opt">    </pre></a>';
        }
        function resMunRow(nRow) {
            var aData = oMunTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = '<a class="editMun" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[3].innerHTML = '<a class="deleteMun" href=""><pre id="del-opt">    </pre></a>';
        }
        function resBrgyRow(nRow) {
            var aData = oBrgyTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = aData[2];
            jqTds[3].innerHTML = aData[3];
            jqTds[4].innerHTML = '<a class="editBrgy" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[5].innerHTML = '<a class="deleteBrgy" href=""><pre id="del-opt">    </pre></a>';
        }
        function resEstabRow(nRow) {
            var aData = oEstabTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = '<a class="editEstab" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[3].innerHTML = '<a class="deleteEstab" href=""><pre id="del-opt">    </pre></a>';
        }
        function resCatRow(nRow) {
            var aData = oCategoryTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = '<a class="editCategory" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[3].innerHTML = '<a class="deleteCategory" href=""><pre id="del-opt">    </pre></a>';
        }

        function resATypeRow(nRow) {
            var aData = oAccidentTypeTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = aData[1];
            jqTds[2].innerHTML = aData[2];
            jqTds[3].innerHTML = aData[3];
            jqTds[4].innerHTML = '<a class="editAccidentType" href=""><pre id="edit-opt">    </pre></a>';
            jqTds[5].innerHTML = '<a class="deleteAccidentType" href=""><pre id="del-opt">    </pre></a>';
        }
        function saveContactRow(nRow) {
            var jqInputs = $('input', nRow);

            var id = jqInputs[0].value;
            var contactNo = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var specifics = jqInputs[2].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editContact" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteContact" href=""><pre id="del-opt">    </pre></a>';
            if (id === "" || contactNo === "" || specifics === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(contactNo.length < 3 || specifics.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(contactNo.length > 20 ||specifics.length > 20){
                alert("INVALID INPUT. Your input should not be LONGER than 20 characters");
                return false;
            } else if(!contactNo.match(/[0-9]/)){
                alert("INVALID INPUT. Your input should not contain letters");
                return false;
            }else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "editDirectory/",
                    type: 'POST',
                    data: {'directoryID': id, 'contactNo': contactNo, 'specifics': specifics, 'establishmentID': ""},
                    dataType: 'JSON',
                    success: function()
                    {                        
                        oContactsTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oContactsTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oContactsTable.fnUpdate($('<div/>').text(jqInputs[2].value).html(), nRow, 2, false);
                        oContactsTable.fnUpdate(edit, nRow, 3, false);
                        oContactsTable.fnUpdate(del, nRow, 4, false);
                        oContactsTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resContactRow(nRow);
        }
        function saveProvRow(nRow) {
            var jqInputs = $('input', nRow);
            var id = jqInputs[0].value;
            var province = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editProv" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteProv" href=""><pre id="del-opt">    </pre></a>';

            if (province === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(province.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(province.length > 20){
                alert("INVALID INPUT. Your input should not be LONGER than 20 characters");
                return false;
            } else if(!province.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "editProv/",
                    type: 'POST',
                    data: {'id': id, 'province': province},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("Province information successfully edited");
                        oProvTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oProvTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oProvTable.fnUpdate(edit, nRow, 2, false);
                        oProvTable.fnUpdate(del, nRow, 3, false);
                        oProvTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resProvRow(nRow);
            location.reload();
        }
        function saveMunRow(nRow) {
            var jqInputs = $('input', nRow);
            var id = jqInputs[0].value;
            var name = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editMun" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteMun" href=""><pre id="del-opt">    </pre></a>';

            if (name === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(name.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(name.length > 20){
                alert("INVALID INPUT. Your input should not be LONGER than 20 characters");
                return false;
            } else if(!name.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {

                $.ajax({
                    url: "<?php echo base_url() ?>" + "editMun/",
                    type: 'POST',
                    data: {'id': id, 'name': name},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("municipality/ city information successfully edited");
                        oMunTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oMunTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oMunTable.fnUpdate(edit, nRow, 2, false);
                        oMunTable.fnUpdate(del, nRow, 3, false);
                        oMunTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resMunRow(nRow);
        }
        function saveBrgyRow(nRow) {
            var jqInputs = $('input', nRow);
            var id = jqInputs[0].value;
            var name = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var x = jqInputs[2].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var y = jqInputs[3].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editBrgy" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteBrgy" href=""><pre id="del-opt">    </pre></a>';

            if (name === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false
            } else if(name.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(name.length > 30){
                alert("INVALID INPUT. Your input should not be LONGER than 30 characters");
                return false;
            } else if(!name.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {

                $.ajax({
                    url: "<?php echo base_url() ?>" + "editBrgy/",
                    type: 'POST',
                    data: {'id': id, 'name': name, 'x': x, 'y': y},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("Barangay information successfully edited");
                        oBrgyTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oBrgyTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oBrgyTable.fnUpdate($('<div/>').text(jqInputs[2].value).html(), nRow, 2, false);
                        oBrgyTable.fnUpdate($('<div/>').text(jqInputs[3].value).html(), nRow, 3, false);
                        oBrgyTable.fnUpdate(edit, nRow, 4, false);
                        oBrgyTable.fnUpdate(del, nRow, 5, false);
                        oBrgyTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resBrgyRow(nRow);
        }
        function saveEstabRow(nRow) {
            var jqInputs = $('input', nRow);
            var id = jqInputs[0].value;
            var classification = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editEstab" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteEstab" href=""><pre id="del-opt">    </pre></a>';

            if (classification === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(classification.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(classification.length > 20){
                alert("INVALID INPUT. Your input should not be LONGER than 20 characters");
                return false;
            } else if(!classification.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {

                $.ajax({
                    url: "<?php echo base_url() ?>" + "editEstab/",
                    type: 'POST',
                    data: {'id': id, 'classification': classification},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("Establishment information successfully edited");
                        oEstabTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oEstabTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oEstabTable.fnUpdate(edit, nRow, 2, false);
                        oEstabTable.fnUpdate(del, nRow, 3, false);
                        oEstabTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resEstabRow(nRow);
        }
        function saveCatRow(nRow) {
            var jqInputs = $('input', nRow);

            var id = jqInputs[0].value;
            var category = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var edit = '<a class="editCategory" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deletecategory" href=""><pre id="del-opt">    </pre></a>';

            if (category === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(category.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(category.length > 20){
                alert("INVALID INPUT. Your input should not be LONGER than 20 characters");
                return false;
            } else if(!category.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "editCat/",
                    type: 'POST',
                    data: {'id': id, 'category': category},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("Successfully Edited");
                        oCategoryTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oCategoryTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oCategoryTable.fnUpdate(edit, nRow, 2, false);
                        oCategoryTable.fnUpdate(del, nRow, 3, false);
                        oCategoryTable.fnDraw();
                    }, error: function() {
                        alert("Failed admin_script");
                    }
                });
            }
            resCatRow(nRow);
        }
        function saveATypeRow(nRow) {
            var jqInputs = $('input', nRow);
            var id = jqInputs[0].value;
            var accidentType = jqInputs[1].value.trim().replace(/<(?:.|\n)*?>/gm, '');
            var color = $('#colorVal').val();
            var imageName = $('#imageName').val();
            var edit = '<a class="editAccidentType" href=""><pre id="edit-opt">    </pre></a>';
            var del = '<a class="deleteAccidentType" href=""><pre id="del-opt">    </pre></a>';            
            if (accidentType === "") {
                alert("Each field is important. Please don't leave them blank.");
                return false;
            } else if(accidentType.length < 3){
                alert("INVALID INPUT. Your input should not be SHORTER than 3 characters");
                return false;
            } else if(accidentType.length > 50){
                alert("INVALID INPUT. Your input should not be LONGER than 50 characters");
                return false;
            } else if(!accidentType.match(/^[a-zA-Z\s]+$/)){
                alert("INVALID INPUT. Your input should not contain number and special characters");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url() ?>" + "editAccidentType/",
                    type: 'POST',
                    data: {'id': id, 'accidentType': accidentType, 'color': color, 'userfile': imageName},
                    dataType: 'JSON',
                    success: function()
                    {
                        alert("Accident type information successfully edited");
                        oAccidentTypeTable.fnUpdate($('<div/>').text(jqInputs[0].value).html(), nRow, 0, false);
                        oAccidentTypeTable.fnUpdate($('<div/>').text(jqInputs[1].value).html(), nRow, 1, false);
                        oAccidentTypeTable.fnUpdate($('<div/>').text(color).html(), nRow, 2, false);
                        oAccidentTypeTable.fnUpdate($('<div/>').text(imageName).html(), nRow, 3, false);
                        oAccidentTypeTable.fnUpdate(edit, nRow, 4, false);
                        oAccidentTypeTable.fnUpdate(del, nRow, 5, false);
                        oAccidentTypeTable.fnDraw();
                    }, error: function() {
                        alert("Failure in editing accident type information");
                    }
                });
            }
            resATypeRow(nRow);
        }
        /*
         * Establishment map rendering using Leaflet js                 
         */
        var tilesLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {nowrap: 'true', minZoom: 8});
        var marker;
        var classPNP = L.layerGroup();
        var classBFP = L.layerGroup();
        var classCOM = L.layerGroup();
        var classRES = L.layerGroup();
        var classMINES = L.layerGroup();
        var classMALL = L.layerGroup();
        var classDAM = L.layerGroup();
        var classELEC = L.layerGroup();
        var classAGENCY = L.layerGroup();
        var classAFP = L.layerGroup();
        var classDPWH = L.layerGroup();
        var classCRD = L.layerGroup();
        var classHOSP = L.layerGroup();
        var classSCH = L.layerGroup();
        var classOCD = L.layerGroup();
        var classLGU = L.layerGroup();
        var classDRRMO = L.layerGroup();
        var classLCE = L.layerGroup();
        var classTVRAD = L.layerGroup();
        var classOCDCO = L.layerGroup();
        var classOCDREG = L.layerGroup();
        var classCAG = L.layerGroup();
        var classDEPED = L.layerGroup();
        var classRAD = L.layerGroup();
        var classEVAC = L.layerGroup();
        map = new L.Map('map', {layers: [tilesLayer, classPNP, classBFP, classCOM, classRES, classMINES, classMALL
                        , classDAM, classELEC, classAGENCY, classAFP, classDPWH, classCRD, classHOSP, classSCH, classOCD, classLGU,
                        classDRRMO, classLCE, classTVRAD, classOCDCO, classOCDREG, classCAG, classDEPED, classRAD, classEVAC]});
        map.setView(new L.LatLng(16.412004117801047, 120.59338136163205), 16);
        map.setMaxBounds([[18.594, 120.366], [14.998, 121.767]]);
        <?php foreach ($markers as $item) { ?>            
            marker = L.icon({
                iconUrl: "<?php echo base_url() ?>" + "images/markers/<?php echo $item["classification"] ?>.png",
                iconSize: [50, 50] // size of the icon                        
            });
            var m = L.marker([<?php echo $item["y"] ?>, <?php echo $item["x"] ?>], {icon: marker, draggable: true}).
                    on('click', function() {
                $('#eEstabID').val("<?php echo $item["establishmentID"] ?>");
                $('#eLocationID').val("<?php echo $item["locationID"] ?>");
                $('#eDirectoryID').val("<?php echo $item["directoryID"] ?>");
                $('#agencyListEDir').val("<?php echo $item["agencyID"] ?>");
                $('#numEDir').val("<?php echo $item["contactNo"] ?>");
                $('#specEDir').val("<?php echo $item["specifics"] ?>");
                $('#eDescription').val("<?php echo $item["description"] ?>");
                $('#estabNameEDir').val("<?php echo $item["name"] ?>");
                $('#eTypeEDir').val("<?php echo $item["esTypeID"] ?>");
                $('#munCityEDir').val("<?php echo $item["muniCityID"] ?>");
                $('#brgyEDir').val("<?php echo $item["barangay"] ?>");
                $('#xECoordinate').val("<?php echo $item["x"] ?>");
                $('#yECoordinate').val("<?php echo $item["y"] ?>");
                $('#markerID').val(this._leaflet_id);
                $('#markerClassification').val("<?php echo $item["classification"] ?>");
                $('.PopUpWindowEDir').bPopup({
                    modalColor: 'none'});
            }).on('dragend', function(event) {
                var mrk = event.target;
                $('#eEstabID').val("<?php echo $item["establishmentID"] ?>");
                $('#eLocationID').val("<?php echo $item["locationID"] ?>");
                $('#eDirectoryID').val("<?php echo $item["directoryID"] ?>");
                $('#agencyListEDir').val("<?php echo $item["agencyID"] ?>");
                $('#numEDir').val("<?php echo $item["contactNo"] ?>");
                $('#specEDir').val("<?php echo $item["specifics"] ?>");
                $('#eDescription').val("<?php echo $item["description"] ?>");
                $('#estabNameEDir').val("<?php echo $item["name"] ?>");
                $('#eTypeEDir').val("<?php echo $item["esTypeID"] ?>");
                $('#munCityEDir').val("<?php echo $item["muniCityID"] ?>");
                $('#brgyEDir').val("<?php echo $item["barangay"] ?>");
                $('#xECoordinate').val(mrk.getLatLng().lng);
                $('#yECoordinate').val(mrk.getLatLng().lat);
                $('#markerID').val(this._leaflet_id);
                $('#markerClassification').val("<?php echo $item["classification"] ?>");
                $('.PopUpWindowEDir').bPopup({
                    modalColor: 'none'});
            });

            if ("<?php echo $item["classification"] ?>" === "PNP") {                
                classPNP.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "BFP") {
                classBFP.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Communication Group") {
                classCOM.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "SCHOOL") {
                classSCH.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "HOSPITAL") {
                classHOSP.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "CRDRRMC") {
                classCRD.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "DPWH") {
                classDPWH.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "AFP") {
                classAFP.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Agency") {
                classAGENCY.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Electricity") {
                classELEC.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Dams") {
                classDAM.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Malls") {
                classMALL.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Mines") {
                classMINES.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Responder") {
                classRES.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "OCD STAFF") {
                classOCD.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "LGU") {
                classLGU.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "DRRMO") {
                classDRRMO.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "LCE") {
                classLCE.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "TV AND RADIO") {
                classTVRAD.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "OCD-CO") {
                classOCDCO.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "OCD Regional Office") {
                classOCDREG.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Civic Action Group") {
                classCAG.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "DepEd") {
                classDEPED.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Radio Repeaters") {
                classRAD.addLayer(m);
            } else if ("<?php echo $item["classification"] ?>" === "Evacuation Area") {
                classEVAC.addLayer(m);
            }
    <?php } ?>

        var baseMaps = {
            "Directory Map": tilesLayer,
        };
        var overlayMaps = {
            "AFP": classAFP,
            "Agency": classAGENCY,            
            "BFP": classBFP,
            "CRDRRMC": classCRD,
            "Civic Action Group": classCAG,
            "Communication Group": classCOM,
            "DPWH": classDPWH,            
            "DRRMO": classDRRMO,
            "Dams": classDAM,
            "DepEd": classDEPED,
            "PNP": classPNP,                        
            "Responder": classRES,
            "Mines": classMINES,
            "Malls": classMALL,            
            "Electricity": classELEC,                        
            "HOSPITAL": classHOSP,
            "SCHOOL": classSCH,
            "OCD STAFF": classOCD,
            "LGU": classLGU,            
            "LCE": classLCE,
            "TV AND RADIO": classTVRAD,
            "OCD-CO": classOCDCO,
            "OCD Regional Office": classOCDREG,                        
            "Radio Repeaters": classRAD,
            "Evacuation Area": classEVAC,
        };
        L.control.layers(baseMaps, overlayMaps).addTo(map);
        map.on('click', function onMapClick(e) {
            var x = e.latlng.lng;
            var y = e.latlng.lat;
            $('#xCoordinate').val(x);
            $('#yCoordinate').val(y);
            $.ajax({
                url: "<?php echo base_url() ?>" + "getProbContacts/",
                type: 'POST',                
                dataType: 'JSON',
                success: function(data) {
                    $('#numDir').empty();                        
                    $('#agencyListDir').empty();                        
                    $('#numDir').append('<option value="">Choose Contact Number</option>');                    
                    $('#agencyListDir').append('<option value="">Choose Agency</option>');
                    for (var ctr = 0; ctr < data.length; ctr++) {
                        $('#numDir').append('<option value="' + data[ctr].directoryID + '">' + data[ctr].contactNo + '</option>');
                        $('#agencyListDir').append('<option value="' + data[ctr].agencyID + '">' + data[ctr].agencyName + '</option>');
                    }
                    $('#numDir').val($('#dirIDHolder').val());
                    $('#agencyListDir').val($('#agencyListDirHolder').val());                                        
                }, error: function() {
                    alert('Error in retrieving contact information for directory table');
                }                                    
            });
            $('.PopUpWindowDir').bPopup();
        });
    });
</script>