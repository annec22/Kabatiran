<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin System</title>
        <script src="<?php echo base_url('scripts/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.bpopup.min.js'; ?>"></script>
        
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/login.css'; ?>" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'styles/mobile.css'; ?>"/>
    </head>
    
    <body id="adminLoginBody">
        <div id="mainContainerLogin">
            <div id="loginTitle">
                <h1 class="loginTitle">Kabatiran</h1>
                <p class="loginTitle">Admin System Login</p>
            </div>
            <div id="adminLoginForm">    
                <form method="POST" action="<?php echo base_url() . 'main'; ?>">
                    <p>
                        <input type="text" name="adminUsername" id="adminUsername" autocomplete="off" placeholder="User ID" maxlength="10" required/>
                    </p>
                    <p>
                        <input type="password" name="adminPassword" id="adminPassword" autocomplete="off" placeholder="Password" maxlength="10" required/>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <input type="Submit" value="Log in" id="adminLoginButton">
                    </p>
                </form>
                
                <?php if (validation_errors() || $errorAdminLogin == TRUE) { ?>
                        <?php echo validation_errors(); ?>
                        <div id="errorLogin" style="display:none">
                            <p>Invalid Username or Password</p>
                        </div>
                <?php } ?>

                <?php if ($errorAdminLogin == TRUE) { ?>
                    <script>
                        jQuery(document).ready(function(){
                            jQuery('#errorLogin').css("display","inline");
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
    </body>
</html>