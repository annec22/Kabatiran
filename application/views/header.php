<script>
    function logout(){
        window.location = "<?php echo base_url() . 'main'; ?>";
    }
</script> 
<!-- change password -->

    <div class="PopUpWindowChangePw" style="display:none;">

         <a href="#" class="b-close" id="close"><img src="<?php echo base_url() ?>styles/pictures/x.png" width="40"/></a>
         <div id="popUp-content">
            <div id="popTitle"><span id="title">Change Password</span></div>
            <div id="popUp-table">
                <table id="form_input_change_password" class="popUp">
                    <tbody id="popBody">
                        <tr>
                            <input type="hidden" id="cPwUser" class="cPwUser" value="<?php echo $this->session->userdata("adminID");?>"/> 
                            <td id="pleft" class="text_input"><label>Enter Old Password:</label></td> 
                            <td id="pright"><input type="password" id="oPw" name="oPw" class="oPw" size="30" maxlength="8" required /> </td>
                        </tr>
                        <tr>
                            <td id="pleft" class="text_input"><label>Enter New Password:</label></td> 
                            <td id="pright"><input type="password" id="nPw" name="nPw" class="nPw" size="30" maxlength="8" required /></td>
                        </tr>
                        <tr>
                            <td id="pleft" class="text_input"><label>Confirm Password:</label></td> 
                            <td id="pright"><input type="password" id="rPw" name="rPw" class="rPw" size="30" maxlength="8" required /> </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div id="buttons">
                <button id="ClearPw" class="cancel b-close"></button>
                <button id="SavePw" class="save b-close"></button>   
            </div>
         </div>
    </div>

<!--HEADER CONTAINER-->
<div class="header-cont">
<!--HEADER-->
<div class="header">
    <!--NAVIGATION-->
    <div class="newNav" id="newNavId">
        <!--MENU HEAD-->
        <div id="menuHead" class="inactive">
            <a href="" onclick="return false;">
                <p class="animateSlide"></p>
            </a>
        </div>
        <!--END OF MENU HEAD-->
        
        <!--MENU BODY-->
        <ul id="newNavUl" class="newNav_drop">
            <!--HOME-->
            <a href="" id="AnewNavHome" class="navItem" onclick="
                
                document.getElementById('viewsContainer').className='hidden';
                document.getElementById('viewsContainer').className='show';
                document.getElementById('dm').click();
                document.getElementById('homehome').className='';
                document.getElementById('homehome').className='show';
                
                return false;
            ">
                <li id="newNavHome" href="" class="activeNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/HomeTransparent.png'; ?>"/>
                    <span>Home</span>
                </li>
            </a>
            <!--ACCOUNTS-->
            <div id="accNav">
                <a href="" id="AnewNavAccounts" class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('dm').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
                ">
                <li id="newNavAccounts" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/AccountsManagementTransparent.png'; ?>"/>
                    <span>Accounts</span>
                </li>
            </a>
            </div>
            
            <!--BULLETIN-->
            <a href="" id="AnewNavBulletin"class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('social').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
            ">
                <li id="newNavBulletin" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/BulletinBoardTransparent.png'; ?>"/>
                    <span>Bulletin<span>
                </li>
            </a>
            <!--DIRECTORY-->
            <a href="" id="AnewNavDirectory" class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('contacts').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
            ">
                <li id="newNavDirectory" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/DirectoryManagementTransparent.png'; ?>"/>
                    <span>Directory</span>
                </li>
            </a>
            <!--INBOX-->
            <a href="" id="AnewNavInbox" class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('inbox').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
            ">
                <li id="newNavInbox" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/ReportsManagementTransparent.png'; ?>"/>
                    <span>Inbox</span>
                </li>
            </a>
            <!--LOCATIONS-->
            <a href="" id="AnewNavLocations" class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('loc').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
            ">
                <li id="newNavLocations" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/LocationsManagementTransparent.png'; ?>"/>
                    <span>Data Mgmt</span>
                </li>
            </a>
            <!--LOGS-->
            <a href="" id="AnewNavLogs" class="navItem" onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('logs').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
            ">
                <li id="newNavLogs" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/LogsTransparent.png'; ?>"/>
                    <span>Logs</span>
                </li>
            </a>
            <!--MAPS-->            
            <div id="AnewNavMaps" class="navItem">
            <div id="AnewNavMaps" class="navItem" onclick="mapClick(); return false;">
                <li id="newNavMaps" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapManagementTransparent.png'; ?>"/>
                    <span>Maps</span>
                </li>
                <div id="mapsmenu">
                <li id="mapsmenuHazard" href="" class="mapsmenuitem" onclick="                            
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('mapHaz').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
                ">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                    <span>Hazard</span>
                </li>

                <li id="mapsmenuIncident" href="" class="mapsmenuitem"  onclick="
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('maps').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
                    return false;
                ">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                    <span>Incident</span>
                </li>

                <li id="mapsmenuDirectory" href="" class="mapsmenuitem" onclick="                            
                    document.getElementById('container').className='';
                    document.getElementById('container').className='show';
                    document.getElementById('dir').click();
                    document.getElementById('homehome').className='hidden';
                    document.getElementById('viewsContainer').className='';
                    document.getElementById('viewsContainer').className='show';
            return false;">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                    <span>Directory</span>
                </li>
                </div>
