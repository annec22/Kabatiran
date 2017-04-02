<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewContactTrigger dataTables_add" id="new_inf_contact">Add Contact</button>
            <button id="exportContact">Export Contact</button>
            <div class="PopUpWindowContact" style="display: none;">
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Contact Information</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_contact" class="popUp">
                            <tbody id="popBody">
                                <tr>                            
                                    <td id="pleft" class="text_input"><label>Category</label></td>
                                    <td id="pright">
                                        <select id="contactCatID">
                                            <option value="">Choose Category</option>
                                            <?php foreach ($categoryList as $item) {
                                                echo '<option value="'.$item["categoryID"].'">'.$item["category"].'</option>';                                                
                                            }?>                                            
                                        </select></td>
                                </tr>
                                <tr>
                                    <input type="hidden" id="contactAgencyProv" value=""/>                                   
                                    <input type="hidden" id="contactAgencyMun" value=""/>                                    
                                    <input type="hidden" id="contactAgencyBrgy" value=""/>                                    
                                    <td id="pleft" class="text_input"><label>Agency</label></td>
                                    <td id="pright">
                                        <select id="contactAgencyID">                                                                                        
                                            <option value=""></option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>Contact Number:</label></td> 
                                    <td id="pright"><input type="text" id="contactLName" name="contactLName" class="contactLName" size="30" maxlength="21" required /> </td>
                                </tr>                                
                                <tr>
                                    <td id="pleft" class="text_input"><label>Specifics:</label></td> 
                                    <td id="pright"><input type="text" id="cSpecificsLName" name="cSpecificsLName" class="cSpecificsLName" size="30" maxlength="21" required /> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearContacts" class="cancel b-close"></button>
                        <button id="saveContacts" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="contactTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Contact Number</th>
                    <th>Specifics</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($contacts as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["directoryID"].'</td>
                            <td>'.$item["contactNo"].'</td>
                            <td>'.$item["specifics"].'</td>
                            <td><a class="editContact" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteContact" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>
</div>    