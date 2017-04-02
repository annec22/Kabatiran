<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewCityMunTrigger dataTables_add" id="new_inf_cityMun">Add City/Mun.</button>
            <div class="PopUpWindowCityMun" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add City/Municipality</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_cityMun" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft" class="text_input"><label>City/ Municipality:</label></td> 
                                    <td id="pright"><input type="text" id="cMLName" name="cMLName" class="cMLName" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>                            
                                    <td id="pleft" class="text_input"><label>Province</label></td>
                                    <td id="pright">
                                        <select id="munProvID">
                                            <option value="">Choose Province</option>
                                            <?php foreach ($provinceList as $item) {
                                                echo '<option value="'.$item["provinceID"].'">'.$item["province"].'</option>';                                                
                                            }                                                                                                                                   
                                            ?>                                            
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearCityMun" class="cancel b-close"></button>
                        <button id="saveCityMun" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="munTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Cities and Municipalities</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($mCities as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["muniCityID"].'</td>
                            <td>'.$item["name"].'</td>
                            <td><a class="editMun" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteMun" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>
</div>    