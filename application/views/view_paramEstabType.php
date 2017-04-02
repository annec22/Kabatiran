<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewEstabTrigger dataTables_add" id="new_inf_estab">Add Estab. Type</button>
            <div class="PopUpWindowEstab" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Establishment Type</span></div>                    
                    <div id="popUp-table">
                        <table id="form_input_add_estab" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft"><label>Classification:</label></td>
                                    <td id="pright"><input type="text" id="eTypeLName" name="eTypeLName" class="eTypeLName" size="30" maxlength="21" required /></td>                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearEType" class="cancel b-close"></button>
                        <button id="saveEType" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="estabTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Establishment Types</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($estTypes as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["esTypeID"].'</td>
                            <td>'.$item["classification"].'</td>
                            <td><a class="editEstab" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteEstab" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>        
</div>
          
