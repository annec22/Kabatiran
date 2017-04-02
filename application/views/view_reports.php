
<?php include "inboxScript.php"?>
<div class="main-content" id="repInboxMainCont">
<div class="reportsNavigation innerNav">  
        <span class="innerNavText">Go to:</span>
        <select id="inboxNavSelect" class="innerNavSel">
            <option id="inbox" >Inbox</option>
            <option id="confirmed" >Confirmed</option>
            <option id="trash" >Trash</option>
            <option id="spam" >Spam</option>
        </select>
        </div>
        
        <div id="table-wrapper">
            <div class="message" style="display: none;"></div>
            
            <div id="main-table">
                 <div class="PopUpWindowRep" style="display:none;">
                     <div id="reportClose">
                     <a href="#" class="b-close" id="close"><img src="<?php echo base_url() ?>styles/pictures/x.png" width="40"/></a>
                     </div>
                     <div id="popUp-content">
                        <div id="popTitle"><span id="title">Report Details</span></div>
                        <div id="popUp-table">
                            <table id="form_input_view_rep" class="popUp">
                                <tbody id="popBody">
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Reporter Name: </p></td>
                                        <td id="pright"><p class ="reporterName"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p> Report Timestamp: </p></td>
                                        <td id="pright"><p class ="reportTimestamp"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p> Incident Timestamp: </p></td>
                                        <td id="pright"><p class ="incidentTimestamp"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Location: </p></td>
                                        <td id="pright"><p class ="reportLocation"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Barangay: </p></td>
                                        <td id="pright"><p class ="reportBarangay"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Classification: </p></td>
                                        <td id="pright"><p class ="reportClassification"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Description: </p></td>
                                        <td id="pright"><p class ="reportDescription"></p></td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Image: </p></td>
                                        <td id="pright">
                                            <div class="image-row">
                                                <div class="image-set">
                                                    <div id="generateImage"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="pleft" class="text_input"><p>Audio: </p></td>
                                        <td id="pright">
                                            <div id="generateAudio"></div>
                                        </td>
                                    </tr>
                                 </tbody>
                            </table>
                        </div>
                     </div>
                 </div>
                <div class="repInbox-options" id="reptInbox-options">
                    <input title="Send to Trash" type="button" id="trashButton" /> 
                    <input title="Mark as Confirmed" type="button" id="confirmButton"/> 
                    <input title="Restore Report" type="button" id="restoreButton" class="hidden"/> 
                    <input title="Mark as Spam" type="button" id="spamButton" /> 
                    <input title="Delete" type="button" id="deleteButton" class="hidden" /> 
                    <input title="Reload" type="button" id="reload" /> 
                </div>
                
                <!-- data reporting countries -->
                    <div id="inboxTable" class="show">
                        <table id="repInboxTable" >
                            <thead id="table-heading"> 
                                <tr>
                                    <th></th>
                                    <th>Incident Type</th>
                                    <th></th>
                                    <th></th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th></th>       
                                    <th></th> 
                                    <th></th>
                                </tr>
                                <tr id="heading-row">
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Incident Type</th>
                                    <th>Barangay</th>
                                    <th>Municipality/City</th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th>Incident Time</th>                
                                    <th>Report Status</th>
                                    <th>Count</th>
                                </tr>       
                            </thead>

                            <tbody id="table-body" >
                                <?php
                                if (count($inboxRes) > 0) {
                                    ;
                                    ?>
                                <?php foreach($inboxRes as $cols): ?>
                                <tr class="body-row" style="background-color:<?php echo $cols->readStatus; ?>">
                                    <td id="<?php echo $cols->reportID; ?>" class="inbox"><input type="checkbox" class="checkme" id="reportIdentifier" value="<?php echo $cols->reportID; ?>"></td>
                                    <td id="viewRepTrigger" class="inbox" name="<?php echo $cols->reportID; ?>"><div id="priority<?php echo $cols->reporter?>"></div><?php echo $cols->classification; ?></td>
                                    <td id="viewRepTrigger1" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo $cols->barangay; ?></td>
                                    <td id="viewRepTrigger2" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo $cols->municity; ?></td>
                                    <td id="viewRepTrigger3" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo $cols->province; ?></td>
                                    <td id="viewRepTrigger4" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentDate), 'M. d, Y'); ?></td>
                                    <td id="viewRepTrigger5" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentTime), 'g:ia'); ?></td>                  
                                    <td id="viewRepTrigger6" class="inbox" name="<?php echo $cols->reportID; ?>"><?php echo $cols->reportStatus; ?></td>
                                    <td id="viewRepTrigger7" ></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>

                    <!--TRASH-->
                    <div id="trashTable" class="hidden">
                        <table id="repTrashTable">
                            <thead id="table-heading">
                                <tr>
                                    <th></th>
                                    <th>Incident Type</th>
                                    <th></th>
                                    <th></th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th></th>       
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr id="heading-row">
                                    <th><input type="checkbox" id="select-allTrash"></th>
                                    <th>Incident Type</th>
                                    <th>Barangay</th>
                                    <th>Municipality/City</th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th>Incident Time</th>                
                                    <th>Report Status</th>
                                    <th>Count</th>
                                </tr>
                            </thead>

                            <tbody id="table-body" class="trashTableBody">  
                                <?php
                                if (count($trashRes) > 0) {
                                    ;
                                    ?>
                                <?php foreach($trashRes as $cols): ?>
                                <tr class="body-row" style="background-color:<?php echo $cols->readStatus; ?>" >
                                    <td id="<?php echo $cols->reportID; ?>" class="trash"><input type="checkbox" class="checkmeTrash" id="reportIdentifier" value="<?php echo $cols->reportID; ?>"></td>
                                    <td id="viewTrashTrigger" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo $cols->classification; ?></td>
                                    <td id="viewTrashTrigger1" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo $cols->barangay; ?></td>
                                    <td id="viewTrashTrigger2" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo $cols->municity; ?></td>
                                    <td id="viewTrashTrigger3" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo $cols->province; ?></td>
                                    <td id="viewTrashTrigger4" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentDate), 'M. d, Y'); ?></td>
                                    <td id="viewTrashTrigger5" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentTime), 'g:ia'); ?></td>                  
                                    <td id="viewTrashTrigger6" class="trash" name="<?php echo $cols->reportID; ?>"><?php echo $cols->reportStatus; ?></td>
                                    <td id="viewTrashTrigger7" ></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php }; ?>
                            </tbody>

                        </table>
                    </div>

                    <!---SPAM--->                   
                    <div id="spamTable" class="hidden">
                        <table id="repSpamTable">
                           <thead id="table-heading">
                               <tr>
                                    <th></th>
                                    <th>Incident Type</th>
                                    <th></th>
                                    <th></th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th></th>       
                                    <th></th>
                                    <th></th>
                               </tr>
                               <tr id="heading-row">
                                   <th><input type="checkbox" id="select-allSpam"></th>
                                   <th>Incident Type</th>
                                   <th>Barangay</th>
                                   <th>Municipality/City</th>
                                   <th>Province</th>
                                   <th>Incident Date</th>
                                   <th>Incident Time</th>                
                                   <th>Report Status</th>
                                   <th>Count</th>
                               </tr>
                           </thead>

                           <tbody id="table-body" class="spamTableBody">  
                                <?php
                                if (count($spamRes) > 0) {
                                    ;
                                    ?>
                                <?php foreach($spamRes as $cols): ?>
                                <tr class="body-row" style="background-color:<?php echo $cols->readStatus; ?>">
                                    <td id="<?php echo $cols->reportID; ?>" class="spam"><input type="checkbox" class="checkmeSpam" id="reportIdentifier" value="<?php echo $cols->reportID; ?>"></td>
                                    <td id="viewSpamTrigger" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->classification; ?></td>
                                    <td id="viewSpamTrigger1" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->barangay; ?></td>
                                    <td id="viewSpamTrigger2" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->municity; ?></td>
                                    <td id="viewSpamTrigger3" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->province; ?></td>
                                    <td id="viewSpamTrigger4" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->incidentDate; ?></td>
                                    <td id="viewSpamTrigger5" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->incidentTime; ?></td>                  
                                    <td id="viewSpamTrigger6" class="spam" name="<?php echo $cols->reportID; ?>"><?php echo $cols->reportStatus; ?></td>
                                    <td id="viewSpamTrigger7" ></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php }; ?>
                           </tbody>

                       </table>
                    </div>
                  
                  <!---CONFIRMED--->
                  <div id="confirmedTable" class="hidden">
                        <table id="repConfTable">
                           <thead id="table-heading">
                               <tr>
                                    <th></th>
                                    <th>Incident Type</th>   
                                    <th></th>
                                    <th></th>
                                    <th>Province</th>
                                    <th>Incident Date</th>
                                    <th></th>       
                                    <th></th> 
                                    <th></th>
                               </tr>
                               <tr id="heading-row">
                                   <th><input type="checkbox" id="select-allConf"></th>
                                   <th>Incident Type</th>
                                   <th>Barangay</th>
                                   <th>Municipality/City</th>
                                   <th>Province</th>
                                   <th>Incident Date</th>
                                   <th>Incident Time</th>                
                                   <th>Report Status</th>
                                   <th>Count</th>
                               </tr>
                           </thead>

                           <tbody id="table-body" class="confTableBody">  
                                <?php
                                if (count($confRes) > 0) {
                                    ;
                                    ?>
                                <?php foreach($confRes as $cols): ?>
                                <tr class="body-row" style="background-color:<?php echo $cols->readStatus; ?>">
                                    <td id="<?php echo $cols->reportID; ?>" class="conf"><input type="checkbox" class="checkmeConfirmed" id="reportIdentifier" value="<?php echo $cols->reportID; ?>"></td>
                                    <td id="viewConfTrigger" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo $cols->classification; ?></td>
                                    <td id="viewConfTrigger1" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo $cols->barangay; ?></td>
                                    <td id="viewConfTrigger2" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo $cols->municity; ?></td>
                                    <td id="viewConfTrigger3" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo $cols->province; ?></td>
                                    <td id="viewConfTrigger4" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentDate), 'M. d, Y'); ?></td>
                                    <td id="viewConfTrigger5" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo date_format(date_create($cols->incidentTime), 'g:ia'); ?></td>                  
                                    <td id="viewConfTrigger6" class="conf" name="<?php echo $cols->reportID; ?>"><?php echo $cols->reportStatus; ?></td>
                                    <td id="viewConfTrigger7" ></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php }; ?>
                           </tbody>

                       </table>
                    </div>
                </div>
                <div id="info-nav">

                </div>
            </div>
        </div>

