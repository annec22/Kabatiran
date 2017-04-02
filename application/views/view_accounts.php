 <div class="main-content">
    <div id="table-wrapper">
        <div class="message" style="display: none;"></div>
        <div id="main-table">
            <button class="add-data addNewAccountTrigger dataTables_add" id="new_inf_acc">Add Account</button>
            
            <div class="PopUpWindowAccount" style="display:none;">
                 <div id="popUp-content">
                    <div id="popTitle"><span id="title">Add Account</span></div>
                    <div id="popUp-table">
                        <div id="messageAcc" class="hidden"><h3>Each field is important. Please don't leave them blank.</h3></div>
                        <table id="form_input_add_account" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft" class="text_input"><label>*First Name:</label></td> 
                                    <td id="pright"><input type="text" id="first" name="first" class="first" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Middle Initial:</label></td> 
                                    <td id="pright"><input type="text" id="i" name="i" class="i" size="30" maxlength="2" required /></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Last Name:</label></td> 
                                    <td id="pright"><input type="text" id="last" name="last" class="last" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*E-mail:</label></td> 
                                    <td id="pright"><input type="text" id="email" name="email" class="email" size="30" /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Username:</label></td> 
                                    <td id="pright"><input type="text" id="user" name="user" class="user" size="30" maxlength="8" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Type:</label></td> 
                                    <td id="pright"><select id="adminType">
                                                        <option value="select" disabled selected="selected">Select Type</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="superadmin">Super Admin</option>
                                                    </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="ClearAcc" class="cancel b-close"></button>
                        <button id="SaveAcc" class="save b-close"></button>   
                    </div>
                 </div>
            </div>
            
            <div class="PopUpWindowEditAccount" style="display:none;">
                 <div id="popUp-content">
                    <div id="popTitle"><span id="title">Edit Account</span></div>
                    <div id="popUp-table">
                        <div id="messageAcc" class="hidden"><h3>Each field is important. Please don't leave them blank.</h3></div>
                        <table id="form_input_add_account" class="popUp">
                            <tbody id="popBody">
                                <tr>
                                    <td id="pleft" class="text_input"><label>*First Name:<input type="hidden" id="editId" /></label></td> 
                                    <td id="pright"><input type="text" id="firstEdit" name="firstEdit" class="firstEdit" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Middle Initial:</label></td> 
                                    <td id="pright"><input type="text" id="iEdit" name="iEdit" class="iEdit" size="30" maxlength="2" required /></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Last Name:</label></td> 
                                    <td id="pright"><input type="text" id="lastEdit" name="lastEdit" class="lastEdit" size="30" maxlength="21" required /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*E-mail:</label></td> 
                                    <td id="pright"><input type="text" id="emailEdit" name="emailEdit" class="emailEdit" size="30" /> </td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Username:</label></td> 
                                    <td id="pright"><input type="text" id="userEdit" name="userEdit" class="userEdit" size="30" maxlength="8" required />
                                    <input type="hidden" id="userHolder" name="userHolder" class="userHolder" size="30" maxlength="8"/></td>
                                </tr>
                                <tr>
                                    <td id="pleft" class="text_input"><label>*Type:</label></td> 
                                    <td id="pright"><select id="adminTypeEdit">
                                                        <option value="select" disabled selected="selected">Select Type</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="superadmin">Super Admin</option>
                                                    </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="buttons">
                        <button id="ClearAccEdit" class="cancel b-close"></button>
                        <button id="SaveAccEdit" class="save b-close"></button>   
                    </div>
                 </div>
            </div>
            
            <div id="spinner"></div>
   
            <table id="accTable">
                <thead id="table-heading">
                    <tr id="heading-row">
                        <th>First Name</th>
                        <th>Initials</th>
                        <th>Last Name</th>
                        <th>E-mail</th> 
                        <th>Username</th>
                        <th>Type</th>                   
                        <th>Reset</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                <tbody id="table-body">
                   <?php foreach($accRes as $cols): ?>
                    <tr class="body-row">
                        <td class="acc"><?php echo $cols->firstName; ?></td>
                        <td class="acc"><?php echo $cols->middleName; ?></td>
                        <td class="acc"><?php echo $cols->lastName; ?></td>
                        <td class="acc" id="email<?php echo $cols->accID; ?>" name="<?php echo $cols->emailAdd; ?>" ><?php echo $cols->emailAdd; ?></td>
                        <td class="acc" id="user<?php echo $cols->accID; ?>" name="<?php echo $cols->username; ?>" ><?php echo $cols->username; ?></td>
                        <td class="acc"><?php echo $cols->accType; ?></td>         
                        <td class="acc"><button id="<?php echo $cols->accID ?>" class="resetAccBtn" >Reset</button></td>
                        <td class="acc"><a class="editAcc" href="" id="<?php echo $cols->accID ?>" ><pre id="edit-opt">    </pre></a></td>
                        <td class="acc"><a class="deleteAcc" href="" id="<?php echo $cols->accID ?>" ><pre id="del-opt">    </pre></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        </div>
        <div id="info-nav">
            
        </div>
    </div>
</div>
