<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewAccidentTypeTrigger dataTables_add" id="new_inf_accidentType">Add Accident Type</button>
            <div class="PopUpWindowAccidentType" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Accident Type</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_accidentType" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft"><label>Accident Type:</label></td>
                                    <td id="pright"><input type="text" id="aTypeName" name="aTypeName" class="aTypeName" size="30" maxlength="21" required /></td>                                    
                                </tr>                                                              
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearAccidentType" class="cancel b-close"></button>
                        <button id="saveAccidentType" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="accidentTypeTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Classification</th>
                    <th>Color</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>                
            </thead>
            <tbody id="table-body">
                <?php foreach ($accidentTypeList as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["typeID"].'</td>
                            <td>'.$item["classification"].'</td>
                            <td>'.$item["color"].'</td>
                            <td>'.$item["userfile"].'</td>
                            <td><a class="editAccidentType" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteAccidentType" href=""><pre id="del-opt">    </pre></a></td>
                            <input type="hidden" id="colorVal" value=""/>
                            <input type="hidden" id="imageName" value=""/>
                            <input type="hidden" id="imageAddress" value=""/>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>        
</div>