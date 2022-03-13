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
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">Reports and Feedbacks</p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    <div
                        style="background:white;flex: 20%;color: black;overflow: hidden;margin:auto;text-align: right;">
                        <button
                            style="flex: auto;font-size:1rem;background: #3A72E8;border: none;padding: 3% 10% 3% 10%;border-radius: 50px;color: white;"
                            onclick="openModal();">
                            Add Admin
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <table id="admin_table" class="admin_table" style="width:100%;">
                    <?php
                
                $query = "select admin.admin_id as admin_admin_id, admin.first_name as admin_first_name, admin.middle_name as admin_middle_name, admin.last_name as admin_last_name, admin.email as admin_email, admin.contact_number as admin_contact_number, admin.birthdate as admin_birthdate, admin.username as admin_username, admin.password as admin_password, admin.account_status as admin_account_status, admin.hei_id as admin_hei_id, admin.suffix as admin_suffix, admin.sex as admin_sex, admin.home_address as admin_home_address, admin.profile_image as admin_profile_image, hei.hei_name as hei_name from admin inner join hei on admin.hei_id = hei.hei_id;";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;

                //Number of results
                $result_count = mysqli_num_rows($run_query);
                
                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;font-size: 0.9rem">
                        <th>Report ID</th>
                        <th>Date & Time</th>
                        <th>Reporter's Email</th>

                        <!-- <th>DOB</th> -->
                        <th>Status</th>
                
                        <th>Assignee</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        $admin_status = "Active";
                        if($row['admin_account_status'] == 0){
                            $admin_status = "Offline";
                        }else if($row['admin_account_status'] == 1){
                            $admin_status = "Active";
                        }else{
                            $admin_status = "On Leave";
                        }
                        ?>
                    <tr class="admin_data_row" id="admin_data_row" style="font-size: 0.9rem;"
                        onclick="display_admin_details('<?php echo $row['admin_admin_id'];?>','<?php echo $row['hei_name'];?>','<?php echo $row['admin_first_name'];?>','<?php echo $row['admin_middle_name'];?>','<?php echo $row['admin_last_name'];?>','<?php echo $row['admin_contact_number'];?>','<?php echo $row['admin_email'];?>','<?php echo $row['admin_birthdate'];?>','<?php echo $admin_status;?>','<?php echo $row['admin_username'];?>','<?php echo $row['admin_password'];?>','<?php echo $row['admin_suffix'];?>','<?php echo $row['admin_home_address'];?>','<?php echo $row['admin_sex'];?>','<?php echo $row['admin_profile_image']?>');">
                        <td><?php echo $row['admin_admin_id'];?></td>
                        <td onclick=""><?php echo $row['admin_first_name']." ".$row['admin_last_name'];?></td>
                        <td><?php echo $row['hei_name'];?></td>
                        <!-- <td><?php //echo $row['admin_birthdate'];?></td> -->
                        <td style=" text-align: center;"><?php echo $row['admin_contact_number']?></td>
                        <td><?php echo $row['admin_email']?></td>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;pointer-events: none;">Options</a>
                                    <a onclick="display_admin_details('<?php echo $row['admin_admin_id'];?>','<?php echo $row['hei_name'];?>','<?php echo $row['admin_first_name'];?>','<?php echo $row['admin_middle_name'];?>','<?php echo $row['admin_last_name'];?>','<?php echo $row['admin_contact_number']?>','<?php echo $row['admin_email'];?>','<?php echo $row['admin_birthdate'];?>','<?php echo $admin_status;?>','<?php echo $row['admin_username'];?>','<?php echo $row['admin_password'];?>','<?php echo $row['admin_suffix']?>','<?php echo $row['admin_home_address']?>','<?php echo $row['admin_sex']?>','<?php echo $row['admin_profile_image']?>');"
                                        style="color: #287BEE;cursor: default;">View</a>
                                    <a onclick="edit_admin_details('<?php echo $row['admin_admin_id'];?>','<?php echo $row['hei_name'];?>','<?php echo $row['admin_first_name'];?>','<?php echo $row['admin_middle_name'];?>','<?php echo $row['admin_last_name'];?>','<?php echo $row['admin_contact_number']?>','<?php echo $row['admin_email'];?>','<?php echo $row['admin_birthdate'];?>','<?php echo $admin_status;?>','<?php echo $row['admin_username'];?>','<?php echo $row['admin_password'];?>','<?php echo $row['admin_suffix']?>','<?php echo $row['admin_home_address']?>','<?php echo $row['admin_sex']?>','<?php echo $row['admin_profile_image']?>')"
                                        ; style="cursor: default;">Edit</a>
                                    <a onclick="setDeleteIDValue(<?php echo $row['admin_admin_id'];?>)"
                                        style="color: #EF575C;cursor: default;">Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <p style="display: none;padding: 0 0 0 1rem" id="table_empty_set_data_display"
                    class="table_empty_set_data_display">We coudn't find any results for your query.</p>

            </div>
            <!-- Side Navigation -->

            <div class="query_sidenav" style="width: 280px;padding: 0px;height: calc(100% - 5rem);">

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
                <hr style="margin: 1 1.8rem 1 1.8rem;color: #A1A1A1;">
                </hr>
                <div style="margin: 1rem 1.2rem 0.5rem 1.2rem;font-size: 1.1rem;font-weight: bold;text-align: left;">
                    Search By
                </div>
                <div style="margin: 1.5rem 1.2rem 1rem 1.2rem;font-size: 1rem;font-weight: normal;text-align: left;">
                    <fieldset id="search_filter_group" style="border: none;padding:0;">
                        <input type="radio" id="admin_id_checkbox" name="search_filter_group" />Admin ID
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                            type="radio" id="name_checkbox" name="search_filter_group" checked="true" />Name<br>
                        <input type="radio" id="hei_checkbox" name="search_filter_group" />HEI
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                            type="radio" id="phone_checkbox" name="search_filter_group" />Phone<br>
                        <input type="radio" id="status_checkbox" name="search_filter_group" />Status
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                            type="radio" id="email_checkbox" name="search_filter_group" />Email<br>
                    </fieldset>
                </div>

                <hr style="margin: 1rem 1.8rem 0 1.8rem;color: #A1A1A1;">
                </hr>

                <div class="empty_admin_preview" id="empty_admin_preview"
                    style="margin: 48px 1.2rem 0 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: block;color: #5E5E5E;">
                    Select an Admin to Preview.
                </div>

                <div class="admin_details_container" id="admin_details_container"
                    style="display: none;overflow: scroll;height: calc(100% - 20rem);">
                    <br>
                    <br>
                    <!-- ADMIN ID IMAGE -->
                    <div style="display: flex;flex-wrap: wrap;width:100%;">
                        <img id="admin_display_view" src="Assets/Images/hei_default_icon.png"
                            style="box-shadow: 0px 0.873377px 3.49351px rgba(175, 175, 175, 0.25);object-fit: fit;border: none;height: 7rem;width: 7rem;background: white;border: 2px solid #C0C0C0;border-radius: 10rem;margin:auto;" />
                    </div>


                    <div style="margin: 32px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: center;">
                        Admin Details
                    </div>
                    <br>

                    <!-- ADMIN HEI DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 10%;text-align: left;font-weight: bold;">
                            HEI:
                        </div>
                        <div class="admin_hei_value" id="admin_hei_value" style="flex: auto;text-align: right;">
                            HEI_Name
                        </div>
                    </div>

                    <!-- ADMIN ID DETAILS -->
                    <div
                        style="margin: 1.5rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Admin ID:
                        </div>
                        <div id="admin_id_value" class="admin_id_value" style="flex: auto;text-align: right;">
                            ADMIN_ID_VALUE
                        </div>
                    </div>


                    <!-- ADMIN FNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            First Name:
                        </div>
                        <div class="admin_fname" id="admin_fname" style="flex: auto;text-align: right;">
                            FIRST_NAME
                        </div>
                    </div>

                    <!-- ADMIN MNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Middle Name:
                        </div>
                        <div class="admin_mname" id="admin_mname" style="flex: auto;text-align: right;">
                            MIDDLE_NAME
                        </div>
                    </div>

                    <!-- ADMIN LNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Last Name:
                        </div>
                        <div class="admin_lname" id="admin_lname" style="flex: auto;text-align: right;">
                            LAST_NAME
                        </div>
                    </div>

                    <!-- ADMIN SUFFIX DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Suffix:
                        </div>
                        <div class="admin_suffix" id="admin_suffix" style="flex: auto;text-align: right;">

                        </div>
                    </div>


                    <!-- ADMIN GENDER DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Gender:
                        </div>
                        <div class="admin_gender" id="admin_gender" style="flex: auto;text-align: right;">
                            M
                        </div>
                    </div>

                    <!-- ADMIN DATE OF BIRTH DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 20%;text-align: left;font-weight: bold;">
                            DOB:
                        </div>
                        <div class="admin_DOB" id="admin_DOB" style="flex: auto;text-align: right;">
                            DATE_OF_BIRTH
                        </div>
                    </div>

                    <!-- ADMIN CONTACT DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Phone:
                        </div>
                        <div class="admin_contact" id="admin_contact" style="flex: auto;text-align: right;">
                            CONTACT_NUMBER
                        </div>
                    </div>



                    <!-- ADMIN EMAIL DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 20%;text-align: left;font-weight: bold;">
                            Email:
                        </div>
                        <div class="admin_email" id="admin_email" style="flex: auto;text-align: right;">
                            EMAIL_ADDRESS
                        </div>
                    </div>

                    <!-- ADMIN USERNAME DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: none;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Username:
                        </div>
                        <div class="admin_username" id="admin_username" style="flex: auto;text-align: right;">
                            ADMIN_USERNAME
                        </div>
                    </div>

                    <!-- ADMIN PASSWORD DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: none;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Password:
                        </div>
                        <div class="admin_password" id="admin_password" style="flex: auto;text-align: right;">
                            ADMIN_PASSWORD
                        </div>
                    </div>

                    <!-- ADMIN STATUS DETAILS -->
                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
                        <div style="flex: 40%;text-align: left;font-weight: bold;">
                            Status:
                        </div>
                        <div class="admin_status" id="admin_status" style="flex: auto;text-align: right;">
                            ACCOUNT_STATUS
                        </div>
                    </div>

                    <!-- ADMIN HOME ADDRESS DETAILS -->
                    <hr style="margin: 0 1.8rem 0 1.8rem;color: #A1A1A1;display: none;">
                    </hr>

                    <div
                        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: block;">
                        <div style="text-align: left;font-weight: bold;">
                            Home Address:
                        </div>
                        <br>
                        <div class="admin_address" id="admin_address" style="text-align: left;">
                            18M DELA CONCEPTION ST. PASIL CEBU CITY
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END of Main Content Container -->


        <!----------------- SIDE PANEL -- ADD ADMIN PROFILE ------------------------------------------------>
        <div id="sidebar_modal_container_add"
            style="z-index: 1;width: 100%;height: calc(100% - 5rem);right:0;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: none; flex-wrap: wrap;position: absolute;">
            <div id="outer_modal" style="background: #ADADAD;opacity: 0.45;flex:auto;height: 100%;"
                onclick="closeModal();">

            </div>
            <div style="right: 280px;margin:0;width: auto;position: fixed;z-index: 2;" onclick="closeModal();">
                <div style="background: #4475E6;padding: 0.6rem 0.9rem;">
                    <i class="fa-solid fa-xmark" style="color: white;font-size: 1.2rem;"></i>
                </div>
                <div style="background: #ADADAD;opacity: 0.45;"></div>
            </div>

            <div id="sidebar_modal_add"
                style="height: 100%;background: white;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div
                    style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;text-align: center;overflow: hidden;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">Add Admin Account</p>
                </div>

                <div
                    style="flex: auto;height: calc(100% - 5rem);margin: 2rem 15px 15px 15px;text-align: center;overflow: scroll">

                    <!-- FORM  -->
                    <form method="POST" id="createForm"
                        style="display: block;height: 100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">

                        <div style="display: flex;flex-wrap: wrap;width:100%;background: white;">
                            <img id="display" src="Assets/Images/admin_default_icon.png"
                                style="box-shadow: 0px 0.873377px 3.49351px rgba(175, 175, 175, 0.25);object-fit: fit;border: none;height: 10rem;width: 10rem;background: white;border: 2px solid #C0C0C0;border-radius: 10rem;margin:auto;" />

                            <label for="image" class="custom-file-upload"
                                style="color: #287BEE;border-radius: 1rem;border: 1px solid #A1A1A1;display: inline-block;padding: 6px 12px;cursor: pointer;margin: auto;margin-top: 1rem;font-weight: bold;">
                                Upload an Image
                            </label>
                            <input type="file" id="image" style="  display: none;" />

                        </div>
                        </br></br>

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
                            <option value="default" style="color:  #A1A1A1;">Select an HEI</option>
                            <?php
                            
                            $query_get_hei = "select * from hei";
                            $query_run = mysqli_query($connection, $query_get_hei);
                            $return_request_from_get_hei = mysqli_num_rows($query_run);

                            while($row = mysqli_fetch_array($query_run)){
                                ?>
                            <option value="<?php echo $row['hei_id'];?>"><?php echo $row['hei_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <input type="text" class="associated_hei" id="associated_hei" minlength="3" maxlength="50"
                            name="associated_hei" placeholder="e.g. squidew university" value=""
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function display_selection() {
                            var select = document.getElementById('hei_type_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("associated_hei").value = selected_option_text;
                            console.log(selected_option_text);
                        }
                        </script>

                        <br>
                        <br>
                        <div style="">First Name</div>
                        <input type="text" class="add_admin_fname" id="add_admin_fname" minlength="3" maxlength="50"
                            name="add_admin_fname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">Middle Name</div>
                        <input type="text" class="add_admin_mname" id="add_admin_mname" minlength="3" maxlength="50"
                            name="add_admin_mname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">Last Name</div>
                        <input type="text" class="add_admin_lname" id="add_admin_lname" minlength="3" maxlength="50"
                            name="add_admin_lname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Suffix</div>
                        <input type="text" class="add_suffix" id="add_suffix" minlength="3" maxlength="50"
                            name="add_suffix" placeholder="e.g. I, II, II, JR. SR."
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Gender</div>
                        <select id="add_gender_selector" onchange="add_gender_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>

                        <input type="text" class="add_gender" id="add_gender" minlength="3" maxlength="50"
                            name="add_gender" value="m"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function add_gender_selection() {
                            var select = document.getElementById('add_gender_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("add_gender").value = selected_option_text;
                            console.log(selected_option_text);
                            // alert(document.getElementById("hei_type").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">Email</div>
                        <input type="text" class="add_email" id="add_email" minlength="3" maxlength="50"
                            name="add_email" placeholder="e.g. carlkim@squidew.com"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Date Of Birth</div>
                        <input type="date" class="add_birthdate" id="add_birthdate" minlength="3" maxlength="50"
                            name="add_birthdate" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <div style="">Contact Number</div>
                        <input type="text" class="add_contact_number" id="add_contact_number" minlength="3"
                            maxlength="50" name="add_contact_number" placeholder="e.g. XXXXXXXXXXX"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Home Address<span style="color: #267CCA"></span></div>
                        <input type="text" class="add_admin_location" minlength="3" maxlength="50"
                            name="add_admin_location" id="add_admin_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />
                        <br>
                        <br>

                        <input type="button" value="Submit" id="add_new_profile_btn"
                            style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 0 15%;" />
                        </br>
                        </br>
                        </br>
                        </br>
                    </form>
                </div>
            </div>
        </div>
        <!----------------- END OF ADD ADMIN PROFILE ------->



        <!----------------- SIDE PANEL -- EDIT ADMIN PROFILE ------------------------------------------------>
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
                style="height: 100%;background: white;z-index: 2;width: 280px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">

                <div
                    style="flex: auto;height: 5%;margin: 1rem 15px 0 15px;text-align: center;overflow: hidden;line-height: 1;">
                    <p style="font-size: 1.3rem;font-weight: bold">Edit Admin Account</p>
                </div>

                <div
                    style="flex: auto;height: calc(100% - 5rem);margin: 2rem 15px 15px 15px;text-align: center;overflow: scroll">

                    <!-- FORM  -->
                    <form method="POST" id="createForm"
                        style="display: block;height: 100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">

                        <div style="display: flex;flex-wrap: wrap;width:100%;background: white;">
                            <img id="display_edit" src="Assets/Images/hei_default_icon.png"
                                style="box-shadow: 0px 0.873377px 3.49351px rgba(175, 175, 175, 0.25);object-fit: fit;border: none;height: 10rem;width: 10rem;background: white;border: 2px solid #C0C0C0;border-radius: 10rem;margin:auto;" />

                            <label for="edit_image" class="custom-file-upload"
                                style="color: #287BEE;border-radius: 1rem;border: 1px solid #A1A1A1;display: inline-block;padding: 6px 12px;cursor: pointer;margin: auto;margin-top: 1rem;font-weight: bold;">
                                Upload an Image
                            </label>
                            <input type="file" id="edit_image" style="  display: none;" />

                        </div>
                        </br></br>

                        <div style="display: flex;flex-wrap: wrap;width:100%;">

                            <div style="width: 50%;">Admin ID No.</div>
                            <input type="text" class="edit_admin_id" id="edit_admin_id" minlength="3" maxlength="50"
                                name="edit_admin_id" value="<?php echo $last_admin_id_value;?>" value="DEFAULT_ID"
                                style="pointer-events: none;cursor: default;border: none;width: 50%;font-size: 1.2rem;font-weight: normal;text-align: right;" />
                        </div>

                        <br>
                        <div style="">HEI</div>
                        <select id="edit_hei_type_selector" onchange="edit_display_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <?php
                            $query_get_hei = "select * from hei";
                            $query_run = mysqli_query($connection, $query_get_hei);
                            $return_request_from_get_hei = mysqli_num_rows($query_run);

                            while($row = mysqli_fetch_array($query_run)){
                                ?>
                            <option value="<?php echo $row['hei_id'];?>"><?php echo $row['hei_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <input type="text" class="edit_associated_hei" id="edit_associated_hei" minlength="3"
                            maxlength="50" name="edit_associated_hei" placeholder="e.g. squidew university" value=""
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function edit_display_selection() {
                            var select = document.getElementById('edit_hei_type_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("edit_associated_hei").value = selected_option_text;
                            console.log(selected_option_text);
                        }
                        </script>

                        <br>
                        <br>
                        <div style="">First Name</div>
                        <input type="text" class="edit_admin_fname" id="edit_admin_fname" minlength="3" maxlength="50"
                            name="edit_admin_fname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">Middle Name</div>
                        <input type="text" class="edit_admin_mname" id="edit_admin_mname" minlength="3" maxlength="50"
                            name="edit_admin_mname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />

                        <br>
                        <br>
                        <div style="">Last Name</div>
                        <input type="text" class="edit_admin_lname" id="edit_admin_lname" minlength="3" maxlength="50"
                            name="edit_admin_lname" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Suffix</div>
                        <input type="text" class="edit_suffix" id="edit_suffix" minlength="3" maxlength="50"
                            name="edit_suffix" placeholder="e.g. I, II, II, JR. SR."
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Gender</div>
                        <select id="edit_gender_selector" onchange="add_gender_selection()"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 5px">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>

                        <input type="text" class="edit_gender" id="edit_gender" minlength="3" maxlength="50"
                            name="edit_gender" value="m"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.2rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: none;" />
                        <script>
                        function add_gender_selection() {
                            var select = document.getElementById('edit_gender_selector');
                            var selected_option_text = select.options[select.selectedIndex].value;
                            document.getElementById("edit_gender").value = selected_option_text;
                            console.log(selected_option_text);
                            // alert(document.getElementById("hei_type").value);
                        }
                        </script>
                        <br>
                        <br>
                        <div style="">Email</div>
                        <input type="text" class="edit_email" id="edit_email" minlength="3" maxlength="50"
                            name="edit_email" placeholder="e.g. carlkim@squidew.com"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Date Of Birth</div>
                        <input type="date" class="edit_birthdate" id="edit_birthdate" minlength="3" maxlength="50"
                            name="edit_birthdate" placeholder="e.g. squidew university"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 0.9rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px;display: flex;" />
                        <br>
                        <div style="">Contact Number</div>
                        <input type="text" class="edit_contact_number" id="edit_contact_number" minlength="3"
                            maxlength="50" name="edit_contact_number" placeholder="e.g. XXXXXXXXXXX"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br>
                        <br>
                        <div style="">Home Address<span style="color: #267CCA"></span></div>
                        <input type="text" class="edit_admin_location" minlength="3" maxlength="50"
                            name="edit_admin_location" id="edit_admin_location"
                            placeholder="e.g. 18M Dela Conception St. Pasil Cebu City"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px; text-overflow: ellipsis;" />
                        <br>
                        <br>
                        <hr style="margin: 1rem 0 1rem 0;color: #A1A1A1;">
                        </hr>
                        <br>
                        <div style="font-size: 1.2rem;text-align: center;">Override User Access</div>
                        <br>
                        <br>
                        <div style="">Username</div>
                        <input type="text" class="edit_username" id="edit_username" minlength="6" maxlength="50"
                            name="edit_username" placeholder="username" autocomplete="off" value=""
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px" />
                        <br> <br>
                        <div style="">Password</div>
                        <input type="password" class="edit_password" id="edit_password" minlength="6" maxlength="50"
                            name="edit_password" placeholder="password" autocomplete="new-password" value=""
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px" />
                        <br>
                        <br>
                        </br>
                        </br>
                        <input type="button" value="Submit" id="edit_new_profile_btn"
                            style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;margin: 0 15% 0 15%;" />
                        </br>
                        </br>
                        </br>
                        </br>
                    </form>
                </div>
            </div>
        </div>
        <!----------------- END OF EDIT SIDE PANEL ------->




</body>

</html>