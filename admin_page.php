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
    <link rel="stylesheet" href="Styles/Super_Admin/admin_page_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">



    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Admin Accounts Page</title>


</head>

<body style="background: maroon">

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
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">Admin
                        Accounts</p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    <div
                        style="background:white;flex: 20%;color: black;overflow: hidden;margin:auto;text-align: right;">
                        <button
                            style="flex: auto;font-size:1rem;background: #3A72E8;border: none;padding: 3% 10% 3% 10%;border-radius: 50px;color: white;"
                            onclick="openModal();">
                            Add User
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <table id="admin_table" class="admin_table" style="width:100%;">
                    <?php
                
                $query = "select * from admin inner join hei on admin.hei_id = hei.hei_id";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;

                //Number of results
                $result_count = mysqli_num_rows($run_query);
                
                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;">
                        <th>Admin ID</th>
                        <th>HEI</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Status</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        $admin_status = "Active";
                        if($row['account_status'] == 0){
                            $admin_status = "Offline";
                        }else if($row['account_status'] == 1){
                            $admin_status = "Active";
                        }else{
                            $admin_status = "On Leave";
                        }
                        ?>
                    <tr class="admin_data_row" id="admin_data_row"
                        onclick="display_admin_details('<?php echo $row['admin_id'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['first_name'];?>','<?php echo $row['middle_name'];?>','<?php echo $row['last_name'];?>','(FIELD_TEST)','<?php echo $row['email'];?>','<?php echo $row['birthday'];?>','<?php echo $admin_status;?>','<?php echo $row['username'];?>','<?php echo $row['password'];?>',);">
                        <td><?php echo $row['admin_id'];?></td>
                        <td><?php echo $row['HEI_Name'];?></td>
                        <td onclick=""><?php echo $row['first_name']." ".$row['last_name'];?></td>
                        <td><?php echo $row['birthday'];?></td>
                        <td style=" text-align: center;">TO_BE_IMPLEMENTED</td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $admin_status;?></td>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;">Options</a>
                                    <a onclick="display_admin_details('<?php echo $row['admin_id'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['first_name'];?>','<?php echo $row['middle_name'];?>','<?php echo $row['last_name'];?>','(FIELD_TEST)','<?php echo $row['email'];?>','<?php echo $row['birthday'];?>','<?php echo $admin_status;?>','<?php echo $row['username'];?>','<?php echo $row['password'];?>',);"
                                        style="color: #287BEE;">View</a>
                                    <a
                                        onclick="openEditModal('<?php echo $row['HEI_ID'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['HEI_Type'];?>','<?php echo $row['Status'];?>','<?php echo $row['Start'];?>','<?php echo $row['End'];?>')">Edit</a>
                                    <a onclick="alert('Clicked remove record asdasd')"
                                        style="color: #EF575C;">Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <p style="display: none;padding: 0 0 0 1rem" id="table_empty_set_data_display"
                    class="table_empty_set_data_display">We coudn't find any admin with that name.</p>

            </div>
            <!-- Side Navigation -->

            <div class="query_sidenav" style="width: 280px;padding: 0px">

                <div style="margin: 48px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">
                    Search
                </div>
                <div style="margin: 1rem 1.2rem 2% 1.2rem;display: flex;">
                    <input type="text" id="search_field" class="search_field" maxlength="50" placeholder="Search..."
                        style="font-size: 1rem;padding: 0.3rem 0.2rem 0.3rem 0.5rem;width: 60%;border-radius: 1rem;border: 1px solid #A1A1A1;" />
                    <input type="button" value="Search" id="search_btn" class="search_btn"
                        onclick="filterAdminResults()"
                        style="margin: 0 0 0 5%;font-size: 1rem;padding: 0.3rem 0.2rem 0.3rem 0.2rem;width: 35%;border-radius: 1rem;background: #287BEE;border: none;color: white;" />
                </div>
                <div
                    style="margin: 1rem 1.2rem 0 1.2rem;font-size: 1rem;font-weight: normal;text-align: left;color: #434343">
                    <p id="results_output" class="results_output"><?php echo $result_count;?> results found.</p>
                </div>

                <hr style="margin: 48px 1.8rem 0 1.8rem;color: #A1A1A1;">
                </hr>

                <div class="empty_admin_preview" id="empty_admin_preview"
                    style="margin: 48px 1.2rem 0 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: block;color: #5E5E5E;">
                    Select an Admin to Preview.
                </div>

                <div class="admin_details_container" id="admin_details_container" style="display: none;">
                    <div style="margin: 32px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">
                        Admin Details
                    </div>

                    <!-- ADMIN ID DETAILS -->
                    <div
                        style="margin: 1.5rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Admin ID:
                        </div>
                        <div id="admin_id_value" class="admin_id_value" style="flex: auto;text-align: right;">
                            ADMIN_ID_VALUE
                        </div>
                    </div>

                    <!-- ADMIN HEI DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 10%;text-align: left;">
                            HEI:
                        </div>
                        <div class="admin_hei_value" id="admin_hei_value" style="flex: auto;text-align: right;">
                            HEI_Name
                        </div>
                    </div>

                    <!-- ADMIN FNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            First Name:
                        </div>
                        <div class="admin_fname" id="admin_fname" style="flex: auto;text-align: right;">
                            FIRST_NAME
                        </div>
                    </div>

                    <!-- ADMIN MNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Middle Name:
                        </div>
                        <div class="admin_mname" id="admin_mname" style="flex: auto;text-align: right;">
                            MIDDLE_NAME
                        </div>
                    </div>

                    <!-- ADMIN LNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Last Name:
                        </div>
                        <div class="admin_lname" id="admin_lname" style="flex: auto;text-align: right;">
                            LAST_NAME
                        </div>
                    </div>

                    <!-- ADMIN DATE OF BIRTH DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 20%;text-align: left;">
                            DOB:
                        </div>
                        <div class="admin_DOB" id="admin_DOB" style="flex: auto;text-align: right;">
                            DATE_OF_BIRTH
                        </div>
                    </div>

                    <!-- ADMIN CONTACT DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Phone:
                        </div>
                        <div class="admin_contact" id="admin_contact"
                            style="flex: auto;text-align: right;color: #287BEE;">
                            CONTACT_NUMBER
                        </div>
                    </div>

                    <!-- ADMIN EMAIL DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 20%;text-align: left;">
                            Email:
                        </div>
                        <div class="admin_email" id="admin_email" style="flex: auto;text-align: right;">
                            EMAIL_ADDRESS
                        </div>
                    </div>

                    <!-- ADMIN USERNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Username:
                        </div>
                        <div class="admin_username" id="admin_username" style="flex: auto;text-align: right;">
                            ADMIN_USERNAME
                        </div>
                    </div>

                    <!-- ADMIN PASSWORD DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Password:
                        </div>
                        <div class="admin_password" id="admin_password" style="flex: auto;text-align: right;">
                            ADMIN_PASSWORD
                        </div>
                    </div>

                    <!-- ADMIN STATUS DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;">
                            Status:
                        </div>
                        <div class="admin_status" id="admin_status" style="flex: auto;text-align: right;">
                            ACCOUNT_STATUS
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- END of Main Content Container -->


        <!----------------- SIDE PANEL -- ADD ADMIN PROFILE ------------------------------------------------>
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

            <div id="sidebar_modal_add"
                style="height: auto;background: white;z-index: 1;width: 280px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;text-align: center;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">Add Admin Account</p>
                </div>

                <div style="height: 100%;margin: 0 15px 15px 15px;text-align: center;overflow: hidden;">

                    <!-- FORM  -->
                    <form method="POST"
                        style="height: 100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">

                        <div style="height:100%;overflow-y:scroll;background:orange">
                            <div style="display: flex;flex-wrap: wrap;width:100%;">

                                <div style="width: 50%;">Admin ID No.</div>

                                <?php 
                             $query_get_last_admin_id = "select auto_increment from information_schema.tables where table_name = 'admin' and table_schema = DATABASE();";
                             $query_run = mysqli_query($connection, $query_get_last_admin_id);
                             $return_request_from_get_last_admin_id = mysqli_num_rows($query_run) > 0;
     
                             $last_admin_id_value = 0;

                             while($row = mysqli_fetch_array($query_run)){
                                $last_admin_id_value = (int)$row['auto_increment'];
                            }
                            ?>

                                <input type="text" class="add_admin_id" id="add_admin_id" minlength="3" maxlength="50"
                                    name="add_admin_id" value="<?php echo $last_admin_id_value;?>" value="DEFAULT_ID"
                                    style="pointer-events: none;cursor: default;border: none;width: 50%;font-size: 1.2rem;font-weight: normal;text-align: right;" />
                            </div>

                            <br>
                            <div style="">HEI</div>
                            <select id="hei_type_selector" onchange="display_selection()"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">

                                <?php
                            
                            $query_get_hei = "select * from hei";
                            $query_run = mysqli_query($connection, $query_get_hei);
                            $return_request_from_get_hei = mysqli_num_rows($query_run);

                            while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <option value="<?php echo $row['HEI_ID'];?>"><?php echo $row['HEI_Name'];?></option>
                                <?php
                            }
                            ?>
                            </select>

                            <input type="text" class="hei_type" id="hei_type" minlength="3" maxlength="50"
                                name="hei_type" placeholder="e.g. squidew university" value="private"
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
                            <div style="">First Name</div>
                            <input type="text" class="add_admin_fname" id="add_admin_fname" minlength="3" maxlength="50"
                                name="add_admin_fname" placeholder="e.g. squidew university" value="DEFAULT_NAME"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                                required />

                            <br>
                            <br>
                            <div style="">Middle Name</div>
                            <input type="text" class="add_admin_mname" id="add_admin_mname" minlength="3" maxlength="50"
                                name="add_admin_mname" placeholder="e.g. squidew university" value="DEFAULT_NAME"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                                required />

                            <br>
                            <br>
                            <div style="">Last Name</div>
                            <input type="text" class="add_admin_lname" id="add_admin_lname" minlength="3" maxlength="50"
                                name="add_admin_lname" placeholder="e.g. squidew university" value="DEFAULT_NAME"
                                style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                                required />

                            <br>
                            <br>
                            <div style="">Admin First Name</div>
                            <input type="text" class="add_admin_fname" id="add_admin_fname" minlength="3" maxlength="50"
                                name="add_admin_fname" placeholder="e.g. squidew university" value="DEFAULT_NAME"
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

                        </div>

                    </form>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <!----------------- END OF SIDE PANEL -- EDIT HEI PROFILE ------->




