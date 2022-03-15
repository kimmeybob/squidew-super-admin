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

    <title>SQUIDEW Admin Accounts Page</title>


</head>

<body style="background: white">

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
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">Admin
                        Accounts</p>
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
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>HEI</th>

                        <!-- <th>DOB</th> -->
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
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
                        <td><?php echo $admin_status;?></td>
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
                $(".main_data_container").load(".main_data_container");
            }
        });
    });
});
</script>
<script>
var Firebase_Admin_image_link =
    "https://firebasestorage.googleapis.com/v0/b/squidew-8401a.appspot.com/o/admin%2Fdefault.png?alt=media&token=d007e5ca-6d03-4411-bd1b-6926940bffa8";

var Edit_Firebase_Admin_image_link = "";

function openModal() {
    sidebar_modal_container_add.style.display = "flex";
}

function closeModal() {
    sidebar_modal_container_add.style.display = "none";
}

function openEditModal() {
    sidebar_modal_container_edit.style.display = "flex";
}

function closeEditModal() {
    sidebar_modal_container_edit.style.display = "none";
}


function display_admin_details(admin_id, hei_name, first_name, middle_name, last_name, contact, email, birthday,
    account_status, username, password, suffix, address, gender, profile_image) {
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
    document.getElementById("admin_suffix").innerHTML = suffix;
    document.getElementById("admin_gender").innerHTML = gender;
    document.getElementById("admin_address").innerHTML = address;
    document.getElementById("admin_status").innerHTML = account_status;
    document.getElementById("admin_display_view").src = profile_image;

    document.getElementById("admin_username").innerHTML = username;
    document.getElementById("admin_password").innerHTML = "********"; //password;
}

var hei_edit_options = document.getElementById('edit_hei_type_selector').options;
var admin_gender_edit_options = document.getElementById('edit_gender_selector').options;

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
            // console.log("Edit-Gender Selector Option: " + admin_gender_edit_options[k].value);
            // console.log("Edit-Gender Input Value: " + admin_gender_edit_options[k].value);
            break;
        }
    }

    document.getElementById("edit_email").value = email;
    document.getElementById("edit_birthdate").value = birthday;
    document.getElementById("edit_contact_number").value = contact;
    document.getElementById("edit_admin_location").value = address;
    document.getElementById("admin_status").value = account_status;


    //document.getElementById("admin_username").innerHTML = username;
    //document.getElementById("admin_password").innerHTML = "********"; //password;
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
            // $(".hei_details_container").load(" .hei_details_container");
            // $(".main_data_container").load(" .main_data_container");
            // createForm.reset();
        },
        error: function(data) {
            alert("error occured" + data); //===Show Error Message====

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

function filterAdminResults() {
    //Hide Empty Set Label
    document.getElementById("table_empty_set_data_display").style.display = "none";

    var input, filter, table, tr, td, i, txtValue, results_count;
    var admin_id_cb, name_cb, hei_cb, phone_cb, status_cb, email_cb, filter_tab;

    results_count = 0;
    input = document.getElementById("search_field");
    filter = input.value.toUpperCase();
    table = document.getElementById("admin_table");
    tr = table.getElementsByTagName("tr");

    admin_id_cb = document.getElementById("admin_id_checkbox");
    name_cb = document.getElementById("name_checkbox");
    hei_cb = document.getElementById("hei_checkbox");
    phone_cb = document.getElementById("phone_checkbox");
    status_cb = document.getElementById("status_checkbox");
    email_cb = document.getElementById("email_checkbox");

    if (admin_id_cb.checked) {
        filter_tab = "0";
    } else if (name_cb.checked) {
        filter_tab = "1";
    } else if (hei_cb.checked) {
        filter_tab = "2";
    } else if (phone_cb.checked) {
        filter_tab = "3";
    } else if (status_cb.checked) {
        filter_tab = "5";
    } else if (email_cb.checked) {
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
const edit_btn = document.querySelector('#edit_new_profile_btn');

btn.addEventListener('click', function(e) {
    console.log("Form: Create new Admin Form");
    e.preventDefault();

    const storage = firebase.storage();
    const storageRef = storage.ref('admin/');

    if (document.getElementById("image").files.length == 0) {
        //Admin will use the profile default image.
        submitAdminRecord();
    } else {
        //Admin has a Profile Picture
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
                Firebase_Admin_image_link = url;
                submitAdminRecord();
            })
    }

})

edit_btn.addEventListener('click', function(e) {

    e.preventDefault();

    const storage = firebase.storage();
    const storageRef = storage.ref('admin/');

    //Delete image on Firebase
    if (document.getElementById("edit_image").files.length === 0) {
        console.log("Current Image will not be deleted.");
    } else {
        console.log("Current Image will not be deleted.");
        const desertRef = storage.refFromURL(Edit_Firebase_Admin_image_link);
        // Delete the file
        desertRef.delete().then(() => {
            // File deleted successfully
            console.log("Old Image Deleted.");
        }).catch((error) => {
            // Uh-oh, an error occurred!
            console.log(error);
        });
    }


    // Upload New Image on Firebase
    if (document.getElementById("edit_image").files.length === 0) {
        console.log("No new images selected.");
        Firebase_Admin_image_link = Edit_Firebase_Admin_image_link;
        submitAdminUpdateRecord();
    } else {
        //Upload Function
        var file = document.querySelector('#edit_image').files[0];
        var name = new Date() + '-' + file.name;

        var metadata = {
            contentType: file.type
        }

        var uploadTask = storageRef.child(name).put(file, metadata);

        uploadTask.then(snapshot => snapshot.ref.getDownloadURL())
            .then(url => {
                console.log(url);
                document.getElementById("top_bar_loader").style.display = "block";
                document.querySelector('#display_edit').src = url;
                document.querySelector('#edit_image').value = "";
                Firebase_Admin_image_link = url;
                submitAdminUpdateRecord();
            })
    }

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

document.getElementById("edit_image").onchange = function(evt) {

    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function() {
            document.getElementById("display_edit").src = fr.result;
            document.getElementById("display_edit").style.objectFit = "cover";
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