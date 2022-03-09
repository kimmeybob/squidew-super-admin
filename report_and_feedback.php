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

    <div class="body_container" style="display: flex;margin: 0 5% 0 0;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Super_Admin/fixed_side_navigation_bar.php';
             ?>

        </div>

        <!-- HEI/Reports and Feedback/Admin Count -->

        <div class="main_data_container"
            style="flex: 76%;background: white;display: flex;flex-wrap: wrap;margin: 0 0 0 5%">
            <div style="background: white;flex: 100%;margin: 5% 2% 5% 2%;height: 100%;">
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;">Reports &
                        Feedback<b style="color: #287BEE"> [ PAGE_DEVELOPMENT_ON_HOLD ]<b></p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    <div
                        style="background:white;flex: 20%;color: black;overflow: hidden;margin:auto;text-align: right;">
                        <!-- <button
                            style="flex: auto;font-size:1rem;background: #3A72E8;border: none;padding: 3% 10% 3% 10%;border-radius: 50px;color: white;"
                            onclick="openModal();">
                            Add
                        </button> -->
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
                        <th>Report ID No.</th>
                        <th>Reporter ID</th>
                        <th>Reporter Name</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>
                    <tr>
                        <td onclick=""><?php echo $row['HEI_ID'];?></td>
                        <td onclick=""><?php echo $row['HEI_ID'];?></td>
                        <td><?php echo $row['HEI_ID'];?></td>
                        <td style="text-align: center;" lenght="2"><?php echo $row['HEI_ID'];?></td>
                        <td><?php echo $row['HEI_ID']?></td>
                        <td><?php echo $row['HEI_ID'];?></td>
                        <td onclick="">
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 25px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;pointer-events: none;">Options</a>
                                    <a style="cursor: default;"
                                        onclick="openEditModal('<?php echo $row['HEI_ID'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['HEI_Type'];?>','<?php echo $row['Status'];?>','<?php echo $row['Start'];?>','<?php echo $row['End'];?>')">View</a>
                                    <a style="cursor: default;"
                                        onclick="openEditModal('<?php echo $row['HEI_ID'];?>','<?php echo $row['HEI_Name'];?>','<?php echo $row['HEI_Type'];?>','<?php echo $row['Status'];?>','<?php echo $row['Start'];?>','<?php echo $row['End'];?>')">Edit</a>
                                    <a onclick="alert('Clicked remove record asdasd')"
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



</body>

</html>