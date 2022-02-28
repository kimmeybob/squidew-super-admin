<?php
//Default_Style_Links 
require 'Router/Style_Links/links.php';
require 'Components/Super_Admin/header.php';
//Font
require 'Assets/Fonts/Robot_Regular_Web_Import.php';
//Main Links
require 'Router/Page_Links/main_links.php';

//Database Connection
require 'Database Settings/database_access_credentials.php';



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $default_header_style_link;?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo $super_admin_dashboard_style_link;?>?" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Dashboard</title>


</head>

<body>
    <div class="body_container" style="display: flex;margin: 0 5% 0 0;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Super_Admin/fixed_side_navigation_bar.php';
             ?>

        </div>

        <!-- HEI/Reports and Feedback/Admin Count -->
        <?php
        $query = "select * from hei";
        $run_query = mysqli_query($connection,$query);
        $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
        ?>
        <div class="hei_details_container"
            style="flex: 11%;background: white;display: flex;flex-wrap: wrap;margin: 0 0 0 5%">
            <div style="background: white;flex: 100%;margin: 5%;">
                <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>SQUIDEW Dashboard</b>
                </p>
                <br>
                <div
                    style="background: #3A72E8;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #3A72E8;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php 
                            //RETURNS HEI COUNT
                            $query_get_hei = "select count(hei_id) as hei_count from hei";
                            $query_run = mysqli_query($connection, $query_get_hei);
                            $return_request_from_query_get_hei = mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['hei_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 73%;background: white;display: flex;flex-wrap: wrap;">
                        <p
                            style="margin: auto;text-align: center;color: #3A72E8;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Total
                            HEI Partners</p>
                    </div>
                </div>
                <br>
                <div
                    style="background: #FBEFC9;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #F1BE35;">
                    <div
                        style="flex: 25%;color: #F2B54C;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php
                            //RETURNS ACTIVE ADMIN COUNT
                            $query_get_active_admins = "select count(admin_id) as admin_count from admin where account_status = 1";
                            $query_run = mysqli_query($connection, $query_get_active_admins);
                            $return_request_from_get_active_admin = mysqli_num_rows($query_run) > 0;

                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['admin_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 75%;background: white;display: flex;flex-wrap: wrap;">
                        <p
                            style="margin: auto;color: #F2B54C;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Total
                            Admins</p>
                    </div>
                </div>
                <br>
                <div
                    style="background: #F6AFB3;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #EF575C;">
                    <div
                        style="flex: 25%;color: #FF4444;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php
                            //RETURNS BUG REPORT COUNT
                            $query_get_report_bugs = "select count(report_id) as report_bugs_count from report_bug";
                            $query_run = mysqli_query($connection, $query_get_report_bugs);
                            $return_request_from_get_report_bugs = mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['report_bugs_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 75%;background: white;display: flex;flex-wrap: wrap;">
                        <p
                            style="margin: auto;text-align: center;color: #FF4444;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Reports/Feedbacks</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap;">
            <div style="background: white;flex: 100%;margin: 5% 2% 5% 2%;height: 100%;">
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">HEI Partner
                        List</p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    <div
                        style="background:white;flex: 20%;color: black;overflow: hidden;margin:auto;text-align: right;">
                        <button
                            style="flex: auto;font-size:1rem;background: #3A72E8;border: none;padding: 3% 10% 3% 10%;border-radius: 50px;color: white;"
                            onclick="openModal();">
                            Add
                        </button>
                    </div>
                </div>

                <!-- Table -->

                <table style="width:100%">
                    <?php
                
                $query = "select * from hei";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;">
                        <th>HEI ID No.</th>
                        <th style="text-align: left;">Higher Education Instituition</th>
                        <th>HEI Type</th>
                        <th>Status</th>
                        <th>Start of Contract</th>
                        <th>End of Contract</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                    <tr>
                        <td onclick="">
                            <?php echo $row['HEI_ID'];?></td>
                        <td style="text-align: left;"><?php echo $row['HEI_Name'];?></td>
                        <td><?php echo $row['HEI_Type'];?></td>
                        <td><?php 
                        if($row['Status'] == "1"){
                            echo "Active";
                        }else if($row['Status'] == "0"){
                            echo "Offline";
                        }else if($row['Status'] == "2"){
                            echo "Pending";
                        }?></td>
                        <td><?php echo $row['Start'];?></td>
                        <td><?php echo $row['End'];?></td>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;">Options</a>
                                    <a onclick="openEditModal('<?php echo $row['HEI_ID'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['HEI_Type'];?>','<?php echo $row['Status'];?>','<?php echo $row['Start'];?>','<?php echo $row['End'];?>')"
                                        style="">Edit</a>
                                    <a id="remove_btn" onclick="setDeleteIDValue('<?php echo $row['HEI_ID']?>');"
                                        style="color: #EF575C;">Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </table>
            </div>
        </div>
        <!-- END of Main Content Container -->



        <!----------------- SIDE PANEL -- CREATE/NEW HEI PROFILE ------------------------------------------------>
        <div id="sidebar_modal_container"
            style="z-index: 1;width: 100%;height: 100%;right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;  transition: 0.5s;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;" onclick="closeModal();">
            </div>

            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal"
                style="background: white;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div
                    style="flex: auto;height: 5%;margin: 15px 15px 0 15px;background: white;text-align: center;overflow: hidden;">
                    <p style="font-size: 1.3rem;font-weight: bold">Create HEI Profile</p>
                </div>

                <div
                    style="flex: auto;height: 85%;margin: 0 15px 15px 15px;background: white;text-align: center;overflow: hidden;">


                    <!-- FORM  -->
                    <form action="Functions/PHP/add_hei_form.php" method="POST"
                        style="height: 100%;background: white;overflow: hidden;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">
                        <div style="display: flex;flex-wrap: wrap;width:100%;">

                            <div style="width: 50%;">HEI ID No.</div>

                            <?php
                        $query_get_last_hei_id = "select auto_increment from information_schema.tables where table_name = 'hei' and table_schema = DATABASE();";
                        $query_run = mysqli_query($connection, $query_get_last_hei_id);
                        $return_request_from_get_last_hei_id = mysqli_num_rows($query_run) > 0;

                        $last_hei_id_value = 0;

                        while($row = mysqli_fetch_array($query_run)){
                            $last_hei_id_value = (int)$row['auto_increment'];
                        }

                        ?>
                            <input type="text" class="hei_id" minlength="3" maxlength="50" name="hei_id"
                                value="<?php  echo $last_hei_id_value;?>"
                                style="pointer-events: none;cursor: default;border: none;width: 50%;font-size: 1.2rem;font-weight: normal;text-align: right;" />
                        </div>


                        <br>
                        <div style="">HEI Name</div>
                        <input type="text" class="hei_name" id="hei_name" minlength="3" maxlength="50" name="hei_name"
                            placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">HEI Location <span style="color: #267CCA">( TEST_FIELD )</span></div>
                        <input type="text" class="hei_location" minlength="3" maxlength="50" name="hei_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;"
                            required />

                        <br>
                        <br>
                        <div style="">HEI Type</div>
                        <select id="hei_type_selector" onchange="display_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="private">Private</option>
                            <option value="public">Public (Test)</option>
                        </select>

                        <input type="text" class="hei_type" id="hei_type" minlength="3" maxlength="50" name="hei_type"
                            placeholder="e.g. squidew university" value="private"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function display_selection() {
                            var select = document.getElementById('hei_type_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("hei_type").value = selected_option_text;
                            console.log(selected_option_text);
                            // alert(document.getElementById("hei_type").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">HEI Status</div>
                        <select id="hei_status_selector" onchange="display_status_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="2">Pending</option>
                            <option value="1">Active</option>
                            <option value="0">Offline</option>
                        </select>

                        <input type="text" class="hei_status" id="hei_status" minlength="3" maxlength="50"
                            name="hei_status" placeholder="e.g. squidew university" value="1"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        var name_sample = document.getElementById("hei_name").value;
                        // var name_sample = same_name.value;

                        function display_status_selection() {
                            var select = document.getElementById('hei_status_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("hei_status").value = selected_option_text;
                            console.log(selected_option_text + " | Value: " + select.options[select.selectedIndex]
                                .value);
                            // alert(document.getElementById("hei_status").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">Start of Contract</div>

                        <input type="datetime-local" class="hei_start_contract" minlength="3" maxlength="50"
                            name="hei_start_contract" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />

                        <br>
                        <div style="">End of Contract</div>

                        <input type="datetime-local" class="hei_end_contract" minlength="3" maxlength="50"
                            placeholder="e.g. squidew university" name="hei_end_contract"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <br>
                        <input type="button" value="submit" id="add_new_profile_btn"
                            style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 0 15%;" />
                    </form>
                </div>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- CREATE/NEW HEI PROFILE ------->



        <!----------------- SIDE PANEL -- EDIT HEI PROFILE ------------------------------------------------>
        <div id="sidebar_modal_container_edit"
            style="z-index: 1;width: 100%;height: 100%;right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;  transition: 0.5s;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;" onclick="closeEditModal();">

            </div>
            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeEditModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal_edit"
                style="background: white;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div
                    style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;background: white;text-align: center;overflow: hidden;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">Edit HEI Profile</p>
                </div>

                <div
                    style="flex: auto;height: 85%;margin: 0 15px 15px 15px;background: white;text-align: center;overflow: hidden;">



                    <!-- FORM  -->
                    <form method="POST"
                        style="height: 100%;background: white;overflow: hidden;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">


                        <div style="display: flex;flex-wrap: wrap;width:100%;">



                            <div style="width: 50%;">HEI ID No.</div>


                            <input type="text" class="edit_hei_id" id="edit_hei_id" minlength="3" maxlength="50"
                                name="edit_hei_id" value="default_ID" value="DEFAULT_ID"
                                style="pointer-events: none;cursor: default;border: none;width: 50%;font-size: 1.2rem;font-weight: normal;text-align: right;" />
                        </div>


                        <br>
                        <div style="">HEI Name</div>
                        <input type="text" class="edit_hei_name" id="edit_hei_name" minlength="3" maxlength="50"
                            name="edit_hei_name" placeholder="e.g. squidew university" value="DEFAULT_NAME"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">HEI Location <span style="color: #267CCA">( TEST_FIELD )</span></div>
                        <input type="text" class="edit_hei_location" minlength="3" maxlength="50"
                            name="edit_hei_location" id="edit_hei_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City" value="DEAFULT_LOCATION"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Type</div>
                        <select id="edit_hei_type_selector" onchange="edit_display_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="private">Private</option>
                            <option value="public">Public (Test)</option>
                        </select>

                        <input type="text" class="edit_hei_type" id="edit_hei_type" minlength="3" maxlength="50"
                            name="edit_hei_type" placeholder="e.g. squidew university" value="private"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function edit_display_selection() {
                            var select = document.getElementById('edit_hei_type_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("edit_hei_type").value = selected_option_text;
                            console.log(selected_option_text);
                            // alert(document.getElementById("hei_type").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">HEI Status</div>
                        <select id="edit_hei_status_selector" onchange="edit_display_status_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="2">Pending</option>
                            <option value="1">Active</option>
                            <option value="0">Offline</option>
                        </select>

                        <input type="text" class="edit_hei_status" id="edit_hei_status" minlength="3" maxlength="50"
                            name="edit_hei_status" placeholder="e.g. squidew university" value="2"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function edit_display_status_selection() {
                            var select = document.getElementById('edit_hei_status_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("edit_hei_status").value = selected_option_text;
                            console.log(selected_option_text + " | Value: " + select.options[select.selectedIndex]
                                .value);
                            // alert(document.getElementById("hei_status").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">Start of Contract</div>

                        <input type="datetime-local" class="edit_hei_start_contract" id="edit_hei_start_contract"
                            minlength="3" maxlength="50" name="edit_hei_start_contract"
                            placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />

                        <br>
                        <div style="">End of Contract</div>

                        <input type="datetime-local" class="edit_hei_end_contract" id="edit_hei_end_contract"
                            minlength="3" maxlength="50" placeholder="e.g. squidew university"
                            name="edit_hei_end_contract"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <br>
                        <input type="button" value="submit" id="edit_profile_btn"
                            style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 0 15%;" />
                    </form>
                </div>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- EDIT HEI PROFILE ------->

    </div>
</body>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script>
let remove_id = 0;
$(document).ready(function() {
    //Add HEI Profile Form Button
    $("#add_new_profile_btn").click(function() {
        //Add trapping
        $.ajax({
            url: 'Functions/PHP/add_hei_form.php',
            type: 'post',
            data: {
                hei_id: $(".hei_id").val(),
                hei_name: $(".hei_name").val(),
                hei_location: $(".hei_location").val(),
                hei_type: $(".hei_type").val(),
                hei_status: $(".hei_status").val(),
                hei_start_contract: $(".hei_start_contract").val(),
                hei_end_contract: $(".hei_end_contract").val(),
            },
            success: function(result) {
                // $("#result_display").html(result);
                closeModal();
                console.log("Successfully Added a record.");
                // $(".body_container").load(window.location.href + " .body_container");
                $(".hei_details_container").load(window.location.href +
                    " .hei_details_container");
                $(".main_data_container").load(window.location.href +
                    " .main_data_container");

            }
        });
    });

    //Add HEI Profile Form Button
    $("#edit_profile_btn").click(function() {
        //Add trapping
        $.ajax({
            url: 'Functions/PHP/update_hei_form.php',
            type: 'post',
            data: {
                hei_id: $(".edit_hei_id").val(),
                hei_name: $(".edit_hei_name").val(),
                hei_location: $(".edit_hei_location").val(),
                hei_type: $(".edit_hei_type").val(),
                hei_status: $(".edit_hei_status").val(),
                hei_start_contract: $(".edit_hei_start_contract").val(),
                hei_end_contract: $(".edit_hei_end_contract").val(),
            },
            success: function(result) {
                // $("#result_display").html(result);
                closeModal();
                // $(".body_container").load(window.location.href + " .body_container");
                console.log("Successfully Update a record.");
                $(".hei_details_container").load(window.location.href +
                    " .hei_details_container");
                $(".main_data_container").load(window.location.href +
                    " .main_data_container");
            }
        });
    });

    $("#remove_btn").click(function() {
        //Add trapping
        $.ajax({
            url: 'Functions/PHP/delete_hei.php',
            type: 'post',
            data: {
                remove_id: remove_id,
            },
            success: function(result) {
                // $("#result_display").html(result);
                console.log("Successfully Deleted a record.");
                // $(".body_container").load(window.location.href + " .body_container");
                $(".hei_details_container").load(window.location.href +
                    " .hei_details_container");
                $(".main_data_container").load(window.location.href +
                    " .main_data_container");

            }
        });
    });
});
</script>
<script>
//Modal for Create/New HEI Profile
function closeModal() {
    sidebar_modal_container.style.display = "none";
}

function openModal() {
    sidebar_modal_container.style.display = "flex";
}

function setDeleteIDValue(del_id) {
    remove_id = del_id;
    console.log("Remove ID: " + remove_id);

    $.ajax({
        url: 'Functions/PHP/delete_hei.php',
        type: 'post',
        data: {
            remove_id: del_id,
        },
        success: function(result) {
            // $("#result_display").html(result);
            console.log("Successfully Deleted a record.");
            // $(".body_container").load(window.location.href + " .body_container");
            $(".hei_details_container").load(window.location.href +
                " .hei_details_container");
            $(".main_data_container").load(window.location.href +
                " .main_data_container");

        }
    });

}

//Modal for Edit HEI Profile
function openEditModal(HEI_ID, HEI_Name, HEI_Type, Status, Start, End) {
    console.log("HEI ID: " + HEI_ID);
    console.log("HEI Name: " + HEI_Name);
    console.log("HEI Type: " + HEI_Type);
    console.log("HEI Status: " + Status);
    console.log("HEI Contract Start: " + Start);
    console.log("HEI Contract Edn: " + End);
    sidebar_modal_container_edit.style.display = "flex";

    //set Field Data to Edit Side Panel Form
    document.getElementById("edit_hei_id").value = HEI_ID;
    document.getElementById("edit_hei_name").value = HEI_Name;
    document.getElementById("edit_hei_location").value = "Cebu City";
    document.getElementById("edit_hei_type").value = HEI_Type;
    document.getElementById("edit_hei_status").value = Status;

    document.getElementById("edit_hei_start_contract").value = convertStringToDateTimeObject(Start).toISOString().slice(
        0, 16);
    document.getElementById("edit_hei_end_contract").value = convertStringToDateTimeObject(End).toISOString().slice(0,
        16);
    console.log("Converted String Date: " + convertStringToDateTimeObject(End));
}

function closeEditModal() {
    sidebar_modal_container_edit.style.display = "none";
}

function displayHEI_ID(hei_id) {
    alert("HEI ID: " + hei_id);
}


//Date-Time String to Date Object Converter Function
function convertStringToDateTimeObject(Date_String) {
    var s = Date_String;
    var bits = s.split(/\D/);
    var date = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

    var dt_string_converted = date;
    dt_string_converted.setMinutes(dt_string_converted.getMinutes() - dt_string_converted.getTimezoneOffset());

    return dt_string_converted;
}
</script>

</html>