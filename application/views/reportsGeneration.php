
        <script>
//            $(function() {
//            $("#dateBefore").datepicker();
//                    $("#dateAfter").datepicker();
//            });

            
            function showOptions(e) {
            switch (e.value) {

            case '1':
                    if (e.checked) {

            $('.accidents').prop('disabled', false);
                    $('.accidents').prop('hidden', false);
                    break;
            } else {
            $('.accidents').prop('hidden', true);
                    $('.accidents').prop('disabled', true);
                    break;
            }
            case '2':
                    if (e.checked) {

            $('#cities').prop('disabled', false);
                    $('#cities').prop('hidden', false);
                    break;
            } else {

            $('#cities').prop('disabled', true);
                    $('#cities').prop('hidden', true);
                    break;
            }
            case '3':
                    if (e.checked){
            $('#dateBefore').prop('disabled', false);
                    $('#dateBefore').prop('hidden', false);
                    $('#dateAfter').prop('disabled', false);
                    $('#dateAfter').prop('hidden', false);
                    $('.dates').prop('disabled', false);
                    $('.dates').prop('hidden', false);
                    break;
            } else{
            $('#dateBefore').prop('disabled', true);
                    $('#dateBefore').prop('hidden', true);
                    $('#dateAfter').prop('disabled', true);
                    $('#dateAfter').prop('hidden', true);
                    $('.dates').prop('disabled', true);
                    $('.dates').prop('hidden', true);
            }


            }
            document.getElementById("reportSub").removeAttribute("hidden");
                    if (!document.getElementById("accCheck").checked && !document.getElementById("cityCheck").checked && !document.getElementById("dateCheck").checked) {
            document.getElementById("reportSub").setAttribute("hidden");
            }
            }
        </script>

        <a href="<?php echo base_url() . 'generateReports' ?>">HOME</a>
        <label>Type of Accident<input type="checkbox" name="accident" id="accCheck" onclick="showOptions(this);" value="1"/></label>
        <label>City/Municipality<input type="checkbox" name="muniCity" id="cityCheck" onclick="showOptions(this);" value="2"/></label>
        <label>Date<input type="checkbox" name="date" id="dateCheck" onclick="showOptions(this);" value="3"/></label>

        <form method="GET" action="<?php echo base_url() . 'getCount'; ?>">

            <?php
            if ($accident_type != null) {
                foreach ($accident_type as $acc) {
                    ?>
                    <label hidden disabled class="accidents"><input type="checkbox" name="accident[]" class="accidents" value="<?php echo $acc->classification; ?>" hidden disabled><?php echo $acc->classification; ?></label>

                <?php } ?>
            <?php } ?>

            <label>
                <select id="cities" name="cities" hidden disabled>
                    <option>---Select City/Municipality---</option>
                    <?php
                    if ($cities != null) {
                        foreach ($cities as $city) {
                            ?>
                            <option value="<?php echo $city->name; ?>"><?php echo $city->name; ?></option>

                        <?php } ?>
                    <?php } ?>
                </select>
            </label>

            <label class="dates" hidden>From: <input type="date" id="dateBefore" name="first" hidden disabled/></label>
            <label class="dates" hidden>To: <input type="date" id="dateAfter" name="last" hidden disabled/></label>
            <button id="reportSub" hidden>submit</button>
        </form>
        <script>
                      var date = new Date();
                      var day = date.getDate();
                      var month = date.getMonth() + 1;
                      var year = date.getFullYear();
                      if (month < 10)
                      month = "0" + month;
                      if (day < 10)
                      day = "0" + day;
                      var today = year + "-" + month + "-" + day;
                      document.getElementById("dateAfter").value = today;        </script>

        <?php if ($count != null && $name != null && $type != null) { ?>
            <h4>City/Municipality: <?php echo $name; ?> </h4>

            <table id="allFilteredReport">
                <tr><th>Type of Accident</th><th>Number of Accidents</th><th>Color Legend</th></tr>
                <?php for ($index = 0; $index < count($count); $index++) { ?>
                    <tr><td><?php echo $type[$index]; ?></td><td><?php echo $count[$index]; ?></td><td bgcolor="<?php echo $color[$index]; ?>"></td></tr>
                <?php }
                ?>
            </table>
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>

                        var data = [
    <?php for ($index = 0; $index < count($count); $index++) { ?>
                    {
                    value: <?php echo $count[$index]; ?>,
                            color: "<?php echo $color[$index]; ?>"
                    },
    <?php }
    ?>
                ];
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myNewChart = new Chart(ctx).Pie(data);</script>
        <?php }
        ?>
        <?php if ($count != null && $name != null && $type == null) { ?>
            <h4>City/Municipality: <?php echo $name; ?> </h4>

            <h4>Total Accident Count: <?php echo $total; ?></h4>
            <table id="filteredReport">
                <tr><th>Type of Accident</th><th>Number of Accidents</th><th>Color Legend</th></tr>
                <?php for ($index = 0; $index < count($accident_type); $index++) { ?>
                    <tr><td><?php echo $accident_type[$index]->classification; ?></td><td><?php echo $count[$index]; ?></td><td bgcolor="<?php echo $color[$index]; ?>"></td></tr>
                <?php }
                ?>
            </table>
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
                        var data = [
    <?php for ($index = 0; $index < count($accident_type); $index++) { ?>
                    {
                    value: <?php echo $count[$index]; ?>,
                            color: "<?php echo $color[$index]; ?>"
                    },
    <?php }
    ?>
                ];
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myNewChart = new Chart(ctx).Pie(data);</script>
        <?php }
        ?>


        <?php if ($name == null && $count != null) { ?>
            <table id="accReport">
                <tr><th>Type of Accident</th><th>Number of Accidents</th><th>Color Legend</th></tr>
                <?php for ($index = 0; $index < count($count); $index++) { ?>
                    <tr><td><?php echo $type[$index]; ?></td><td><?php echo $count[$index]; ?></td><td bgcolor="<?php echo $color[$index]; ?>"></td></tr>
                <?php }
                ?>

            </table>

            <canvas id="myChart" width="400" height="400"></canvas>
            <script>

                        var data = [
    <?php for ($index = 0; $index < count($count); $index++) { ?>
                    {
                    value: <?php echo $count[$index]; ?>,
                            color: "<?php echo $color[$index]; ?>"
                    },
    <?php }
    ?>
                ];
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myNewChart = new Chart(ctx).Pie(data);</script>
        <?php }
        ?>


        <?php if ($count == null && $name == null) { ?>
            <table id="allReport">
                <tr><th></th><th>Type of Accident</th><th>Number of Accidents</th><th>Color Legend</th></tr>
                <tr><td>1.</td><td>Earthquake</td><td><?php echo $Earthquake; ?></td><td bgcolor="#F38630"></td></tr>
                <tr><td>2.</td><td>Landslide</td><td><?php echo $Landslide; ?></td><td bgcolor="#E0E4CC"></td></tr>
                <tr><td>3.</td><td>Fire</td><td><?php echo $Fire; ?></td><td bgcolor="#69D2E7"></td></tr>
                <tr><td>4.</td><td>Insurgence</td><td><?php echo $Insurgence; ?></td><td bgcolor="#000000"></td></tr>
                <tr><td>5.</td><td>Vehicular Accident</td><td><?php echo $VehicularAccident; ?></td><td bgcolor="#FF0000"></td></tr>
                <tr><td>6.</td><td>Rock Fall</td><td><?php echo $RockFall; ?></td><td bgcolor="#00FF00"></td></tr>
                <tr><td>7.</td><td>Drowning Incident</td><td><?php echo $DrowningIncident; ?></td><td bgcolor="#0000FF"></td></tr>
                <tr><td>8.</td><td>Road Block</td><td><?php echo $RoadBlock; ?></td><td bgcolor="#FFFF00"></td></tr>
            </table>
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
                        var data = [
                {
                value: <?php echo $Earthquake; ?>,
                        color: "#F38630"
                },
                {
                value: <?php echo $Landslide; ?>,
                        color: "#E0E4CC"
                },
                {
                value: <?php echo $Fire; ?>,
                        color: "#69D2E7"
                },
                {
                value: <?php echo $Insurgence; ?>,
                        color: "#000000"
                },
                {
                value: <?php echo $VehicularAccident; ?>,
                        color: "#FF0000"
                },
                {
                value: <?php echo $RockFall; ?>,
                        color: "#00FF00"
                },
                {
                value: <?php echo $DrowningIncident; ?>,
                        color: "#0000FF"
                },
                {
                value: <?php echo $RoadBlock; ?>,
                        color: "#FFFF00"
                }
                ]
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myNewChart = new Chart(ctx).Pie(data);

            </script>
        <?php }
        ?>
