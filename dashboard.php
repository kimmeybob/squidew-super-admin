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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.8/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.8/firebase-analytics.js"></script>

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Dashboard</title>


</head>

<body>
    <div id="top_bar_loader"
        style="background: #287BEE;color: white;font-size: 1rem;padding: 0.5rem;text-align: left; display: none;">
        <i class="fa fa-circle-o-notch fa-spin" style="font-size:1rem;margin: 0 0.5rem 0 1rem"></i> Image is still
        uploading.
    </div>
    <div class="body_container" style="display: flex;margin: 0 4rem 0 0;background: white;height: 100%;">

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
            style="min-width:15rem;width: 10px;background:white;display: flex;flex-wrap: wrap;margin: 0 0 0 5%">
            <div style="background: white;flex: 100%;margin: 5%;">
                <p style="background: white;color: black;font-size: 1.25rem;"><b>SQUIDEW Dashboard</b>
                </p>
                <br>

                <div
                    style="background: #4474E5;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #4474E5;">
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
                            style="margin: auto;text-align: center;color: #4474E5;font-weight: bold;text-align:left;margin-left: 20px;font-size: 0.9rem;">
                            Total
                            HEI Partners</p>
                    </div>
                </div>

                <br>
                <div
                    style="background: #4474E5;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #4474E5;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
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
                            style="margin: auto;color: #4474E5;font-weight: bold;text-align:left;margin-left: 20px;font-size: 0.9rem;;">
                            Total
                            Admins</p>
                    </div>
                </div>
                <br>
                <div
                    style="background: #4474E5;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #4474E5;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
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
                            style="margin: auto;text-align: center;color: #4474E5;font-weight: bold;text-align:left;margin-left: 20px;font-size: 0.9rem;;">
                            Reports</p>
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
                        <th>HEI ID</th>
                        <th>Status</th>
                        <th style="text-align: left;">HEI Name</th>
                        <th>Type</th>
                        <th>SOC</th>
                        <th>EOC</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                    <tr>
                        <td onclick="">
                            <?php echo $row['hei_id'];?></td>
                        <?php
                            //Color Selectors depending on Status
                            $color_selected = "#3DBC73";
                            $status_value = "Active";

                            if($row['status'] == "1"){
                                $status_value = "Active";
                                $color_selected = "#3DBC73";
                            }else if($row['status'] == "2"){
                                $status_value = "Offline";
                                $color_selected = "#EF575D";
                            }else if($row['status'] == "0"){
                                $status_value = "Pending";
                                $color_selected = "#F49B45";
                            }
                            ?>
                        <td style="color: <?php echo $color_selected;?>;font-weight: bold;"><?php echo $status_value;
                        ?></td>
                        <td style="text-align: left;"><?php echo $row['hei_name'];?></td>
                        <td style="text-align: center;"><?php echo $row['hei_type'];?></td>
                        <td><?php echo $row['start'];?></td>
                        <td><?php echo $row['end'];?></td>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;pointer-events: none;">Options</a>
                                    <a class="view_btn" style="cursor: default;"
                                        onclick="openViewModal('<?php echo $row['hei_id'];?>','<?php echo $row['hei_name'];?>','<?php echo $row['hei_type'];?>','<?php echo $row['status'];?>','<?php echo $row['start'];?>','<?php echo $row['end'];?>','<?php echo $row['company_email'];?>','<?php echo $row['contact_number'];?>','<?php echo $row['address'];?>','<?php echo $row['profile_image'];?>')">View</a>
                                    <a class="edit_btn"
                                        onclick="openEditModal('<?php echo $row['hei_id'];?>','<?php echo $row['hei_name'];?>','<?php echo $row['hei_type'];?>','<?php echo $row['status'];?>','<?php echo $row['start'];?>','<?php echo $row['end'];?>','<?php echo $row['company_email'];?>','<?php echo $row['contact_number'];?>','<?php echo $row['address'];?>','<?php echo $row['profile_image'];?>')"
                                        style="cursor: default;">Edit</a>
                                    <a class="remove_btn" id="remove_btn"
                                        onclick="setDeleteIDValue('<?php echo $row['hei_id']?>');"
                                        style="color: #EF575C;cursor: default;">Remove</a>
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
            style="z-index: 1;width: 100%;height: calc(100% - 5rem);right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;  transition: 0.5s;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;" onclick="closeModal();">
            </div>

            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal"
                style="height: 100%;background: white;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">


                <div
                    style="flex: auto;height: 5%;margin: 15px 15px 0 15px;background: white;text-align: center;overflow: hidden;">
                    <p style="font-size: 1.3rem;font-weight: bold">Create HEI Profile</p>
                </div>

                <div
                    style="height: calc(100% - 5rem);margin: 2rem 15px 15px 15px;background: white;text-align: center;overflow: scroll;">

                    <!-- FORM  -->
                    <form id="createForm"
                        style="height: 100%;background: white;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">

                        <div style="display: flex;flex-wrap: wrap;width:100%;background: white;">
                            <img id="display" src="Assets/Images/hei_default_icon.png"
                                style="box-shadow: 0px 0.873377px 3.49351px rgba(175, 175, 175, 0.25);object-fit: fit;border: none;height: 10rem;width: 10rem;background: white;border: 2px solid #C0C0C0;border-radius: 10rem;margin:auto;" />

                            <label for="image" class="custom-file-upload"
                                style="color: #287BEE;border-radius: 1rem;border: 1px solid #A1A1A1;display: inline-block;padding: 6px 12px;cursor: pointer;margin: auto;margin-top: 1rem;font-weight: bold;">
                                Upload an Image
                            </label>
                            <input type="file" id="image" style="  display: none;" />

                        </div>

                        <br>
                        <br>
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
                        <div style="">HEI Location <span style="color: #267CCA"></span></div>
                        <input type="text" class="hei_location" minlength="3" maxlength="50" name="hei_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;"
                            required />

                        <br>
                        <br>
                        <div style="">HEI Email <span style="color: #267CCA"></span></div>
                        <input type="text" class="hei_email" minlength="8" maxlength="50" name="hei_email"
                            id="hei_email" placeholder="e.g. sample@university.com"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Contact<span style="color: #267CCA"></span></div>
                        <input type="tel" class="hei_contact" minlength="8" maxlength="50" name="hei_contact"
                            id="hei_contact" placeholder="e.g. XXXXXXXXXXX"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Type</div>
                        <select id="hei_type_selector" onchange="display_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="Private">Private</option>
                            <option value="Public">Public (Test)</option>
                        </select>

                        <input type="text" class="hei_type" id="hei_type" minlength="3" maxlength="50" name="hei_type"
                            placeholder="e.g. squidew university" value="Private"
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
                            <option value="0">Pending</option>
                            <option value="1">Active</option>
                            <option value="2">Offline</option>
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
                        <div style="display:block;">Start of Contract</div>
                        <input type="datetime-local" class="hei_start_contract" minlength="3" maxlength="50"
                            name="hei_start_contract" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />

                        <br>
                        <div style="display:block;">End of Contract</div>

                        <input type="datetime-local" class="hei_end_contract" minlength="3" maxlength="50"
                            placeholder="e.g. squidew university" name="hei_end_contract"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <br>
                        <input type="button" value="Submit" id="add_new_profile_btn"
                            style="display:block;background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 0 15%;" />
                        </br>
                        </br></br>
                        </br>
                    </form>

                </div>
                </br>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- CREATE/NEW HEI PROFILE ------->



        <!----------------- SIDE PANEL -- VIEW PROFILE ------------------------------------------------>
        <div id="sidebar_modal_container_view"
            style="z-index: 1;width: 100%;height: calc(100% - 5rem);right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;height: 100%;"
                onclick="closeEditModal();">

            </div>
            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeViewModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal_view"
                style="background: white;height: 100%;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div
                    style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;text-align: center;overflow: hidden;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">HEI Details</p>
                </div>

                <div
                    style="flex: auto;height: calc(100% - 5rem);margin: 2rem 15px 15px 15px;text-align: center;overflow: scroll">

                    <!-- FORM  -->
                    <form method="POST"
                        style="display: block;height: 100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">


                        <div style="display: flex;flex-wrap: wrap;width:100%;background: white;">
                            <img id="view_display"
                                style="box-shadow: 0px 0.873377px 3.49351px rgba(175, 175, 175, 0.25);object-fit: fit;border: none;height: 10rem;width: 10rem;background: white;border: 2px solid #C0C0C0;border-radius: 10rem;margin:auto;" />

                        </div>

                        <br>
                        <br>
                        <div style="display: flex;flex-wrap: wrap;width:100%;">

                            <div style="width: 50%;">HEI ID No.</div>

                            <input type="text" class="view_hei_id" id="view_hei_id" minlength="3" maxlength="50"
                                name="view_hei_id" value="default_ID" value="DEFAULT_ID" disabled="disabled"
                                style="pointer-events: none;cursor: default;border: none;width: 50%;font-size: 1.2rem;font-weight: normal;text-align: right;" />
                        </div>


                        <br>
                        <div style="">HEI Name</div>
                        <input type="text" class="view_hei_name" id="view_hei_name" minlength="3" maxlength="50"
                            name="view_hei_name" placeholder="e.g. squidew university" value="DEFAULT_NAME"
                            disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;font-weight: normal"
                            required />

                        <br>
                        <br>
                        <div style="">HEI Location <span style="color: #267CCA"></span></div>
                        <input type="text" class="view_hei_location" minlength="3" maxlength="50"
                            name="view_hei_location" id="view_hei_location" disabled="disabled"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City" value="DEFAULT_LOCATION"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;font-weight: normal;text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Email <span style="color: #267CCA"></span></div>
                        <input type="text" class="view_hei_email" minlength="8" maxlength="50" name="view_hei_email"
                            id="view_hei_email" placeholder="e.g. sample@university.com" value="DEFAULT_EMAIL"
                            disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;font-weight: normal;text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Contact <span style="color: #267CCA"></span></div>
                        <input type="tel" class="view_hei_contact" minlength="8" maxlength="50" name="view_hei_contact"
                            id="view_hei_contact" placeholder="e.g. XXXXXXXXXXX" value="DEFAULT_HOTLINE"
                            disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;font-weight: normal;text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Type</div>

                        <input type="text" class="view_hei_type" id="view_hei_type" minlength="3" maxlength="50"
                            name="view_hei_type" placeholder="e.g. squidew university" value="private"
                            disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;font-weight: normal;" />
                        <br>
                        <br>
                        <div style="">HEI Status</div>

                        <input type="text" class="view_hei_status" id="view_hei_status" minlength="3" maxlength="50"
                            disabled="disabled" name="view_hei_status" placeholder="e.g. squidew university" value="2"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;font-weight: normal;color: #3DBC73;" />
                        <br>
                        <br>
                        <div style="">Start of Contract</div>

                        <input type="datetime-local" class="view_hei_start_contract" id="view_hei_start_contract"
                            name="view_hei_start_contract" disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 120%;font-size: 0.9rem;font-weight: normal;display: flex;" />

                        <br>
                        <div style="">End of Contract</div>

                        <input type="datetime-local" class="view_hei_end_contract" id="view_hei_end_contract"
                            name="view_hei_end_contract" disabled="disabled"
                            style="border: none;margin: 10 0 10 0;width: 120%;font-size: 0.9rem;font-weight: normal;display: flex;" />
                        <br>
                        <br>
                    </form>

                </div>
                </br>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- VIEW PROFILE ------->



        <!----------------- SIDE PANEL -- EDIT HEI PROFILE ------------------------------------------------>
        <div id="sidebar_modal_container_edit"
            style="z-index: 1;width: 100%;height: calc(100% - 5rem);right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;height: 100%;"
                onclick="closeEditModal();">
            </div>
            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeEditModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal_edit"
                style="background: white;height: 100%;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;overflow: scroll;">

                <div
                    style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;text-align: center;overflow: hidden;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">Edit HEI Profile</p>
                </div>

                <div style="flex: auto;height: 100%;margin: 2rem 15px 15px 15px;text-align: center;overflow: hidden">

                    <!-- FORM  -->
                    <form method="POST"
                        style="display: block;height: 100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">


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
                        <div style="">HEI Location <span style="color: #267CCA"></span></div>
                        <input type="text" class="edit_hei_location" minlength="3" maxlength="50"
                            name="edit_hei_location" id="edit_hei_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City" value="DEFAULT_LOCATION"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Email <span style="color: #267CCA"></span></div>
                        <input type="text" class="edit_hei_email" minlength="8" maxlength="50" name="edit_hei_email"
                            id="edit_hei_email" placeholder="e.g. sample@university.com" value="DEFAULT_EMAIL"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />

                        <br>
                        <br>
                        <div style="">HEI Contact <span style="color: #267CCA"></span></div>
                        <input type="tel" class="edit_hei_contact" minlength="8" maxlength="50" name="edit_hei_contact"
                            id="edit_hei_contact" placeholder="e.g. XXXXXXXXXXX" value="DEFAULT_HOTLINE"
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
                            <option value="0">Pending</option>
                            <option value="1">Active</option>
                            <option value="2">Offline</option>
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
                            name="edit_hei_start_contract"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />

                        <br>
                        <div style="">End of Contract</div>

                        <input type="datetime-local" class="edit_hei_end_contract" id="edit_hei_end_contract"
                            name="edit_hei_end_contract"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <br>
                        <input type="button" value="submit" id="edit_profile_btn"
                            style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 15%;" />

                    </form>

                </div>
                </br>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- EDIT HEI PROFILE ------->
    </div>



