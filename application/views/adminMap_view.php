<!--<div id="map_category_list">
    <span>Plot an incident: </span>
    <ul id="category">
        <?php if($accident != null){
            foreach($accident as $acc){?>
            
            <li onclick="imageClick('<?php echo $acc->classification; ?>');">    
                <a><?php echo $acc->classification; ?>
                    <img src="<?php echo base_url();?>images/logo/<?php echo $acc->classification; ?>.png" />
                </a>
            </li>
            <?php }
        }
    ?>

    </ul>
</div>-->

<div id="map_filter_list">
    <span>Filters:</span>
    <ul id="filterList">
        <?php if($accident != null){
            foreach($accident as $acc){?>
                    <li>
                        <input type="checkbox" id="<?php echo $acc->classification; ?>" onclick="boxclick(this, '<?php echo $acc->classification; ?>');" checked/>
                        <img src="<?php echo base_url();?>images/<?php echo $acc->classification; ?>.png"/><?php echo $acc->classification; ?>
                    </li>
            <?php }
        }
    ?>
    </ul>
</div>

<div id="popup">
    <input type="text" id="tempMarkerID" name="tempMarkerID" hidden/>
<!--    <form action="<?php echo base_url() . 'index.php/adminSystem/addLocation'; ?>" method="GET">-->
        <p>Title: <input type="text" id="markerTitle" name="title" style="color: black;"/>
            Location: <select id="optionProvince">
                        <option selected ="selected">-Select Province-</option>
                <?php
                if ($province != null) {
                    
                    foreach ($province as $prov) {
                        ?>
                        <option><?php echo $prov->province; ?></option>
                    <?php } ?>
                <?php } ?>
            </select></p>
        <p>City/Municipality:<select id="optionCity"></select>
            Barangay:<select id="optionBrgy"></select></p>
        <p><input type="text" id="longitude" name="longitude" hidden/>
            <input type="text" id="latitude" name="latitude" hidden/>
        </p>
        <p>Time: <select id="hr" class="time" name="hr">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>:<select id="min" class="time" name="min">
                <option>00</option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
                <option>32</option>
                <option>33</option>
                <option>34</option>
                <option>35</option>
                <option>36</option>
                <option>37</option>
                <option>38</option>
                <option>39</option>
                <option>40</option>
                <option>41</option>
                <option>42</option>
                <option>43</option>
                <option>44</option>
                <option>45</option>
                <option>46</option>
                <option>47</option>
                <option>48</option>
                <option>49</option>
                <option>50</option>
                <option>51</option>
                <option>52</option>
                <option>53</option>
                <option>54</option>
                <option>55</option>
                <option>56</option>
                <option>57</option>
                <option>58</option>
                <option>59</option>
                
            </select>
            <select id="timeOfDay">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
            Date: <input type="text" id="date" name="date"/>
            Type: <select id="type" onchange="getType(this)">
                <?php if($accident != null){
                    foreach($accident as $acc){?>
                <option value="<?php echo $acc->classification; ?>"><?php echo $acc->classification; ?></option>
                    <?php }
                }
?>
                
            </select></p>
        <p>Description:</p><p><textarea id="description" rows="6" cols="27" name="description" placeholder="Enter description..."></textarea></p>                
        
            Publish on: <div id="publishOn"><input type="checkbox" id="facebook" name="facebook" /> Facebook</div> <input type="checkbox" id="twitter" name="twitter" /> Twitter</p>
        <input type="text" id="temp" name="temp" value="Earthquake" hidden/>
        <input type="text" id="prov" name="prov" value="Abra" hidden/>
        <input type="text" id="muniCity" name="muniCity" hidden/>
        <input type="text" id="cityHolder" name="cityHolder" hidden/>
        <input type="text" id="brgyHolder" name="brgyHolder" hidden/>
        <input type="text" id="brgy" name="brgy" hidden/>
        <textarea id="facebookMarker" name="facebookMarker" cols="27" rows="6" hidden></textarea>
        <button id="fbMapPost" onclick="fbPost();">Submit</button>
