<?php
//Default_Style_Links 
require 'Router/Style_Links/links.php';
require 'Components/Cashier/header.php';
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
    <link rel="stylesheet" href="Styles/Cashier_side/refund_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW refund Request</title>


</head> 

<body>
    <div class="body_container" style="display: flex;margin: 0 5% 0 0;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Cashier/fixed_side_navigation_bar.php';
             ?>

        </div>

        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap;">
        
            <div style="background:white;flex: 100%;margin: 5% 2% 5% 2%;height: 100%; flex-wrap: wrap;">
            <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>Refund Requests</b>
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;">
              
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;">Latest Students Refund Requests</p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;font-weight: bold;"></p>
                    <div style="background:white;flex: 15%;color: black;overflow: hidden;margin:auto;text-align: left;">
                    </div>
                    
                </div>    
                </div>          

                <!-- cash in tables -->

                <table style="width:100%">
                    <?php 
                
                $query = "select * from refund_request";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                ?>
                    <tr style="background-color: #0E203F; color: white;text-align: center;">
                        <th>Date & Time</th>
                        <th>Transaction No.</th>
                        <th>Student ID No.</th>
                        <th>Student Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                    <tr>
                        <td onclick="">
                            <?php echo $row['transaction_date'];?></td>
                        <td><?php echo $row['transaction_id'];?></td>
                        <td><?php echo $row['sender_id'];?></td>
                        <td><?php echo $row['first_name'] .' '.$row['last_name'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['transaction_amount'];?></td>
                        <td><?php echo $row['transaction_status'];?></td>
                        <td> 
                    
                        
                            <div class="dropdown" style="margin: auto;">
                                <button class="dropdown"
                                    style="margin: auto;background: white;width: 25px;height: 15px;border-radius: 25px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
                                    ...
                                </button>

                                <div class="dropdown-content">
                                    <a style="color: grey;font-size: 0.8rem;">Options</a>
                                    <a onclick=""
                                        style="">Edit</a>
                                    <a id="remove_btn" onclick=""
                                        style="color: #EF575C;">Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </table>

               
                </table>

            </div>

        </div>
        <!-- END of Main Content Container -->
        <!-- Side Navigation -->

        <div class="query_sidenav" style="width: 280px;padding: 0px">

<div style="margin: 48px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">
    
</div>



</div>

</div>
<!-- END of Main Content Container -->