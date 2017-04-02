 <div class="main-content">
     
    <div id="table-wrapper">
        <div class="message" style="display: none;"></div>
        <div id="main-table">
            <input type="button" value="Delete" id="deleteLogButton" title="Delete Log/s" /> 
            <!-- data reporting countries -->
            <table id="logTable">
                <thead id="table-heading">
                    <tr id="heading-row">
                        <th><input type="checkbox" id="select-allLogs"></th>
                        <th>Date Performed</th>
                        <th>IP Address</th>
                        <th>Action</th>
                        <th>Log Notes</th>
                    </tr>
                </thead>
                
                <tbody id="table-body">
                    <?php
                    if (count($logRes) > 0) {
                        ;
                        ?>
                   <?php foreach($logRes as $cols): ?>
                    <tr class="body-row">
                        <td id="<?php echo $cols->logID; ?>"><input type="checkbox" class="checkmeLog" id="reportIdentifier" value="<?php echo $cols->logID; ?>"></td>
                        <td class="log"><?php echo date_format(date_create($cols->DatePerformed), 'M. d, Y g:ia'); ?></td>
                        <td class="log"><?php echo $cols->IPAddress; ?></td>
                        <td class="log"><?php echo $cols->action; ?></td>
                        <td class="log"><?php echo $cols->logNotes; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php };?>
                </tbody>
                
            </table>
        </div>
        <div id="info-nav">
        </div>
    </div>
</div>