</body>
<script>
$(document).ready(function() {
    //Add HEI Profile Form Button
    $("#search_btn").click(function() {
        //Add trapping
        $.ajax({
            url: 'Functions/PHP/add_hei_form.php',
            type: 'post',
            data: {
                search_query: $(".search_field").val(),
            },
            success: function(result) {
                // $(".body_container").load(window.location.href + " .body_container");
                $(".main_data_container").load(window.location.href +
                    ".main_data_container");
            }
        });
    });
});
</script>
<script>
function display_admin_details(admin_id, hei_name, first_name, middle_name, last_name, contact, email, birthday,
    account_status, username, password) {
    document.getElementById("admin_details_container").style.display = "block";
    document.getElementById("empty_admin_preview").style.display = "none";

    //Display Data to Side Panel
    document.getElementById("admin_id_value").innerHTML = admin_id;
    document.getElementById("admin_hei_value").innerHTML = hei_name;
    document.getElementById("admin_fname").innerHTML = first_name;
    document.getElementById("admin_mname").innerHTML = middle_name;
    document.getElementById("admin_lname").innerHTML = last_name;
    document.getElementById("admin_DOB").innerHTML = birthday;
    document.getElementById("admin_contact").innerHTML = contact;
    document.getElementById("admin_email").innerHTML = email;
    document.getElementById("admin_username").innerHTML = username;
    document.getElementById("admin_password").innerHTML = "********"; //password;
    document.getElementById("admin_status").innerHTML = account_status;
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

function filterAdminResults() {
    //Hide Empty Set Label
    document.getElementById("table_empty_set_data_display").style.display = "none";

    var input, filter, table, tr, td, i, txtValue, results_count;

    results_count = 0;
    input = document.getElementById("search_field");
    filter = input.value.toUpperCase();
    table = document.getElementById("admin_table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
        }
    }


}
</script>

</html>