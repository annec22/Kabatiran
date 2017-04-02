<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() . 'styles/pictures/web-icon.ico'; ?>" />
        <title>Admin System</title>
        

        <script src="<?php echo base_url() . 'scripts/jquery-1.9.1.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery-ui-1.9.2.custom.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.dataTables.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.dataTables.columnFilter.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.bpopup.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.form.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/lightbox-2.6.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/modernizr.custom.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.treetable.js'; ?>"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="<?php echo base_url() . 'scripts/leaflet.js'?>"></script>
        <script src="<?php echo base_url() . 'scripts/leaflet-src.js'?>"></script>
        <script src="<?php echo base_url() . 'scripts/Chart.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.cookie.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/spin.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/colorpicker.js'; ?>"></script>        
                
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/colorpicker.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/popUp.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/header.css'; ?>" type="text/css"/>
<!--        <link rel="stylesheet" href="<?php echo base_url() . 'styles/navigation.css'; ?>" type="text/css"/>-->
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/filter.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/content.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/dataTables.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/facebook.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/views.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/screen.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/lightbox.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/map.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/jquery.treetable.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/jquery.treetable.theme.default.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/jquery-ui-1.9.2.custom.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/leaflet.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/leaflet.ie.css'; ?>" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/map.css'; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/mobile.css'; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/all.css'; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/treetable.css'; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/popupbox.css'; ?>"/>


        <script type="text/javascript">
            $(document).ready(function(){
                if('<?php echo $this->session->userdata('type')?>' == "admin"){
                    $("#accNav").removeClass('show').addClass('hidden');
                }else{
                    $("#accNav").removeClass('hidden').addClass('show');
                }
            
            });
            var make_button_active = function()
            {
                //Get item siblings
                var siblings =($(this).siblings());

                //Remove active class on all buttons
                siblings.each(function (index)
                {
                    $(this).removeClass('active');
                                            
                    if($(this).attr("id") === "dm"){                        
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#db_view").removeClass('hidden').addClass('show');                        
                        $("#social_view").removeClass('show').addClass('hidden');
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#inbox_view").removeClass('show').addClass('hidden');                        
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#repgen_view").removeClass('show').addClass('hidden');
                    
                    }else if($(this).attr("id") === "dir"){                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#dir_view").removeClass('hidden').addClass('show');
                        $("#social_view").removeClass('show').addClass('hidden');
                        $("#inbox_view").removeClass('show').addClass('hidden');                        
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('show').addClass('hidden');                                          
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }else if($(this).attr("id") === "maps"){                                       
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#social_view").removeClass('show').addClass('hidden');
                        $("#inbox_view").removeClass('show').addClass('hidden');                        
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#maps_view").removeAttr("style");
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('show').addClass('hidden');
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }else if($(this).attr("id") === "mapHaz"){                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#dir_view").removeClass('hidden').addClass('show');
                        $("#social_view").removeClass('show').addClass('hidden');
                        $("#inbox_view").removeClass('show').addClass('hidden');                        
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('show').addClass('hidden');                                          
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }else if($(this).attr("id") === "social"){                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");                        
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#social_view").removeClass('hidden').addClass('show');
                        $("#inbox_view").removeClass('show').addClass('hidden');                        
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('show').addClass('hidden');
                    
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }else if($(this).attr("id") === "repgen"){                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#social_view").removeClass('show').addClass('hidden');
                        $("#inbox_view").removeClass('show').addClass('hidden');   
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('hidden').addClass('show');
                        $("#loc_view").removeClass('show').addClass('hidden');                   
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }else if($(this).attr("id") === "contacts"){                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");                       
                        $("#social_view").removeClass('show').addClass('hidden');                        
                        $("#inbox_view").removeClass('show').addClass('hidden');  
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#loc_view").removeClass('show').addClass('hidden');
                        $("#repgen_view").removeClass('show').addClass('hidden');
                        $("#contacts_view").removeClass('hidden').addClass('show');
                    }else{                        
                        $("#db_view").removeClass('show').addClass('hidden');
                        $("#dir_view").removeClass('show').addClass('hidden');
                        $("#dirMap_view").attr("style","visibility:hidden;");
                        $("#hazNav_view").removeClass('show').addClass('hidden');
                        $("#hazMap_view").attr("style","visibility:hidden;");
                        $("#social_view").removeClass('show').addClass('hidden');                        
                        $("#inbox_view").removeClass('show').addClass('hidden');  
                        $("#maps_view").attr("style","visibility:hidden;");
                        $("#logs_view").removeClass('show').addClass('hidden');
                        $("#loc_view").removeClass('hidden').addClass('show');
                        $("#repgen_view").removeClass('show').addClass('hidden');
                        $("#contacts_view").removeClass('show').addClass('hidden');
                    }    
                }
            );

                //Add the clicked button class
                $(this).addClass('active');
                
                                
                if($(this).attr("id") === "dm"){                                        
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#db_view").removeClass('hidden').addClass('show');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('show').addClass('hidden'); 
                    $("#repgen_view").removeClass('show').addClass('hidden');                                 
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "dir"){                                   
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").removeAttr("style");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('hidden').addClass('show');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('show').addClass('hidden');  
                    $("#repgen_view").removeClass('show').addClass('hidden');                                   
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "social"){                                      
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('hidden').addClass('show');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');                                   
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "inbox"){                                    
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('hidden').addClass('show');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');                                   
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "maps"){                                       
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('hidden').addClass('show');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeAttr("style");
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');                                
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "mapHaz"){                                       
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('hidden').addClass('show');
                    $("#hazMap_view").removeAttr("style");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeAttr("style");
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');                             
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "logs"){                                     
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('hidden').addClass('show');
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');                               
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else if($(this).attr("id") === "contacts"){                                     
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('show').addClass('hidden');
                    $("#contacts_view").removeClass('hidden').addClass('show');
                }else if($(this).attr("id") === "repgen"){                                    
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#repgen_view").removeClass('hidden').addClass('show');
                    $("#loc_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');                
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }else{                    
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#hazNav_view").removeClass('show').addClass('hidden');
                    $("#hazMap_view").attr("style","visibility:hidden;");
                    $("#dir_view").removeClass('show').addClass('hidden');                    
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#inbox_view").removeClass('show').addClass('hidden');
                    $("#maps_view").removeClass('show').addClass('hidden');
                    $("#logs_view").removeClass('show').addClass('hidden');
                    $("#loc_view").removeClass('hidden').addClass('show');
                    $("#repgen_view").removeClass('show').addClass('hidden');
                    $("#contacts_view").removeClass('show').addClass('hidden');
                }
                /*
                 * set the param views based on the clicked element
                 */
                
                
                
                $('#hazNavSelect').on('change',function(){
                    if($('#hazNavSelect').find(":selected").text()==="Abra"){
                       
                       
                        $("#hazMap_viewAbra").removeAttr("style");
                        $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                        $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                        $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                        $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                        $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                                
                   }else if($('#hazNavSelect').find(":selected").text()==="Apayao"){
                       $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                        $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                        $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                        $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                        $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                        $("#hazMap_viewApayao").removeAttr("style");
                   }else if($('#hazNavSelect').find(":selected").text()==="Benguet"){
                       $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                        $("#hazMap_viewBenguet").removeAttr("style");
                        $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                        $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                        $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                        $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                   }else if($('#hazNavSelect').find(":selected").text()==="Ifugao"){
                       $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                        $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                        $("#hazMap_viewIfugao").removeAttr("style");
                        $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                        $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                        $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                   }else if($('#hazNavSelect').find(":selected").text()==="Kalinga"){
                       $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                        $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                        $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                        $("#hazMap_viewKalinga").removeAttr("style");
                        $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                        $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                   }else if($('#hazNavSelect').find(":selected").text()==="Mountain Province"){
                       $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                        $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                        $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                        $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                        $("#hazMap_viewMountainProvince").removeAttr("style");
                        $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                   }
                });
                
                $('#paramNavSelect').on('change',function(){
                   if($('#paramNavSelect').find(":selected").text()==="Agencies"){
                        $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('hidden').addClass('show');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Categories"){
                       $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('hidden').addClass('show');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Establishment Types"){
                       $("#view_paramEstab").removeClass('hidden').addClass('show');
                        $("#view_paramCategory").removeClass('show').addClass('hidden');
                        $("#view_paramAgency").removeClass('show').addClass('hidden');
                        $("#view_paramMun").removeClass('show').addClass('hidden');
                        $("#view_paramProv").removeClass('show').addClass('hidden');
                        $("#view_paramBrgy").removeClass('show').addClass('hidden');
                        $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Barangays"){
                       $("#view_paramEstab").removeClass('show').addClass('hidden');
                        $("#view_paramCategory").removeClass('show').addClass('hidden');
                        $("#view_paramAgency").removeClass('show').addClass('hidden');
                        $("#view_paramMun").removeClass('show').addClass('hidden');
                        $("#view_paramProv").removeClass('show').addClass('hidden');
                        $("#view_paramBrgy").removeClass('hidden').addClass('show');
                        $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Cities and Municipalities"){
                       $("#view_paramEstab").removeClass('show').addClass('hidden');
                        $("#view_paramCategory").removeClass('show').addClass('hidden');
                        $("#view_paramAgency").removeClass('show').addClass('hidden');
                        $("#view_paramMun").removeClass('hidden').addClass('show');
                        $("#view_paramProv").removeClass('show').addClass('hidden');
                        $("#view_paramBrgy").removeClass('show').addClass('hidden');
                        $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Provinces"){
                       $("#view_paramEstab").removeClass('show').addClass('hidden');
                        $("#view_paramCategory").removeClass('show').addClass('hidden');
                        $("#view_paramAgency").removeClass('show').addClass('hidden');
                        $("#view_paramMun").removeClass('show').addClass('hidden');
                        $("#view_paramProv").removeClass('hidden').addClass('show');
                        $("#view_paramBrgy").removeClass('show').addClass('hidden');
                        $("#view_accidentType").removeClass('show').addClass('hidden');
                   }else if($('#paramNavSelect').find(":selected").text()==="Accident Types"){
                       $("#view_paramEstab").removeClass('show').addClass('hidden');
                        $("#view_paramCategory").removeClass('show').addClass('hidden');
                        $("#view_paramAgency").removeClass('show').addClass('hidden');
                        $("#view_paramMun").removeClass('show').addClass('hidden');
                        $("#view_paramProv").removeClass('show').addClass('hidden');
                        $("#view_paramBrgy").removeClass('show').addClass('hidden');
                        $("#view_accidentType").removeClass('hidden').addClass('show');
                   }
                });
                
                
                
                
                
                $('#aSelect').on('click', function(){
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('hidden').addClass('show');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#cSelect').on('click', function(){                    
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('hidden').addClass('show');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#eSelect').on('click', function(){                    
                    $("#view_paramEstab").removeClass('hidden').addClass('show');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#bSelect').on('click', function(){                    
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('hidden').addClass('show');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#mSelect').on('click', function(){                    
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('hidden').addClass('show');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#pSelect').on('click', function(){                     
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('hidden').addClass('show');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('show').addClass('hidden');
                });
                $('#aTSelect').on('click', function(){                                        
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('hidden').addClass('show');
                });
                $('#aTSelect').on('click', function(){                    
                    $("#view_paramEstab").removeClass('show').addClass('hidden');
                    $("#view_paramCategory").removeClass('show').addClass('hidden');
                    $("#view_paramAgency").removeClass('show').addClass('hidden');
                    $("#view_paramMun").removeClass('show').addClass('hidden');
                    $("#view_paramProv").removeClass('show').addClass('hidden');
                    $("#view_paramBrgy").removeClass('show').addClass('hidden');
                    $("#view_accidentType").removeClass('hidden').addClass('show');
                });                
                /*
                 * Binding click event on hazard maps
                 */
                
                
                $('#hApayaoSelect').on('click', function(){
                    $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                    $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                    $("#hazMap_viewApayao").removeAttr("style");
                });
                $('#hAbraSelect').on('click', function(){
                    $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                    $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                    $("#hazMap_viewAbra").removeAttr("style");
                });
                $('#hBenguetSelect').on('click', function(){
                    $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                    $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                    $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").removeAttr("style");
                });
                $('#hKalingaSelect').on('click', function(){
                    $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                    $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                    $("#hazMap_viewIfugao").removeAttr("style");
                });
                $('#hIfugaoSelect').on('click', function(){
                    $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                    $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").removeAttr("style");
                });
                $('#hMountainProvinceSelect').on('click', function(){
                    $("#hazMap_viewAbra").attr("style","visibility:hidden;");
                    $("#hazMap_viewBenguet").attr("style","visibility:hidden;");
                    $("#hazMap_viewIfugao").attr("style","visibility:hidden;");
                    $("#hazMap_viewKalinga").attr("style","visibility:hidden;");
                    $("#hazMap_viewApayao").attr("style","visibility:hidden;");
                    $("#hazMap_viewMountainProvince").removeAttr("style");
                });                

                $("#AnewNavHome").on("click",function(){
                    $("#dir_view").removeClass('show').addClass('hidden');
                    $("#dirMap_view").attr("style","visibility:hidden;");
                    $("#db_view").removeClass('show').addClass('hidden');
                    $("#social_view").removeClass('show').addClass('hidden');
                    $("#loc_ view").removeClass('show').addClass('hidden');                    
                
                    });
            };
    
        </script>
        <style type="text/css">
            .show{
                display: block;
            }
            .hidden{
                display: none;
            }
            .text_input{
                text-align: center;
            }
        </style>   
    </head>
    <body>
        <input type='hidden' id='testKey' value='<?php echo $key?>'>
        <?php include('paramScript.php');?>
        <?php include('styles_script.php');?>
        <div id="oldNav" class="hidden">
            <?php include('navigation.php')?>
        </div>
        
        <div id="container">
            
            <?php include('header.php'); ?>
            
            <div id="viewsContainer">
                
                <div id="home_view" class="show">
                    <?php include('home.php')?>
                </div>
                
                <div id="db_view" class="hidden" >
                    <?php include('admin_script.php'); ?>
                    <?php include('view_accounts.php'); ?>
                </div>                
                
                <div id="dirMap_view" style="width:1024px; height:560px; visibility:hidden;">                    
                    <?php include('view_establishmentMap.php')?>
                </div>
                
                <div id="hazNav_view" class="hidden" >
                    <?php include('hazNav.php')?>
                </div>
                    
                <div id="hazMap_view" style="width:1024px; height:560px; visibility:hidden;">                    
                    <?php include('view_hazardMaps.php')?>
                </div>
                
                <div id="dir_view" class="hidden">                       
                    <?php include('view_directory.php'); ?>
                </div>

                <div id="social_view" class="hidden">
                    <?php include('view_facebook.php'); ?>
                </div>
                
                <div id="inbox_view" class="hidden">
                    <?php include('view_reports.php'); ?>                   
                </div>
                
                <div id="logs_view" class="hidden">
                    <?php include('view_logs.php'); ?>                   
                </div>
                

                <div id="contacts_view" class="hidden">
                    <?php include('view_contacts.php'); ?>                   
                </div>
                
                <div id="maps_view" style="width:100%; height:100%; visibility:hidden;"> 
                    <!-- width: 100%; height: 100%;  -->
                    <?php include ('adminMap_script.php');?>
                    
                </div>
                
            
                <div id="loc_view" class="hidden">               
                    <?php include('view_parameters.php')?>
                </div>
                
<!--                <div id="repgen_view" class="hidden">
                    <?php include('reportsGeneration.php')?>
                    <?php include('periodicReports.php')?>
                </div>-->
            </div>
        </div>

    </body>
</html>

<script>
    $(document).ready(function(){                       
        var cookieValue = $.cookie("test");
            if(cookieValue=="accts"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('dm').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            
            }else if(cookieValue=="social"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('social').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';;
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
            }else if(cookieValue=="contacts"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('contacts').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="inbox"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('inbox').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="loc"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('loc').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="logs"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('logs').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="mapHaz"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('mapHaz').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="maps"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('maps').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }else if(cookieValue=="dir"){
                document.getElementById('container').className='';
                document.getElementById('container').className='show';
                document.getElementById('dir').click();
                document.getElementById('homehome').className='hidden';
                document.getElementById('viewsContainer').className='';
                document.getElementById('viewsContainer').className='show';
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
            }
    });
    
    
</script>