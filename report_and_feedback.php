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
    <link rel="stylesheet" href="Styles/Super_Admin/reports_and_feedback.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Feedback and Reports Page</title>

<style>

td,th {
    text-align: left;
    padding: 8px;
}

th {
    position: sticky;
    background-color: #0E203F;
    z-index: 1;
    top: -1;
}

</style>
</head>

<body>
    <div id="top_bar_loader"
        style="background: #287BEE;color: white;font-size: 1rem;padding: 0.5rem;text-align: left; display: none;">
        <i class="fa fa-circle-o-notch fa-spin" style="font-size:1rem;margin: 0 0.5rem 0 1rem"></i> Image is still
        uploading.
    </div>

    <div class="body_container" style="display: flex;margin: 0 0 0 0;background: white;height: 100%;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Super_Admin/fixed_side_navigation_bar.php';
             ?>

        </div>

        <!-- HEI/Reports and Feedback/Admin Count -->

        <div class="main_data_container" style="flex: 76%;;display: flex;flex-wrap: wrap;margin: 0 0 0 5%;">

            <div style="flex: 70%;margin: 5% 5% 5% 0%;">

                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">Reports and
                        Feedbacks</p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>

                </div>

                <!-- Table -->
            <div style="overflow:hidden; overflow-y: scroll;overflow-x: scroll;min-height: auto;max-height: 75%;">
                <table id="report_table" class="report_table" style="width:122%">
                    <?php
                $query = "select * from report_bug";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                

                //Number of results
                $result_count = mysqli_num_rows($run_query);

                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;font-size: 0.9rem">
                        <th style="width: 8%;">Report ID</th>
                        <th>Report Title</th>
                        <th style="width: 13%;">Date & Time</th>
                        <th>Report Subject</th>
                        <th>Reporter's Email</th>
                        <th style="width: 8%;">Status</th>
                        <th>Assignee</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        //Super Admin ID assigned in Report_bug table
                        $super_admin_collected_id = $row['super_admin_id'];
                        
                        //FOR SUPER ADMIN
                        $query_super_admin_accounts = "select * from super_admin_account where super_admin_account.super_admin_id = ".$super_admin_collected_id.";";
                        $sub_run_query = mysqli_query($connection,$query_super_admin_accounts);
                        $return_request_from_run_query_2 = mysqli_num_rows($sub_run_query) > 0;


                        //Super Admin Vars
                        $sa_first_name = "null";
                        $sa_last_name = "";
                        $sa_suffix = "";
                        while($sub_row = mysqli_fetch_array($sub_run_query)){
                            $sa_first_name = $sub_row['first_name'];
                            $sa_last_name = $sub_row['last_name'];
                            $sa_suffix = $sub_row['suffix'];
                        }
                        
                        ?>


                    <tr class="edit_data_row" id="edit_data_row" style="font-size: 0.9rem;"
                        onclick="display_feedback_details('<?php echo $row['report_id'];?>','<?php echo $row['super_admin_id'];?>','<?php echo $row['status'];?>','<?php echo $row['report_time'];?>','<?php echo $row['email'];?>','<?php echo $row['report_message'];?>','<?php echo $row['report_title'];?>');">
                        <td><?php echo $row['report_id'];?></td>
                        <td><?php echo $row['report_title'];?></td>
                        <td><?php echo $row['report_time'];?></td>
                        <td><?php echo $row['report_title'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <?php
                        
                        $status_string_value = "Pending";
                        if($row['status'] == "0"){
                            $status_string_value = "Pending";
                        }else if($row['status'] == "1"){
                            $status_string_value = "In-Progress";
                        }else if($row['status'] == "2"){
                            $status_string_value = "Done";
                        }else{
                            $status_string_value = "Unknown";
                        }

                        ?>
                        <td><?php echo $status_string_value;?></td>
                        <?php 
                        
                        if($row['super_admin_id'] == "0"){
                            ?>
                        <td style=""><?php echo 'UNASSIGNED'?></td>
                        <?php
                        }else{
                        ?>
                        <td style=""><?php echo $sa_first_name." ".$sa_last_name." ".$sa_suffix;?></td>
                        <?php 
                        }
                         ?>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <!-- <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button> -->
                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;pointer-events: none;">Options</a>
                                    <!-- View  -->
                                    <a onclick="display_feedback_details('<?php echo $row['report_id'];?>','<?php echo $row['super_admin_id'];?>','<?php echo $row['status'];?>','<?php echo $row['report_time'];?>','<?php echo $row['email'];?>','<?php echo $row['report_message'];?>','<?php echo $row['report_title'];?>');"
                                        style="color: #287BEE;cursor: default;">View</a>
                                    <!-- Edit -->
                                    <a onclick="edit_feedback_details('<?php echo $row['report_id'];?>','<?php echo $row['super_admin_id'];?>','<?php echo $row['status'];?>','<?php echo $row['report_time'];?>','<?php echo $row['email'];?>','<?php echo $row['report_message'];?>','<?php echo $row['report_title'];?>')"
                                        ; style="cursor: default;">Edit</a>
                                    <!-- Remove -->
                                    <a onclick="remove_report('<?php echo $row['report_id'];?>')"
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
                <p style="display: none;padding: 0 0 0 1rem" id="table_empty_set_data_display"
                    class="table_empty_set_data_display">We coudn't find any results for your query.</p>

            </div>

            <!-- Side Navigation -->
            <div class="query_sidenav" style="width: 280px;padding: 0px;height: calc(100% - 5rem);">


                <!-- SEARCH MODULE BLOCK -->
                <div style="margin: 48px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">
                    Search
                </div>
                <div style="margin: 1rem 1.2rem 2% 1.2rem;display: flex;">
                    <input type="text" id="search_field" class="search_field" maxlength="50" placeholder="Search..."
                        style="font-size: 1rem;padding: 0.3rem 0.2rem 0.3rem 0.5rem;width: 60%;border-radius: 1rem;border: 1px solid #A1A1A1;" />
                    <input type="button" value="Search" id="search_btn" class="search_btn"
                        onclick="filterReportsResults()"
                        style="margin: 0 0 0 5%;font-size: 1rem;padding: 0.3rem 0.2rem 0.3rem 0.2rem;width: 35%;border-radius: 1rem;background: #287BEE;border: none;color: white;" />
                </div>
                <div
                    style="margin: 1rem 1.2rem 0 1.2rem;font-size: 1rem;font-weight: normal;text-align: left;color: #434343">
                    <p id="results_output" class="results_output"><?php echo $result_count;?> results found.</p>
                </div>
                <hr style="margin: 1 1.8rem 1 1.8rem;color: #A1A1A1;">
                </hr>
                <div style="margin: 1rem 1.2rem 0.5rem 1.2rem;font-size: 1.1rem;font-weight: bold;text-align: left;">
                    Search By
                </div>

                <div style="margin: 1.5rem 1.2rem 1rem 1.2rem;font-size: 1rem;font-weight: normal;text-align: left;">
                    <fieldset id="search_filter_group" style="border: none;padding:0;">
                        <input type="radio" id="report_id_radio" name="search_filter_group" />Report ID
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="report_email_radio" name="search_filter_group"
                            checked="true" />Email<br>
                        <input type="radio" id="report_status_radio" name="search_filter_group" />Status
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="report_assignee_radio" name="search_filter_group" />Assignee<br>
                    </fieldset>
                </div>
                <!-- END OF SEARCH MODULE BLOCK -->

                <hr style="margin: 1rem 1.8rem 0 1.8rem;color: #A1A1A1;">
                </hr>

                <div class="empty_report_bug_preview" id="empty_report_bug_preview"
                    style="margin: 48px 1.2rem 0 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: block;color: #5E5E5E;">
                    Select a Report to Preview.
                </div>

                <div class="report_bug_details_container" id="report_bug_details_container"
                    style="display: none;overflow: scroll;height: calc(100% - 20rem);">

                    <div style="margin: 32px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">
                        Report Details
                    </div>
                    <br>

                    <!-- REPORT ID DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 10%;text-align: left;font-weight: bold;">
                            Report ID:
                        </div>
                        <div class="report_id_value" id="report_id_value" style="flex: auto;text-align: right;">
                            REPORT_ID
                        </div>
                    </div>

                    <!-- REPORT ASSIGNEE DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 100%;text-align: left;font-weight: bold;">
                            Assignee:
                        </div>

                        <div class="report_assignee_value_container" id="report_assignee_value_container"
                            style="flex: auto;text-align: right;">
                            <select id="report_assignee_value" disabled onchange="submit_assignee_changes()"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">

                                <?php 
                                    $query_get_super_admins = "select * from super_admin_account";
                                    $query_run = mysqli_query($connection, $query_get_super_admins);
                                    $return_request_from_get_admin_query = mysqli_num_rows($query_run) > 0;
                                
                                    while($row = mysqli_fetch_array($query_run)){
                                        ?>
                                <option value="<?php echo $row['super_admin_id']?>">
                                    <?php echo $row['first_name'].' '.$row['last_name'].' '.$row['suffix'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                    </div>

                    <!-- REPORT StATUS DETAILS -->
                    <div
                        style="margin: 0.5rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 100%;text-align: left;font-weight: bold;">
                            Status:
                        </div>
                        <div class="report_status_value_container" id="report_status_value_container"
                            style="flex: auto;text-align: right;">
                            <select id="report_status_value" disabled onchange="submit_status_changes()"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                                <option value="0">Pending</option>
                                <option value="1">In-Progress</option>
                                <option value="2">Done</option>
                            </select>
                        </div>
                    </div>

                    <!-- REPROT DATE AND TIME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 30%;text-align: left;font-weight: bold;">
                            D/T:
                        </div>
                        <div class="report_date_and_time" id="report_date_and_time"
                            style="flex: auto;text-align: right;">
                            DATE_AND_TIME
                        </div>
                    </div>

                    <!-- REPORTER EMAIL DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 10%;text-align: left;font-weight: bold;">
                            Email:
                        </div>
                        <div class="reporter_email" id="reporter_email" style="flex: auto;text-align: right;">
                            REPORTER_EMAIL
                        </div>
                    </div>

                    <!-- REPORT SUBJECT TITLE DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 100%;text-align: left;font-weight: bold;">
                            Report Subject:
                        </div>
                        <br>
                        <br>
                        <div class="report_subject" id="report_subject"
                            style="flex: auto;flex-wrap: wrap;text-align: left;;background:#F1F2F2;border: 0.1rem solid black;padding: 0.5rem">
                            REPORT TITLE/SUBJECT
                        </div>
                    </div>

                    <!-- REPORTER MESSAGE DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 100%;text-align: left;font-weight: bold;">
                            Message:
                        </div>
                        <br>
                        <br>
                        <div class="report_message" id="report_message"
                            style="flex: auto;flex-wrap: wrap;text-align: left;;background:#F1F2F2;border: 0.1rem solid black;padding: 0.5rem">
                            MIDDLE_NAME asdasdasdasdasdasdasd
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAMEMIDDLE_NAME
                            MIDDLE_NAME
                            MIDDLE_NAME
                        </div>
                        <br>
                        <br>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <!-- END of Main Content Container -->
    </div>
</body>

<script>
function display_feedback_details(id_value, assignee_id, status, date_and_time, email, message, title) {
    document.getElementById("report_bug_details_container").style.display = "block";
    document.getElementById("empty_report_bug_preview").style.display = "none";

    if (assignee_id == "0") {
        assignee_id = "0";
        console.log("Value is null");
    }

    //Display Data to Side Panel
    document.getElementById("report_id_value").innerHTML = id_value;
    document.getElementById("report_assignee_value").value = assignee_id;
    document.getElementById("report_status_value").value = status;
    document.getElementById("report_date_and_time").innerHTML = date_and_time;
    document.getElementById("reporter_email").innerHTML = email;
    document.getElementById("report_message").innerHTML = message;
    document.getElementById("report_subject").innerHTML = title;

}

function edit_feedback_details(id_value, assignee_id, status, date_and_time, email, message, title) {
    document.getElementById("report_bug_details_container").style.display = "block";
    document.getElementById("empty_report_bug_preview").style.display = "none";

    console.log("Disable Clicked");

    if (assignee_id == "0") {
        assignee_id = "none";
        console.log("Value is null");
    }

    //Display Data to Side Panel
    document.getElementById("report_id_value").innerHTML = id_value;
    document.getElementById("report_assignee_value").value = assignee_id;
    document.getElementById("report_assignee_value").disabled = false;
    document.getElementById("report_status_value").value = status;
    document.getElementById("report_status_value").disabled = false;
    document.getElementById("report_date_and_time").innerHTML = date_and_time;
    document.getElementById("reporter_email").innerHTML = email;
    document.getElementById("report_message").innerHTML = message;
    document.getElementById("report_subject").innerHTML = title;

}

function edit_admin_details(admin_id, hei_name, first_name, middle_name, last_name, contact, email, birthday,
    account_status, username, password, suffix, address, gender, profile_image) {

    openEditModal();

    //Global var for Profile image deletion option
    Edit_Firebase_Admin_image_link = profile_image;
    console.log(Edit_Firebase_Admin_image_link);

    //Edit - Pass Data to Edit Side Panel Form
    document.getElementById("display_edit").src = profile_image;
    document.getElementById("edit_admin_id").value = admin_id;

    //Sets the Option Selected to the designated HEI
    for (let i = 0; hei_edit_options.length; i++) {
        console.log(hei_edit_options[i].text);
        if (hei_edit_options[i].text == hei_name) {
            document.getElementById("edit_hei_type_selector").value = hei_edit_options[i].value;
            document.getElementById("edit_associated_hei").value = hei_edit_options[i].value;
            console.log("Edit-HEI Selector Option: " + hei_edit_options[i].value);
            console.log("Edit-HEI Input Value: " + hei_edit_options[i].value);
            break;
        }
    }

    document.getElementById("edit_admin_fname").value = first_name;
    document.getElementById("edit_admin_mname").value = middle_name;
    document.getElementById("edit_admin_lname").value = last_name;
    document.getElementById("edit_suffix").value = suffix;

    //Sets the Option Selected to the designated Gender
    for (let k = 0; admin_gender_edit_options.length; k++) {
        if (admin_gender_edit_options[k].value == gender) {
            document.getElementById("edit_gender_selector").value = admin_gender_edit_options[k].value;
            document.getElementById("edit_gender").value = admin_gender_edit_options[k].value;

            break;

        }
    }
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_birthdate").value = birthday;
    document.getElementById("edit_contact_number").value = contact;
    document.getElementById("edit_admin_location").value = address;
    document.getElementById("admin_status").value = account_status;
}

function enable_editing_form() {
    alert("Editting Enabled");
    document.getElementById("report_status_value").disabled = false;
    document.getElementById("report_assignee_value").disabled = false;
}

function remove_report(report_id) {
    $.ajax({
        url: 'Functions/PHP/delete_report_bug.php',
        type: 'post',
        data: {
            report_bug_id: report_id,
        },
        success: function(result) {
            console.log("Successfully Deleted Report Record.");
            //display loader
            $(" .report_table").load(" .report_table");

        },
        error: function(data) {
            alert("error occured" + data); //=== Show Error Message ====//
        }
    });
}

function submitAdminRecord() {
    console.log(Firebase_Admin_image_link);
    //Add trapping
    $.ajax({
        url: 'Functions/PHP/add_admin.php',
        type: 'post',
        data: {
            admin_profile_image: Firebase_Admin_image_link,
            admin_associated_hei: $(".associated_hei").val(),
            admin_fname: $(".add_admin_fname").val(),
            admin_mname: $(".add_admin_mname").val(),
            admin_lname: $(".add_admin_lname").val(),
            admin_location: $(".add_admin_location").val(),
            admin_email: $(".add_email").val(),
            admin_contact: $(".add_contact_number").val(),
            admin_gender: $(".add_gender").val(),
            admin_suffix: $(".add_suffix").val(),
            admin_birthdate: $(".add_birthdate").val(),

            //Change to Generated Values
            admin_username: "admin_sample",
            admin_password: "admin_sample",
            admin_account_status: "1",
        },
        success: function(result) {
            closeModal();
            console.log("Successfully Added a record.");
            console.log($(".associated_hei").val());
            console.log($(".add_admin_fname").val());
            console.log($(".add_admin_mname").val());
            console.log($(".add_admin_lname").val());
            console.log($(".add_admin_location").val());
            console.log($(".add_email").val());
            console.log($(".add_contact_number").val());
            console.log($(".add_gender").val());
            console.log($(".add_suffix").val());
            console.log($(".add_birthdate").val());
            //display loader
            document.getElementById("top_bar_loader").style.display = "none";
            $(" .admin_table").load(" .admin_table");

        },
        error: function(data) {
            alert("error occured" + data); //=== Show Error Message ====//
        }
    });
}

function submit_assignee_changes() {

    $.ajax({
        url: 'Functions/PHP/update_super_admin_in_report_bug.php',
        type: 'post',
        data: {
            report_bug_id: document.getElementById("report_id_value").innerHTML + "",
            report_assignee: document.getElementById("report_assignee_value").value,
        },
        success: function(result) {
            console.log("Successfully Changed Report Assignee.");
            //display loader
            $(" .report_table").load(" .report_table");

        },
        error: function(data) {
            alert("error occured" + data); //=== Show Error Message ====//
        }
    });
}

function submit_status_changes() {

    $.ajax({
        url: 'Functions/PHP/update_status_in_report_bug.php',
        type: 'post',
        data: {
            report_bug_id: document.getElementById("report_id_value").innerHTML + "",
            report_status: document.getElementById("report_status_value").value,
        },
        success: function(result) {
            console.log("Successfully Changed Report Status.");
            //display loader
            $(" .report_table").load(" .report_table");

        },
        error: function(data) {
            alert("error occured" + data); //=== Show Error Message ====//
        }
    });
}

function submitAdminUpdateRecord() {
    console.log(Firebase_Admin_image_link);
    console.log("Entered SubmitAdminUpdateRecord()");
    //Add trapping
    $.ajax({
        url: 'Functions/PHP/update_admin.php',
        type: 'post',
        data: {
            edit_admin_profile_image: Firebase_Admin_image_link,
            edit_admin_id: $(".edit_admin_id").val(),
            edit_admin_associated_hei: $(".edit_associated_hei").val(),
            edit_admin_fname: $(".edit_admin_fname").val(),
            edit_admin_mname: $(".edit_admin_mname").val(),
            edit_admin_lname: $(".edit_admin_lname").val(),
            edit_admin_location: $(".edit_admin_location").val(),
            edit_admin_email: $(".edit_email").val(),
            edit_admin_contact: $(".edit_contact_number").val(),
            edit_admin_gender: $(".edit_gender").val(),
            edit_admin_suffix: $(".edit_suffix").val(),
            edit_admin_birthdate: $(".edit_birthdate").val(),
            edit_admin_username: $(".edit_username").val(),
            edit_admin_password: $(".edit_password").val(),
            admin_account_status: "1",
        },
        success: function(result) {
            closeEditModal();

            //display loader
            document.getElementById("top_bar_loader").style.display = "none";
            $(" .admin_table").load(" .admin_table");
            // $(".hei_details_container").load(" .hei_details_container");
            // $(".main_data_container").load(" .main_data_container");
            // createForm.reset();
        },
        error: function(data) {
            alert("error occured" + data); //===Show Error Message====
        }

    });
}

function convertDateTimeToDate(Date_String) {
    var s = Date_String;
    var bits = s.split(/\D/);
    var date = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

    var dt_string_converted = date;
    dt_string_converted.setMinutes(dt_string_converted.getMinutes() - dt_string_converted.getTimezoneOffset());

    return dt_string_converted;
}

function convertStringToDateTimeObject(Date_String) {
    var s = Date_String;
    var bits = s.split(/\D/);
    var date = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

    var dt_string_converted = date;
    dt_string_converted.setMinutes(dt_string_converted.getMinutes() - dt_string_converted.getTimezoneOffset());

    return dt_string_converted;
}

function filterReportsResults() {
    //Hide Empty Set Label
    document.getElementById("empty_report_bug_preview").style.display = "none";

    var input, filter, table, tr, td, i, txtValue, results_count;
    var report_id_cb, email_cb, status_cb, assignee_cb, filter_tab;

    results_count = 0;
    input = document.getElementById("search_field");
    filter = input.value.toUpperCase();
    table = document.getElementById("report_table");
    tr = table.getElementsByTagName("tr");

    report_id_cb = document.getElementById("report_id_radio");
    email_cb = document.getElementById("report_email_radio");
    status_cb = document.getElementById("report_status_radio");
    assignee_cb = document.getElementById("report_assignee_radio");


    if (report_id_cb.checked) {
        filter_tab = "0";
    } else if (email_cb.checked) {
        filter_tab = "2";
    } else if (status_cb.checked) {
        filter_tab = "3";
    } else if (assignee_cb.checked) {
        filter_tab = "4";
    }

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[filter_tab];
        if (td) {
            txtValue = td.textContent || td.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                ++results_count;
                console.log(results_count);
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }

            //Updates the Result Count Line
            document.getElementById('results_output').innerHTML = results_count + " results found.";
        }

        if (i == (tr.length - 1) && results_count == 0) {
            // Search results were empty or no results match the admin's name
            document.getElementById("table_empty_set_data_display").style.display = "block";
        } else {
            document.getElementById("table_empty_set_data_display").style.display = "none";
        }
    }
}

function setDeleteIDValue(del_id) {
    remove_id = del_id;
    console.log("Remove Admin ID: " + remove_id);

    $.ajax({
        url: 'Functions/PHP/delete_admin.php',
        type: 'post',
        data: {
            admin_id: del_id,
        },
        success: function(result) {
            // $("#result_display").html(result);
            console.log("Successfully Deleted a record.");
            // $(".body_container").load(window.location.href + " .body_container");
            $(" .admin_table").load(" .admin_table");

        }
    });

}
</script>

</html>