</body>
<script src="jquery-3.1.1.min.js"></script>
<script>
let remove_id = 0;
var Firebase_HEI_image_link =
    "https://firebasestorage.googleapis.com/v0/b/squidew-8401a.appspot.com/o/hei_images%2Fdefault.png?alt=media&token=e13c3f43-6d9d-494a-91f9-48ad1bf6cc70";

$(document).ready(function() {
    //Add HEI Profile Form Button
    // $("#add_new_profile_btn").click();

    //Add HEI Profile Form Button
    $("#edit_profile_btn").click(function() {
        //Add trapping
        $.ajax({
            url: 'Functions/PHP/update_hei_form.php',
            type: 'post',
            data: {
                edit_hei_id: $(".edit_hei_id").val(),
                edit_hei_name: $(".edit_hei_name").val(),
                edit_hei_location: $(".edit_hei_location").val(),
                edit_hei_email: $(".edit_hei_email").val(),
                edit_hei_contact: $(".edit_hei_contact").val(),
                edit_hei_type: $(".edit_hei_type").val(),
                edit_hei_status: $(".edit_hei_status").val(),
                edit_hei_start: $(".edit_hei_start_contract").val(),
                edit_hei_end: $(".edit_hei_end_contract").val(),
            },
            success: function(result) {
                closeEditModal();
                console.log(result + " ||");
                console.log("Successfully Update a record.");
                $(".hei_details_container").load(" .hei_details_container");
                $(".main_data_container").load(" .main_data_container");
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
                $(".hei_details_container").load(" .hei_details_container");
                $(".main_data_container").load(" .main_data_container");

            }
        });
    });
});
</script>
<script>
function submitHEIRecord() {
    console.log(Firebase_HEI_image_link);
    //Add trapping
    $.ajax({
        url: 'Functions/PHP/add_hei_form.php',
        type: 'post',
        data: {
            hei_profile_image: Firebase_HEI_image_link,
            hei_id: $(".hei_id").val(),
            hei_name: $(".hei_name").val(),
            hei_location: $(".hei_location").val(),
            hei_email: $(".hei_email").val(),
            hei_contact: $(".hei_contact").val(),
            hei_type: $(".hei_type").val(),
            hei_status: $(".hei_status").val(),
            hei_start_contract: $(".hei_start_contract").val(),
            hei_end_contract: $(".hei_end_contract").val(),
        },
        success: function(result) {
            closeModal();
            createForm.reset();
            console.log("Successfully Added a record.");

            //display loader
            document.getElementById("top_bar_loader").style.display = "none";
            $(".hei_details_container").load(" .hei_details_container");
            $(".main_data_container").load(" .main_data_container");

        }
    });
}

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
            $(".hei_details_container").load(" .hei_details_container");
            $(".main_data_container").load(" .main_data_container");

        }
    });

}

