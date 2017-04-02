<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewProvinceTrigger dataTables_add" id="new_inf_province">Add Province</button>
            <div class="PopUpWindowProvince" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Province</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_province" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft"><label>Province Name:</label></td>
                                    <td id="pright"><input type="text" id="pLName" name="pLName" class="pLName" size="30" maxlength="21" required /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearProvince" class="cancel b-close"></button>
                        <button id="saveProvince" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="provTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Provinces</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>                
            </thead>
            <tbody id="table-body">
                <?php foreach ($provinceList as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["provinceID"].'</td>
                            <td>'.$item["province"].'</td>
                            <td><a class="editProv" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteProv" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>        
</div>