<!--                <li id="newNavMaps" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapManagementTransparent.png'; ?>"/>
                    <span>Maps</span>
                    <ul class="mapsmenu animateSlide" id="mapsmenu">
                        <li id="mapsmenuHazard" href="" class="mapsmenuitem" onclick="                            
                            document.getElementById('container').className='';
                            document.getElementById('container').className='show';
                            document.getElementById('mapHaz').click();
                            document.getElementById('homehome').className='hidden';
                            document.getElementById('viewsContainer').className='';
                            document.getElementById('viewsContainer').className='show';
                            return false;
                        ">
                            <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                            <span>Hazard</span>
                        </li>
                      
                        <li id="mapsmenuIncident" href="" class="mapsmenuitem"  onclick="
                            document.getElementById('container').className='';
                            document.getElementById('container').className='show';
                            document.getElementById('maps').click();
                            document.getElementById('homehome').className='hidden';
                            document.getElementById('viewsContainer').className='';
                            document.getElementById('viewsContainer').className='show';
                            return false;
                        ">
                            <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                            <span>Incident</span>
                        </li>
                        
                        <li id="mapsmenuDirectory" href="" class="mapsmenuitem" onclick="                            
                            document.getElementById('container').className='';
                            document.getElementById('container').className='show';
                            document.getElementById('dir').click();
                            document.getElementById('homehome').className='hidden';
                            document.getElementById('viewsContainer').className='';
                            document.getElementById('viewsContainer').className='show';
                    return false;">
                            <img src="<?php echo base_url() . 'styles/pictures/header_pictures/MapsIcon.png'; ?>"/>
                            <span>Directory</span>
                        </li>
                    </ul>
                </li>
                </li>-->
            </div>
<!--            REPORTS GENERATION-->                       
            <a href="<?php echo base_url().'periodicReports'?>" id="AnewNavRepGen" class="navItem" >
                <li id="newNavRepGen" href="" class="inactiveNewNav">
                    <img src="<?php echo base_url() . 'styles/pictures/header_pictures/TipsTrasparent.png'; ?>"/>
                    <span>Reports</span>
                </li>
            </a>
        </ul>
        
        <!--END OF MENU BODY-->
    </div>
    <!--END OF NAVIGATION-->
    
    <!--LOGO-->
    <div class="logoContainer">
        <img src="<?php echo base_url() . 'styles/pictures/header_pictures/themedlogo2.png'; ?>" id="projectLogo"/>
    </div>
    <!--END OF LOGO-->

    <!--TITLE-->
    <div id="projectAdminTitleContainer">
        <span id="projectAdminTitle">Kabatiran</span>
        <span id="projectAdminSubtitle">Administrator System</span>
    </div>
    <!--END OF TITLE-->

    <!--USER CONTAINER-->
    <div class="userContainer" id="userContainer">      
            <div class="welcomeContainer">
                
                <div id="accountInfoButton" class="accountInfoButton">
                    <div id="accIBHead">
                        <a href="" onclick="return false;">
                            <p class="animateSlide"></p>
                        </a>
                    </div>
                    <div id="ace">
                        <ul id="ulAccSetting" class="aceNavDrop">
                            <a href="" onclick="return false;"><li id="accInfo"><?php echo $adminFullName?></li></a>
                            <a href="" id="settings" class="add-data changePwTrigger changePwButton"><li>Change Password</li></a>
                        </ul>
                    </div>
                </div>
                
            </div>  
        
            <div class="logoutContainer">
                <a href="" id="logout" onclick="logout(); return false;" title="Logout">
                    <p class="animateSlide"></p>
                </a>
            </div>
    </div>
    <!--END USER CONTAINER-->
</div>
<!--END OF HEADER-->
</div>
<!--END OF HEADER CONTAINER-->

<!--PopUp of account information-->
<div class="PopUpWindowAccInfo" style="display:none;">
    <div id="popUp-content">
        <div id="popTitle"><span id="title">Account Information</span></div>
        <div id="popUp-table">
            <table id="form_input_add_account" class="popUp">
                <tbody id="popBody">
                    <tr>
                        <td id="pleft" class="text_input"><label>Name:</label></td> 
                        <td id="pright"><p id="fullName"></p> </td>
                    </tr>
                    <tr>
                        <td id="pleft" class="text_input"><label>E-mail:</label></td> 
                        <td id="pright"><p id="emailinfo"></p></td>
                    </tr>
                    <tr>
                        <td id="pleft" class="text_input"><label>Username:</label></td> 
                        <td id="pright"><p id="usernameinfo"></p> </td>
                    </tr>
                    <tr>
                        <td id="pleft" class="text_input"><label>Account type:</label></td> 
                        <td id="pright"><p id="typeinfo"></p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="buttons">
            <button id="ClearAcc" class="cancel b-close"></button> 
        </div>
     </div>
</div>
<!--END OF HEADER CONTAINER-->