//Modal for Edit HEI Profile
function openEditModal(HEI_ID, HEI_Name, HEI_Type, Status, Start, End, Email, ContactNumber, Address) {
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
    document.getElementById("edit_hei_location").value = Address;
    document.getElementById("edit_hei_contact").value = ContactNumber;
    document.getElementById("edit_hei_email").value = Email;
    document.getElementById("edit_hei_type").value = HEI_Type;

    if (Status == "0") {
        document.getElementById("edit_hei_status_selector").getElementsByTagName('option')[0].selected = 'selected';
        document.getElementById("edit_hei_status").value = Status;
    } else if (Status == "1") {
        document.getElementById("edit_hei_status_selector").getElementsByTagName('option')[1].selected = 'selected';
        document.getElementById("edit_hei_status").value = Status;
    } else if (Status == "2") {
        document.getElementById("edit_hei_status_selector").getElementsByTagName('option')[2].selected = 'selected';
        document.getElementById("edit_hei_status").value = Status;
    } else {
        document.getElementById("edit_hei_status_selector").getElementsByTagName('option')[0].selected = 'selected';
        document.getElementById("edit_hei_status").value = Status;
    }


    document.getElementById("edit_hei_start_contract").value = convertStringToDateTimeObject(Start).toISOString().slice(
        0, 16);
    document.getElementById("edit_hei_end_contract").value = convertStringToDateTimeObject(End).toISOString().slice(0,
        16);
    console.log("Converted String Date: " + convertStringToDateTimeObject(End));
}

