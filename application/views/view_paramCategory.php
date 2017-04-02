<div class="main-content">
    <div id="table-wrapper">
        <div id="main-table">
            <button class="add-data addNewCategoryTrigger dataTables_add" id="new_inf_category">Add Category</button>
            <div class="PopUpWindowCategory" style="display: none;">                
                <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Category</span></div>
                    <div id="popUp-table">
                        <table id="form_input_add_category" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft"><label>Category Name:</label></td>
                                    <td id="pright"><input type="text" id="catLName" name="catLName" class="catLName" size="30" maxlength="21" required /></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="clearCategory" class="cancel b-close"></button>
                        <button id="saveCategory" class="save b-close"></button>   
                    </div>
                </div>
            </div>
            <table id="categoryTable">
            <thead id="table-heading">
                <tr id="heading-row">
                    <th>ID</th>
                    <th>Categories</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($categoryList as $item) {
                    echo '<tr class="body-row">
                            <td>'.$item["categoryID"].'</td>
                            <td>'.$item["category"].'</td>
                            <td><a class="editCategory" href=""><pre id="edit-opt">     </pre></a></td>
                            <td><a class="deleteCategory" href=""><pre id="del-opt">    </pre></a></td>
                          </tr>';
                }?>
            </tbody>
        </table>
        </div>
    </div>        
</div>