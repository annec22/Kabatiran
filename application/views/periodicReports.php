<html>
    <head>
        <title>Reports Generation</title>
        <script src="<?php echo base_url() . 'scripts/jquery-1.9.1.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/Chart.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.bpopup.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery-ui-1.9.2.custom.js'; ?>"></script>
        <script src="<?php echo base_url() . 'scripts/jquery.dataTables.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/dataTables.css'; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'styles/jquery-ui-1.9.2.custom.css'; ?>" type="text/css" />
        <style>
            #detailList{
                width: 800px;
                height: 600px;
                position: relative;
                left: 500px;
                bottom: 1000px;
                margin: 5px;
                padding: 5px;
                background-color: white;
                border:solid 2px #000000;
                -moz-border-radius: 25px;
                -webkit-border-radius: 25px;
                border-radius: 25px;
                display: none;
                overflow: scroll;

                font-size: larger;
            }

            @media print{
                .accType{
                    display: none;
                }

                .accLbl{
                    display: none;
                }

                #filterDiv{
                    display: none;
                }
                #repForm{
                    display: none;
                }
                
                .detailedView{
                    display: none;
                }
                
                .detailCell{
                    display: none;
                }
            }
        </style>
        <script>
            function getCheckCount() {
                /* declare a checkbox array */
                var chkArray = [];

                /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
                $(".accType:checked").each(function() {
                    chkArray.push($(this).val());
                });

                /* we join the array separated by the comma */
                var selected;
                selected = chkArray.join(',') + ",";

                return selected;
            }
            function checkDates() {
                if (new Date($('#dateBefore').val()) > new Date($('#dateAfter').val())) {
                    alert("The first date must be lower than the second date");
                    return false;
                } else {
                    var temp = getCheckCount();
                    if (temp === ",") {
                        alert("Please check at least one checkbox");
                        return false;
                    }
                }
            }
            $.datepicker.regional[""].dateFormat = 'M. dd, yy';
            $.datepicker.setDefaults($.datepicker.regional['']);
            $.datepicker.setDefaults({
                dateFormat: "M. dd, yy",
                changeMonth: true,
                changeYear: true,
                maxDate: "+0D"
            });
            $(function() {

                $("#dateBefore").datepicker().attr('readonly', 'readonly');
                $("#dateAfter").datepicker().attr('readonly', 'readonly');
            });
            $(document).ready(function() {
                $('.detailedView').click(function(e) {

                    var year = $('#year').val();
                    var city = $('#cities').val();
                    var prov = $('#provinceTb').val();
                    var month = $('#monthTb').val();
                    var first = $('#firstTb').val();
                    var last = $('#lastTb').val();
                    var reg = $('#regionDateTb').val();
                    var regYr = $('#regionYearTb').val();
                    var regMt = $('#regionMonthTb').val();

                    var acc = this.value;
                    if (reg !== undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'regionReportDate'; ?>",
                            type: 'POST',
                            data: {'first': first, 'type': acc, 'last': last},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (regYr !== undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'regionReportYear'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    alert(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (regMt !== undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'regionReportMonth'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc, 'month': month},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (year !== undefined && city !== undefined && month === undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetails'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc, 'city': city},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (year !== undefined && prov !== undefined && month === undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetailsProv'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc, 'prov': prov},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });

                    } else if (year !== undefined && month !== undefined && city !== undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetailsYrMon'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc, 'city': city, 'month': month},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (year !== undefined && month !== undefined && prov !== undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetailsYrMonProv'; ?>",
                            type: 'POST',
                            data: {'year': year, 'type': acc, 'prov': prov, 'month': month},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });

                    } else if (first !== undefined && last !== undefined && city !== undefined && month === undefined && year === undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetailsDate'; ?>",
                            type: 'POST',
                            data: {'first': first, 'type': acc, 'city': city, 'last': last},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;
                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    } else if (first !== undefined && last !== undefined && prov !== undefined && month === undefined && year === undefined) {
                        $.ajax({
                            url: "<?php echo base_url() . 'getReportDetailsDateProv'; ?>",
                            type: 'POST',
                            data: {'first': first, 'type': acc, 'prov': prov, 'last': last},
                            dataType: 'JSON',
                            success: function(data) {
                                $('.report-body').empty();
                                var splitter = data.split("|");
                                var ctr = 0;

                                do {
                                    $('.report-body').append(splitter[ctr]);
                                    ctr++;
                                } while (ctr < splitter.length - 1)
                            },
                            error: function() {
                                alert("fail");
                            }
                        });
                    }

                    $("#detailList").bPopup({
                        escClose: true
                    });
                });

                $('#showDetails').click(function(e) {
                    $("#listedDetail").bPopup({
                        escClose: true
                    });
                });
            });
            
            function showOption(e) {

                switch (e.value) {
                    case '1':
                        if (e.checked) {
                            $('#yearLbl').prop('hidden', false);
                            $('#yearCbox').prop('disabled', false);
                            $('#monthLbl').prop('hidden', true);
                            $('#monthCbox').prop('disabled', true);
                            $('#dateBefore').prop('disabled', true);
                            $('#dateBefore').prop('hidden', true);
                            $('#dateAfter').prop('disabled', true);
                            $('#dateAfter').prop('hidden', true);
                            $('#dateLbl').prop('hidden', true);
                            break;
                        } else {
                            $('#yearLbl').prop('hidden', true);
                            $('#yearCbox').prop('disabled', true);
                            $('#monthLbl').prop('hidden', false);
                            $('#monthCbox').prop('disabled', false);
                            break;
                        }
                    case '2':
                        if (e.checked) {
                            $('#yearLbl').prop('hidden', false);
                            $('#yearCbox').prop('disabled', false);
                            $('#monthLbl').prop('hidden', false);
                            $('#monthCbox').prop('disabled', false);
                            $('#dateBefore').prop('disabled', true);
                            $('#dateBefore').prop('hidden', true);
                            $('#dateAfter').prop('disabled', true);
                            $('#dateAfter').prop('hidden', true);
                            $('#dateLbl').prop('hidden', true);
                            break;
                        } else {
                            $('#yearLbl').prop('hidden', true);
                            $('#yearCbox').prop('disabled', true);
                            $('#monthLbl').prop('hidden', true);
                            $('#monthCbox').prop('disabled', true);
                            break;

                        }
                    case '3':
                        if (e.checked) {
                            $('#yearLbl').prop('hidden', true);
                            $('#yearCbox').prop('disabled', true);
                            $('#monthLbl').prop('hidden', true);
                            $('#monthCbox').prop('disabled', true);
                            $('#dateBefore').prop('disabled', false);
                            $('#dateBefore').prop('hidden', false);
                            $('#dateAfter').prop('disabled', false);
                            $('#dateAfter').prop('hidden', false);
                            $('#dateLbl').prop('hidden', false);
                            break;
                        } else {
                            $('#dateBefore').prop('disabled', true);
                            $('#dateBefore').prop('hidden', true);
                            $('#dateAfter').prop('disabled', true);
                            $('#dateAfter').prop('hidden', true);
                            $('#dateLbl').prop('hidden', true);

                            break;
                        }
                    case '4':
                        if (e.checked) {
                            $('#provLbl').prop('hidden', false);
                            $('#provCbox').prop('disabled', false);
                            $('#cityLbl').prop('hidden', true);
                            $('#cityCbox').prop('disabled', true);
                            break;
                        } else {
                            $('#provLbl').prop('hidden', true);
                            $('#provCbox').prop('disabled', true);
                            $('#cityLbl').prop('hidden', false);
                            $('#cityCbox').prop('disabled', false);
                            break;
                        }
                    case '5':
                        if (e.checked) {
                            $('#provLbl').prop('hidden', true);
                            $('#provCbox').prop('disabled', true);
                            $('#cityLbl').prop('hidden', false);
                            $('#cityCbox').prop('disabled', false);
                            break;
                        } else {
                            $('#provLbl').prop('hidden', false);
                            $('#provCbox').prop('disabled', false);
                            $('#cityLbl').prop('hidden', true);
                            $('#cityCbox').prop('disabled', true);
                            break;
                        }

                    case '6':
                        if (e.checked) {
                            $('#provLbl').prop('hidden', true);
                            $('#provCbox').prop('disabled', true);
                            $('#cityLbl').prop('hidden', true);
                            $('#cityCbox').prop('disabled', true);
                        }
                }
            }


        </script>

    </head>
    <body>
        <a href="<?php echo base_url() ?>">home</a><br/>
        <div id="detailList" hidden>
            <div id="table-wrapper">

                <div id="main-table">
                    <table id="repTable" border="1">
                        <thead id="table-heading">
                            <tr id="heading-row">
                                <th>Title</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>City</th>
                            </tr>
                        </thead>

                        <tbody id="table-body" class="report-body">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div id="listedDetail" hidden></div>
        <?php
        if ($max != null) {
            if ($max % 5 != 0) {
                $max += 5 - ($max % 5);
            }
        }
        ?>
        <?php if ($city != null) { ?>
            <input type="text" value="<?php echo $city; ?>" id="cities" hidden/>
            City: <?php echo $city; ?> <br/>
        <?php }
        ?>
        <?php if ($yearf != null) { ?>
            <input type="text" value="<?php echo $yearf; ?>" id="year" hidden/>
            Year: <?php echo $yearf; ?> <br/>

        <?php }
        ?>
        <?php if ($province != null) { ?>
            <input type="text" value="<?php echo $province; ?>" id="provinceTb" hidden/>
            Province: <?php echo $province; ?> <br/>
        <?php }
        ?>
        <?php if ($monthQuery != null) { ?>
            <input type="text" value="<?php echo $monthQuery; ?>" id="monthTb" hidden/>
            Month: <?php echo $monthQuery; ?> <br/>
        <?php }
        ?>
        <?php if ($first != null && $last != null) { ?>
            <input type="text" value="<?php echo $first; ?>" id="firstTb" hidden/>
            <input type="text" value="<?php echo $last; ?>" id="lastTb" hidden/>
            From: <?php echo date_format(date_create($first), 'M. j, Y'); ?> To: <?php echo date_format(date_create($last), 'M. j, Y'); ?> <br/>
        <?php }
        ?>
        <?php if ($regionDate != null) { ?>
            <input type="text" value="<?php echo $regionDate; ?>" id="regionDateTb" hidden/>

        <?php }
        ?>
        <?php if ($regionYear != null) { ?>
            <input type="text" value="<?php echo $regionDate; ?>" id="regionYearTb" hidden/>

        <?php }
        ?>
        <?php if ($regionMonth != null) { ?>
            <input type="text" value="<?php echo $regionDate; ?>" id="regionMonthTb" hidden/>

        <?php }
        ?>
        <div id="filterDiv">
            <label>Year: <input type="radio" value="1" id="cbYear" name="date" onClick="showOption(this);" checked/></label>
            <label>Year/Month: <input type="radio" value="2" id="cbYearMonth" name="date" onClick="showOption(this);"/></label>
            <label>Date: <input type="radio" value="3" id="cbDate" name="date" onClick="showOption(this);"/></label><br/>
            <label>Province: <input type="radio" value="4" id="cbProv" name="loc" onClick="showOption(this);" checked/></label>
            <label>City/Municipality: <input type="radio" value="5" id="cbCity" name="loc" onClick="showOption(this);"/></label>
            <label>Cordillera Region: <input type="radio" value="6" id="cbReg" name="loc" onClick="showOption(this);"/></label>
        </div>
        <form id="repForm" method="GET" action="<?php echo base_url() . 'yearlyReports'; ?>">
            <label id="yearLbl">Year:
                <select id="yearCbox" name="year">
                    <?php
                    if ($year != null) {
                        foreach ($year as $ye) {
                            ?>

                            <option><?php echo $ye->date; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </label>
            <label id="monthLbl" hidden>Month:

                <select id ="monthCbox" name="month" disabled>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </label>

            <br/>
            <label id="dateLbl" hidden>
                Date: <label class="dates">From: <input type="text" id="dateBefore" name="first" disabled/></label>
                <label class="dates" >To: <input type="text" id="dateAfter" name="last" disabled/></label>
            </label>
            <label id="provLbl">
                Province:
                <select id="provCbox" name="prov">
                    <?php
                    if ($prov != null) {
                        foreach ($prov as $pro) {
                            ?>
                            <option value="<?php echo $pro->province; ?>"><?php echo $pro->province; ?></option>
                        <?php } ?>
                    <?php }
                    ?>
                </select>
            </label>
            <label id="cityLbl" hidden>
                City/Municipality:
                <select id="cityCbox" name="city" disabled>
                    <?php
                    if ($cities != null) {
                        foreach ($cities as $city) {
                            ?>
                            <option value="<?php echo $city->name; ?>" ><?php echo $city->name; ?></option>

                        <?php } ?>
                    <?php } ?>
                </select>
            </label>
            <br/>
            <?php
            if ($accidents != null) {
                foreach ($accidents as $acc) {
                    ?>
                    <label class="accLbl"><input type="checkbox" class="accType" name="filterType[]" value="<?php echo $acc->classification; ?>" checked/><?php echo $acc->classification; ?></label>
                    <?php
                }
            }
            ?>
            <button onclick="return checkDates();">Submit</button><a href="" class="hide1 print" onClick="window.print();
                return false">Print</a>
        </form>

        <?php if ($month == null && $list != null) { ?>
            <table border="1">
                <tr><th>Types of Accidents</th><th>January</th><th>February</th><th>March</th><th>April</th>
                    <th>May</th><th>June</th><th>July</th><th>August</th><th>September</th>
                    <th>October</th><th>November</th><th>December</th><th>Color Legend</th><th class="detailedView"></th></tr>
                <tr><?php for ($index = 0; $index < count($list); $index++) { ?>

                        <td><?php echo $list[$index]; ?></td>


                        <td><?php echo $Jan[$index]; ?></td>
                        <td><?php echo $Feb[$index]; ?></td>
                        <td><?php echo $Mar[$index]; ?></td>
                        <td><?php echo $April[$index]; ?></td>
                        <td><?php echo $May[$index]; ?></td>
                        <td><?php echo $June[$index]; ?></td>
                        <td><?php echo $July[$index]; ?></td>
                        <td><?php echo $Aug[$index]; ?></td>
                        <td><?php echo $Sept[$index]; ?></td>
                        <td><?php echo $Oct[$index]; ?></td>
                        <td><?php echo $Nov[$index]; ?></td>
                        <td><?php echo $Dec[$index]; ?></td>
                        <td bgcolor="<?php echo $color[$index]; ?>"></td>
                        <td class="detailCell"><button value="<?php echo $list[$index]; ?>" class="detailedView">See More</button></td>
                    </tr>
                <?php }
                ?>
            </table>

            <canvas id="myChart" width="800" height="300"></canvas>
            <script>


    <?php
    foreach ($color as $col) {
        
    }
    ?>
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [
    <?php
    for ($index = 0; $index < count($list); $index++) {
        ?>
                            {
                                fillColor: "rgba(<?php echo hexdec(substr($color[$index], -6, 2)); ?>,<?php echo hexdec(substr($color[$index], -4, 2)); ?>,<?php echo hexdec(substr($color[$index], -2, 2)); ?>,0.5)",
                                strokeColor: "rgba(<?php echo hexdec(substr($color[$index], -6, 2)); ?>,<?php echo hexdec(substr($color[$index], -4, 2)); ?>,<?php echo hexdec(substr($color[$index], -2, 2)); ?>,1)",
                                data: [<?php echo $Jan[$index]; ?>, <?php echo $Feb[$index]; ?>,
        <?php echo $Mar[$index]; ?>, <?php echo $April[$index]; ?>, <?php echo $May[$index]; ?>,
        <?php echo $June[$index]; ?>, <?php echo $July[$index]; ?>, <?php echo $Aug[$index]; ?>,
        <?php echo $Sept[$index]; ?>, <?php echo $Oct[$index]; ?>, <?php echo $Nov[$index]; ?>,
        <?php echo $Dec[$index]; ?>]
                            },
    <?php }
    ?>

                    ]
                }
                var ctx = document.getElementById("myChart").getContext("2d");
                var option = {
                    scaleOverride: true,
                    //** Required if scaleOverride is true **
                    //Number - The number of steps in a hard coded scale
                    scaleSteps: <?php echo $max / 5; ?>,
                    //Number - The value jump in the hard coded scale
                    scaleStepWidth: 5,
                    //Number - The scale starting value
                    scaleStartValue: 0
                };
                new Chart(ctx).Bar(data, option);</script>
        <?php }
        ?>
        <?php if ($month != null) { ?>
            <table>
                <tr><th>Type of Accident</th><th><?php echo $month; ?></th><th></th></tr>
                <?php for ($index = 0; $index < count($accidents); $index++) { ?>
                    <tr><td><?php echo $accidents[$index]->classification; ?></td><td><?php echo $monthCount[$index]; ?></td><td><button value="<?php echo $accidents[$index]->classification; ?>" class="detailedView">See More</button></td></tr>
                <?php }
                ?>
            </table>

        <?php }
        ?>
    </body>
</html>