function closeEditModal() {
    sidebar_modal_container_edit.style.display = "none";
}

//Modal for View HEI Profile
function openViewModal(HEI_ID, HEI_Name, HEI_Type, Status, Start, End, Email, ContactNumber, Address, ProfileImage) {
    console.log("HEI ID: " + HEI_ID);
    console.log("HEI Name: " + HEI_Name);
    console.log("HEI Type: " + HEI_Type);
    console.log("HEI Status: " + Status);
    console.log("HEI Contract Start: " + Start);
    console.log("HEI Contract Edn: " + End);
    console.log("HEI Profile Firebase: " + ProfileImage);
    sidebar_modal_container_view.style.display = "flex";

    //set Field Data to View Side Panel Form
    document.getElementById("view_hei_id").value = HEI_ID;
    document.getElementById("view_hei_name").value = HEI_Name;
    document.getElementById("view_hei_location").value = Address;
    document.getElementById("view_hei_contact").value = ContactNumber;
    document.getElementById("view_hei_email").value = Email;
    document.getElementById("view_hei_type").value = HEI_Type;
    document.getElementById("view_display").src = ProfileImage;


    //For Status
    var status_display_value = "Active";
    if (Status == "1") {
        status_display_value = "Active";
        view_hei_status.style.color = "#3DBC73";
    } else if (Status == "2") {
        status_display_value = "Offline";
        view_hei_status.style.color = "#EF575D";
    } else if (Status == "3") {
        status_display_value = "Pending";
        view_hei_status.style.color = "#F49B45";
    }
    document.getElementById("view_hei_status").value = status_display_value;

    document.getElementById("view_hei_start_contract").value = convertStringToDateTimeObject(Start).toISOString().slice(
        0, 16);
    document.getElementById("view_hei_end_contract").value = convertStringToDateTimeObject(End).toISOString().slice(0,
        16);

    console.log("Converted String Date: " + convertStringToDateTimeObject(End));
}

