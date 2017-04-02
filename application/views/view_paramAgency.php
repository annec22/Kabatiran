<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewAgencyTrigger dataTables_add" id="new_inf_agency">Add Agency</button>
            <div class="PopUpWindowEditAgency" style="display: none;">
                <div id="popUp-content">
                    <div id="popTitle">
                        <span id="title">Edit Agency</span>
                    </div>
                    <div id="popUp-table">
                        <table id="form_input_edit_agency" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft">
                                        <label>Category:</label>
                                    </td>
                                    <td id="pright">
                                        <select id="aECatID">
                                            <?php
                                            foreach ($categoryList as $item) {
                                                echo '<option value="' . $item["categoryID"] . '">' . $item["category"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>                                 
                                <tr>
                                    <td id="pleft">
                                        <label>Province:</label>
                                    </td>
                                    <td id="pright">
                                        <select id="aEProvID">
                                            <option value="">Choose province</option>
                                            <?php
                                            foreach ($provinceList as $item) {
                                                echo '<option value="' . $item["provinceID"] . '">' . $item["province"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft">
                                        <label>Municipality:</label>
                                    </td>
                                    <td id="pright">
                                        <select id="aECityMunID">
                                            <option value="">Choose municipality</option>
                                            <?php
                                            foreach ($mCities as $item) {
                                                echo '<option value="' . $item["muniCityID"] . '">' . $item["name"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft">
                                        <label>Barangay:</label>
                                    </td>
                                    <td id="pright">
                                        <select id="aEBarangayID">
                                            <option value="">Choose barangay</option>
                                            <?php
                                            foreach ($barangays as $item) {
                                                echo '<option value="' . $item["idbarangay"] . '">' . $item["name"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <input type="hidden" id="aEAgencyID" value=""/>                                    
                                    <td id="pleft"><label>Agency Name:</label></td>
                                    <td id="pright"><input type="text" id="aELName" name="aELName" class="aLEName" size="30" maxlength="21" value="" required /></td>
                                </tr>
                                <tr>
                                    <td id="pleft">
                                        <label>Address:</label>
                                    </td>
                                    <td id="pright">
                                        <input type="text" id="aAddELName" name="aAddELName" class="aAddELName" size="30" maxlength="21" value="" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft">
                                        <label>Email Address:</label>
                                    </td>
                                    <td id="pright">
                                        <input type="text" id="aEAddELName" name="aEAddELName" class="aEAddELName" size="30" maxlength="21" value="'+data[0].emailAdd+'" required />
                                    </td>                                                                                            
                                <tr>
                                    <td id="pleft">
                                        <label>Council Member:</label>
                                    </td>
                                    <td id="pright">                                        
                                        <input name="chkbxCMemberY" type="radio" value=1 />YES
                                        <input name="chkbxCMemberY" type="radio" value=0 />NO
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearEAgency" class="cancel b-close"></button>
                        <button id="saveEAgency" class="save b-close"></button>
                    </div></div>
            </div>
            <div class="PopUpWindowAgency" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Agency</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_agency" class="popUp">
                            <tbody id="popBody">
                                <tr>                                    
                                    <td id="pleft"><label>Category:</label></td>
                                    <td id="pright">
                                        <select id="aCatID">
                                            <option value="">Choose category</option>
                                            <?php                                            
                                            foreach ($categoryList as $item) {
                                                echo '<option value="' . $item["categoryID"] . '">' . $item["category"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>                                                                                                                
                                </tr>
                                <tr>                                    
                                    <td id="pleft"><label>Province:</label></td>
                                    <td id="pright">
                                        <select id="aProvID">
                                            <option value="">Choose province</option>
                                            <?php
                                            foreach ($provinceList as $item) {
                                                echo '<option value="' . $item["provinceID"] . '">' . $item["province"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>                                                                                                                
                                </tr>
                                <tr>                                    
                                    <td id="pleft"><label>Municipality:</label></td>
                                    <td id="pright">                                        
                                        <select id="aCityMunID">
                                            <option value=""></option>
                                        </select>
                                    </td>                                                                                                                
                                </tr>
                                <tr>
                                    <td id="pleft">
                                        <label>Barangay:</label>
                                    </td>
                                    <td id="pright">
                                        <select id="aBarangayID">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Agency Name:</label></td>
                                    <td id="pright"><input type="text" id="aLName" name="aLName" class="aLName" size="30" maxlength="21" required /></td>                                                                        
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Address:</label></td>
                                    <td id="pright"><input type="text" id="aAddLName" name="aLName" class="aAddLName" size="30" maxlength="21" required /></td>
                                </tr>
                                <tr>
                                    <td id="pleft"><label>Email Address:</label></td>
                                    <td id="pright"><input type="text" id="aEAddLName" name="aLName" class="aEAddLName" size="30" maxlength="21" required /></td>                                    
                                </tr>                                                                                                    
                                    <td id="pleft"><label>Council Member:</label></td>
                                    <td id="pright">
                                        <input name="chkbxCMemberY" type="radio" value=1 checked/>YES
                                        <input name="chkbxCMemberY" type="radio" value=0 />NO
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearAgency" class="cancel b-close"></button>
                        <button id="saveAgency" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <div id="spinnerAg"></div>
            <table id="agencyTable">
                <thead id="table-heading">
                    <tr id="heading-row">
                        <th>Agency ID</th>
                        <th>Agency </th>
                        <th>Council Member</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>Authentication code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    foreach ($agencyList as $item) {
                        echo '<tr>
                                <td>' . $item["agencyID"] . '</td>
                                <td>' . $item["agencyName"] . '</td>
                                <td>' . $item["council_member"] . '</td>
                                <td>' . $item["emailAdd"] . '</td>
                                <td>' . $item["address"] . '</td>
                                <td><a class="genAuth" href=""><pre id="gen-opt">     </pre></a></td>
                                <td><a class="editAgency" href=""><pre id="edit-opt">     </pre></a></td>
                                <td><a class="deleteAgency" href=""><pre id="del-opt">    </pre></a></td>
                             </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  