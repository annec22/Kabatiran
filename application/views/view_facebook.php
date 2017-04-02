<div class="main-content">
    <div id="bull-drop-arrow"></div>
    <div id="bulletin-cont" class="hideblock">
     <form name="bullForm" id="bullForm">
        <p class="bull-highlight-text">Bulletin Message:</p>
        <textarea id="bullTxt" name="bullTxt"></textarea>
        <div id="select-province-cont">
<!--            <span id="select-province-text">Post For Province(CAR Region): </span>-->
              <select id="bullProv">
                  <option selected="selected" value="ALL">All</option>
                  <?php if (count($province) > 0) {;?>
                  <?php foreach ($province as $row) : ?>
                      <option value="<?php echo $row->province ?>"><?php echo $row->province ?></option>
                  <?php endforeach; ?>
                  <?php };?>
               </select> 
        </div>
        <input type="button" id="bulletinBtn" value="Post" onclick="copyTxt();" />
     </form>
    <div id="social_cb">
        <!--FACEBOOK CHECKBOX-->
        <div id="postofb" class="posto-opt">
          <?php if (@$user_profile): 
            if ($fbusertype == 'admin') :       
                echo '<div id="fbcbdes" class="socialcbdes"></div><input type="checkbox" id="facebookCB" name="socialMedia[]" value="fb" />';
                echo '<div id="facebookPostForm" class="hidden">';
                echo '<form name="fbForm" action="" method="post">';
                echo 'Select Page: <select name="pageid">';
                    echo '<option value="382887808505099">Informapp</option>';
                echo '</select>';
                echo '<br />Message: <textarea name="msg" id="fbtxt"></textarea>';
                echo '<br /><input type="submit" id="fbSubmit" value="Post to wall" />';
                echo '</form>';
                echo '</div>';
            elseif($fbusertype == 'nonAdmin'):
                echo 'Please make sure that the Facebook user is an Administrator of the Informapp Page<br />';
            endif;?>
            <div id="fblogout" class="bull-callout"><a href="<?= $logout_url?>">Facebook Logout</a></div>
        <?php else: ?>
            <div id="login-fb" class="postto-opt socialcbdes" onclick="location.href='<?= $login_url ?>';">
                <div id="login-fb-noti"></div>
            </div>  
            <!--<span class="posto-lab">Login to post to Kabatiran Page</span>-->
        <?php endif; ?>
        </div>
        <div id="postotwitter" class="posto-opt">
            <div id="twittercbdes" class=socialcbdes></div>
            <input type="checkbox" id="twitterCB" name="socialMedia[]" value="twitter" />
            <!--<span class="posto-lab">Twitter (Maximum of 140 Characters)</span>-->
        </div>
    </div>
    </div>    
    <div id="spinnerBull"></div>
    <div id="table-wrapper">
        <div id="main-table">
            <input type="button" value="Delete" id="deleteBullButton" /> 
        <table id="postTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th><input type="checkbox" id="select-allBulletin"></th>
                    <th>Post Message</th>
                    <th>Date</th>     
                    <th>Province</th>
                </tr>
            </thead>

            <tbody id="table-body">
               <?php if (count($bulletinRes) > 0) {;?>
               <?php foreach ($bulletinRes as $row) : ?>
                    <tr class="body-row">
                        <td id="<?php echo $row->bulletinID; ?>"><input type="checkbox" class="checkmeBulletin" id="reportIdentifier" value="<?php echo $row->bulletinID; ?>"></td>
                        <td class ="bull" id="bMsg"><?php echo $row->postMsg ?></td>
                        <td class="bull" id="bDate"><?php echo date_format(date_create($row->postdate), 'M. d, Y g:ia'); ?></td>
                        <td class="bull" id="bProv"><?php echo $row->province ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php };?>
            </tbody>
        </table>
        </div>
        <div id="info-nav">
        </div>
    </div>
</div>

