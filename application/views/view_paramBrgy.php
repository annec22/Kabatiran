<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewBrgyTrigger dataTables_add" id="new_inf_brgy">Add Brgy</button>
            <div class="PopUpWindowBrgy" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Barangay</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_brgy" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft"><label>Barangay:</label></td>
                                    <td id="pright"><input type="text" id="brgyLName" name="brgyLName" class="brgyLName" size="30" maxlength="21" required /></td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft"><label>X Coordinate:</label></td>
                                    <td id="pright"><input type="text" id="brgyLX" name="brgyLX" class="brgyLName" size="30" maxlength="30" required /></td>                                    
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Y Coordinate:</label></td>
                                    <td id="pright"><input type="text" id="brgyLY" name="brgyLY" class="brgyLName" size="30" maxlength="30" required /></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Province</label></td>
                                    <td id="pright">
                                        <select id="brgyProvID">
                                            <option value="">Choose province</option>
                                            <?php foreach ($provinceList as $item) {
                                                echo '<option value="'.$item["provinceID"].'">'.$item["province"].'</option>';                                                
                                            }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>City/ Municipality</label></td>
                                    <td id="pright">
                                        <select id="brgyMunID">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearBrgy" class="cancel b-close"></button>
                        <button id="saveBrgy" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="brgyTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Barangay</th>
                    <th>X</th>
                    <th>Y</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach($barangays as $item)  {
                    echo '<tr class="body-row">
                            <td>'.$item["idbarangay"].'</td>
                            <td>'.$item["name"].'</td>
                            <td>'.$item['x'].'</td>
                            <td>'.$item['y'].'</td>
                            <td><a class="editBrgy" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteBrgy" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';                    
                }?>
            </tbody>
        </table>      
        </div>
    </div>        
</div>                                    