<!--    </form>-->
</div>

<div class="PopUpWindowMapAdd" style="display:none;">
    <input type="text" id="tempMarkerID" name="tempMarkerID" hidden/>
<!--    <form action="<?php echo base_url() . 'index.php/adminSystem/addLocation'; ?>" method="GET">-->
    <table class="popUp">
        <tbody>
            <tr>
                <td id="pleft">Type:</td>
                <td id="pright"><select id="type" onchange="getType(this);">
                        <?php
                        if ($accident != null) {
                            foreach ($accident as $acc) {
                                ?>
                                <option value="<?php echo $acc->classification; ?>"><?php echo $acc->classification; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="pleft">Title:</td>
                <td id="pright"><input type="text" id="markerTitle" name="title"/></td>
            </tr>
            <tr>
                <td id="pleft">Location:</td>
                <td id="pright"><select id="optionProvince">
                        <option selected ="selected">-Select Province-</option>
                        <?php
                        if ($province != null) {
                            foreach ($province as $prov) {
                                ?>
                                <option><?php echo $prov->province; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td id="pleft">City/Municipality:</td>
                <td id="pright"><select id="optionCity"></select></td>
            </tr>
            <tr>
                <td id="pleft">Barangay:</td>
                <td id="pright"><select id="optionBrgy"></select></td>
            </tr>
            <tr>
                <td id="pleft">Time:</td>
                <td id="pright"><select id="hr" class="time">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>:<select id="min" class="time" name="min">
                        <option>00</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                        <option>32</option>
                        <option>33</option>
                        <option>34</option>
                        <option>35</option>
                        <option>36</option>
                        <option>37</option>
                        <option>38</option>
                        <option>39</option>
                        <option>40</option>
                        <option>41</option>
                        <option>42</option>
                        <option>43</option>
                        <option>44</option>
                        <option>45</option>
                        <option>46</option>
                        <option>47</option>
                        <option>48</option>
                        <option>49</option>
                        <option>50</option>
                        <option>51</option>
                        <option>52</option>
                        <option>53</option>
                        <option>54</option>
                        <option>55</option>
                        <option>56</option>
                        <option>57</option>
                        <option>58</option>
                        <option>59</option>
                    </select>
                    <select id="timeOfDay">
                        <option>AM</option>
                        <option>PM</option>
                    </select></td>
            </tr>
            <tr>
                <td id="pleft">Date:</td>
                <td id="pright"><input type="text" id="date" name="date"/></td>
            </tr>
            <tr>
                <td id="pleft">Description:</td>
                <td id="pright"><textarea id="description" rows="6" cols="27" name="description" placeholder="Enter description..."></textarea></td>
            </tr>
        </tbody>
    </table>
    <p><input type="text" id="longitude" name="longitude" hidden/>
        <input type="text" id="latitude" name="latitude" hidden/>

        Publish on: <div id="publishOn"><input type="checkbox" id="facebook" name="facebook" /> Facebook</div> <input type="checkbox" id="twitter" name="twitter" /> Twitter</p>
<input type="text" id="temp" name="temp" value="Earthquake" hidden/>
<input type="text" id="prov" name="prov" value="Abra" hidden/>
<input type="text" id="muniCity" name="muniCity" hidden/>
<input type="text" id="cityHolder" name="cityHolder" hidden/>
<input type="text" id="brgyHolder" name="brgyHolder" hidden/>
<input type="text" id="brgy" name="brgy" hidden/>
<textarea id="facebookMarker" name="facebookMarker" cols="27" rows="6" hidden></textarea>
<button id="fbMapPost" onclick="fbPost();">Submit</button>
<!--    </form>-->
</div>

<div id="popupEdit"  class="PopUpWindowMapEdit" style="display:none;">
    <div id="popTitle"><span id="title">Edit Marker</span></div>
    <form action="<?php echo base_url() . 'editMarker'; ?>" method="GET">
        <input type="text" id="tempMarkerID2" name="tempMarkerID" hidden/>
        <input type="text" name="action" value="1" hidden/>
        <table class="popUp">
            <tbody>
                <tr>
                    <td id="pleft">Type:</td>
                    <td id="pright"><select id="typeEdit" onchange="getTypeEdit(this);">
                            <?php
                            if ($accident != null) {
                                foreach ($accident as $acc) {
                                    ?>
                                    <option value="<?php echo $acc->classification; ?>"><?php echo $acc->classification; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td id="pleft">Title:</td>
                    <td id="pright"><input type="text" id="titleEdit" name="title"/></td>
                </tr>
                <tr>
                    <td id="pleft">Location:</td>
                    <td id="pright"><select onchange="getProv(this)" id="provSelect">
                            <?php
                            if ($province != null) {
                                foreach ($province as $prov) {
                                    ?>
                                    <option><?php echo $prov->province; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select></td>
                </tr>
                <tr>
                    <td id="pleft">City/Municipality:</td>
                    <td id="pright"><select id="cmSelect"></select></td>
                </tr>
                <tr>
                    <td id="pleft">Barangay:</td>
                    <td id="pright"><select id="brgySelect"></select></td>
                </tr>
                <tr>
                    <td id="pleft">Time:</td>
                    <td id="pright"><select id="hrEdit" class="time">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>:<select id="minEdit" class="time" name="min">
                            <option>00</option>
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                            <option>32</option>
                            <option>33</option>
                            <option>34</option>
                            <option>35</option>
                            <option>36</option>
                            <option>37</option>
                            <option>38</option>
                            <option>39</option>
                            <option>40</option>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                            <option>46</option>
                            <option>47</option>
                            <option>48</option>
                            <option>49</option>
                            <option>50</option>
                            <option>51</option>
                            <option>52</option>
                            <option>53</option>
                            <option>54</option>
                            <option>55</option>
                            <option>56</option>
                            <option>57</option>
                            <option>58</option>
                            <option>59</option>
                        </select>
                        <select id="timeOfDayEdit">
                            <option>AM</option>
                            <option>PM</option>
                        </select></td>
                </tr>
                <tr>
                    <td id="pleft">Date:</td>
                    <td id="pright"><input type="text" id="dateEdit" name="date"/></td>
                </tr>
                <tr>
                    <td id="pleft">Description:</td>
                    <td id="pright"><textarea id="descriptionEdit" rows="6" cols="27" name="description" placeholder="Enter description..."></textarea></td>
                </tr>
            </tbody>
        </table>

        <input type="text" id="long" name="longitude" hidden/>
        <input type="text" id="lat" name="latitude" hidden/>
        <input type="text" name="hr" id="hrs" hidden/>
        <input type="text" id="tempEdit" name="temp" value="Earthquake" hidden/>
        <input type="text" id="provEdit" name="prov" value="Benguet" hidden/>
        <input type="text" id="event" name="event" hidden/>
        <input type="text" id="muniCity" name="muniCity" hidden/>
        <input type="text" id="loc" name="loc" hidden/>
        <input type="text" id="cmEdit" name="cm" hidden/>
        <input type="text" id="brgyEdit" name="brgy" hidden/>
        <button onclick="timeCheck();" >Submit</button>
    </form>
</div>

<div id="popupDelete" class="PopUpWindowMapDel" style="display:none;">
    <div id="popTitle"><span id="title">Delete Marker</span></div>
    <h2>Are you sure you want to delete the marker?</h2>
    <form action="<?php echo base_url() . 'delMarker'; ?>" method="GET">
        <input type="text" id="delMuniCity" name="muniCity"  hidden/>
        <input type="text" id="delEvent" name="event"  hidden/>
        <input type="text" id="delLoc" name="loc"  hidden/>
        <button>Delete</button>
    </form>
    <button onclick="closeDelete()">Cancel</button>
</div>