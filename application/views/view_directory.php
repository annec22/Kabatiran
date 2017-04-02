<div class="main-content">     
    <div id="table-wrapper">        
    </div>        
        <div id="main-table">
            <div class="PopUpWindowEDir" style="display:none;">
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Edit Establishment</span></div>
                    <div id="popUp-table">
                        <table id="form_input_edit_dir" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft" class="text_input"><label>Establishment Name:</label></td> 
                                    <td id="pright"><input type="text" id="estabNameEDir"/></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Description:</label></td> 
                                    <td id="pright"><textarea id="eDescription"></textarea></td>
                                </tr> 
                                <tr>
                                    <input type="hidden" id="eEstabID" value=""/>
                                    <input type="hidden" id="eLocationID" value=""/>
                                    <input type="hidden" id="eDirectoryID" value=""/>
                                    <td id="pleft"><label>Agency:</label></td>
                                    <td id="pright">
                                        <select id="agencyListEDir">
                                            <?php  foreach ($agencyList as $item){
                                                echo '<option value="'.$item["agencyID"].'">'.$item["agencyName"].'</option>';
                                            }?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Contact Number:</label></td> 
                                    <td id="pright"><input type="text" id="numEDir" name="numEDir" class="numEDir" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Specifics:</label></td> 
                                    <td id="pright"><input type="text" id="specEDir" name="specEDir" class="specEDir" size="30" maxlength="30" required /></td>
                                </tr>                                                               
                                <tr>
                                    <td id="pleft"><label>Establishment Type:</label></td> 
                                    <td id="pright">
                                        <select id="eTypeEDir">
                                            <?php foreach ($estTypes as $item){
                                                echo '<option value='.$item["esTypeID"].'>'.$item["classification"].'</option>';
                                            }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Province:</label></td> 
                                    <td id="pright">
                                        <select id="ProvEDir">
                                            <option value="">Choose province</option>
                                            <?php foreach ($provinceList as $item){
                                                echo '<option value='.$item["provinceID"].'>'.$item["province"].'</option>';
                                            }?>
                                        </select>                                        
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Municipality/ City:</label></td> 
                                    <td id="pright">
                                        <select id="munCityEDir">
                                            <option value="">Choose municipality</option>
                                            <?php foreach ($mCities as $item){
                                                echo '<option value='.$item["muniCityID"].'>'.$item["name"].'</option>';
                                            }?>
                                        </select>                                        
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Barangay:</label></td> 
                                    <td id="pright">
                                        <select id="brgyEDir">
                                            <option value="">Choose barangay</option>
                                            <?php foreach ($barangays as $item){
                                                echo '<option value='.$item["idbarangay"].'>'.$item["name"].'</option>';
                                            }?>
                                        </select>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>X Coordinate:</label></td> 
                                    <td id="pright"><input type="text" id="xECoordinate" readonly/></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Y Coordinate:</label></td> 
                                    <td id="pright"><input type="text" id="yECoordinate" readonly/></td>                                    
                                    <input type="hidden" id="markerClassification" value=""/>
                                    <input type="hidden" id="markerID" value=""/>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="ClearEDir" class="cancel b-close"></button>
                        <button id="SaveEDir" class="save b-close"></button>   
                        <button id="DeleteEDir" class="delete b-close">DELETE</button>   
                    </div>                    
                 </div>                 
            </div>
            
            <div class="PopUpWindowDir" style="display:none;">
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Establishment</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_dir" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <input type="hidden" id="munCityDirHolder" value=""/>
                                    <input type="hidden" id="brgyDirHolder" value=""/>
                                    <input type="hidden" id="dirIDHolder" value=""/>
                                    <input type="hidden" id="agencyListDirHolder" value=""/>
                                    <td id="pleft" class="text_input"><label>Establishment Name:</label></td> 
                                    <td id="pright"><input type="text" id="estabNameDir"/></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Description:</label></td> 
                                    <td id="pright"><textarea id="dirDescription"></textarea></td>
                                </tr> 
                                <tr>
                                    <td id="pleft"><label>Establishment Type:</label></td> 
                                    <td id="pright">
                                        <select id="eTypeDir">
                                            <?php foreach ($estTypes as $item){
                                                echo '<option value='.$item["esTypeID"].'>'.$item["classification"].'</option>';
                                            }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Agency:</label></td>
                                    <td id="pright">
                                        <select id="agencyListDir">                                            
                                        </select></td>
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Contact Number:</label></td> 
                                    <td id="pright">
                                        <select id="numDir">
                                            <?php  foreach ($probContacts as $item){
                                                echo '<option value="'.$item["directoryID"].'">'.$item["contactNo"].'</option>';
                                            }?>
                                        </select>
                                        <!--<input type="text" id="numDir" name="numDir" class="numDir" size="30" maxlength="21" required />--> 
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Specifics:</label></td> 
                                    <td id="pright"><input type="text" id="specDir" name="specDir" class="specDir" size="30" maxlength="30" required /></td>
                                </tr>                                                              
                                <tr>
                                    <td id="pleft" class="text_input"><label>Province:</label></td> 
                                    <td id="pright">
                                        <option value=""></option> 
                                        <select id="ProvDir">
                                            <option value="">Choose province</option>
                                            <?php foreach ($provinceList as $item){
                                                echo '<option value='.$item["provinceID"].'>'.$item["province"].'</option>';
                                            }?>
                                        </select>                                        
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Municipality/ City:</label></td> 
                                    <td id="pright">
                                        <select id="munCityDir">                                                                                                                                    
                                        </select>                                        
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Barangay:</label></td> 
                                    <td id="pright">                                                                                
                                        <select id="brgyDir">                                            
                                        </select>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>X Coordinate:</label></td> 
                                    <td id="pright"><input type="text" id="xCoordinate" readonly/></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Y Coordinate:</label></td> 
                                    <td id="pright"><input type="text" id="yCoordinate" readonly/></td>
                                    <input type="hidden" id="dirMarkerID" value=""/>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="ClearDir" class="cancel b-close"></button>
                        <button id="SaveDir" class="save b-close"></button>   
                    </div>                    
                 </div>                 
            </div>            
            
            <!--folds - table-->
            <div>
            <!--<table id="dirTable">
                <thead id="table-heading">
                    <tr id="heading-row">
                        <th>Agency ID</th>
                        <th>Contact Number</th>
                        <th>Specifics</th>                
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                <tbody id="table-body">
                    <?php
                    if (count($dirRes) > 0) {
                        ;
                        ?>
                    <?php foreach($dirRes as $cols): ?>
                    <tr class="body-row">
                        <td class="dir"><?php echo $cols->agencyID; ?></td>
                        <td class="dir"><?php echo $cols->contactNo; ?></td>
                        <td class="dir"><?php echo $cols->specifics; ?></td>                  
                        <td class="dir"><a class="editDir" href=""><pre id="edit-opt">    </pre></a></td>
                        <td class="dir"><a class="deleteDir" href=""><pre id="del-opt">    </pre></a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php }; ?>
                </tbody>
                
            </table> -->
           </div>
        </div>
    </div>
    