function closeViewModal() {
    sidebar_modal_container_view.style.display = "none";
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

<script>
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyAL0QsuGzCsNzCcTLvOehvsRb0MCHgV75g",
    authDomain: "squidew-8401a.firebaseapp.com",
    projectId: "squidew-8401a",
    storageBucket: "squidew-8401a.appspot.com",
    messagingSenderId: "119330958538",
    appId: "1:119330958538:web:eb3fcf4ccf05f2ae8b1833",
    measurementId: "G-V3CYSTG8S9"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();


const btn = document.querySelector('#add_new_profile_btn');

btn.addEventListener('click', function(e) {
    e.preventDefault();

    const storage = firebase.storage();
    const storageRef = storage.ref('hei_images/');

    var file = document.querySelector('#image').files[0];
    var name = new Date() + '-' + file.name;

    var metadata = {
        contentType: file.type
    }

    var uploadTask = storageRef.child(name).put(file, metadata);

    uploadTask.then(snapshot => snapshot.ref.getDownloadURL())
        .then(url => {
            console.log(url);
            document.getElementById("top_bar_loader").style.display = "block";
            document.querySelector('#display').src = url;
            document.querySelector('#image').value = "";
            Firebase_HEI_image_link = url;
            submitHEIRecord();
        })
})

document.getElementById("image").onchange = function(evt) {

    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function() {
            document.getElementById("display").src = fr.result;
            document.getElementById("display").style.objectFit = "cover";
            console.log(fr.result);
        }
        fr.readAsDataURL(files[0]);
    }

    // Not supported
    else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
    }
}
</script>

</html>