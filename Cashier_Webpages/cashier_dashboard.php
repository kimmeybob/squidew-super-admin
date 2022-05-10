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
    <link rel="stylesheet" href="Styles/Cashier_side/dashboard_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">
    

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Dashboard</title>
<style>
    
         
th,td {
    border-bottom: 1px white;

  }
  tr:hover {
    background: #013f96;
    color: white;
    transition: 0.3s;
  }
  
  th {
    font-weight: normal;
    padding: 10px;
  }
  
  td {
    text-align: left;
  }
 
  tr:nth-child(odd) {
    background: #d3dff9;
  }
  tr{
  background:rgb(204, 204, 204);
  
}
    </style>


</head>

<body >
    <div class="body_container" style="display: flex;margin: 0 5% 0 0;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Cashier/fixed_side_navigation_bar.php';
             ?>

        </div>
        <!--Cashiers dashboard-->
        <?php
        $query = "select * from hei";
        $run_query = mysqli_query($connection,$query);
        $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
        ?>
        <div class="transaction_details_container"
            style="flex: 11%;background: white;display: flex;flex-wrap: wrap;margin: 0 0 0 2%;" >
            <div style="background: white;flex: 100%;margin: 5%;">
                <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>Cashier Dashboard</b>
                </p>
                <br>
                <div
                    style="background: #3A72E8;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #3A72E8; border-radius:25px;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php 
                            //payment
                            $query_get_transaction = "select count(transaction_id) as transaction_count from bills_transaction";
                            $query_run = mysqli_query($connection, $query_get_transaction);
                            $return_request_from_query_get_transaction = mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['transaction_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 73%;background: #0E203F;display: flex;flex-wrap: wrap; border-bottom-left-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;border-top-right-radius: 25px;">
                        <p
                            style="margin: auto;text-align: center;color: white;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Payment Received</p>
                    </div>
                </div>
                <br>
                <div
                    style="background: #3A72E8;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #3A72E8; border-radius:25px;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php 
                            //cashin display
                            $query_get_cashin_count = "select count(transaction_id) as cashin_count from transaction where transaction_type='2'";
                            $query_run = mysqli_query($connection, $query_get_cashin_count);
                            $return_request_from_query_get_cashin_count= mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['cashin_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 75%;background: #0E203F;display: flex;flex-wrap: wrap; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;border-top-right-radius: 25px;">
                        <p
                            style="margin: auto;color: white;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem; ">
                            Cash In</p>
                    </div>
                </div>
                <br>
                <div
                    style="background: #3A72E8;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #3A72E8; border-radius:25px;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php 
                            //cashin display
                            $query_get_cashin_count = "select count(transaction_id) as cashin_count from transaction where transaction_type='3'";
                            $query_run = mysqli_query($connection, $query_get_cashin_count);
                            $return_request_from_query_get_cashin_count= mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['cashin_count'];
                            }
                        ?>
                        
                    </div>
                    <div style="flex: 75%;background: #0E203F;display: flex;flex-wrap: wrap; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;border-top-right-radius: 25px;">
                        <p
                            style="margin: auto;text-align: center;color: White;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Cash Out</p>
                    </div>
                </div>
                <br/>
                <div
                    style="background: #3A72E8;flex:100%;height: 70px;display: flex;flex-wrap: wrap;border: 2px solid #3A72E8; border-radius:25px;">
                    <div
                        style="flex: 25%;color: white;font-weight: bold;text-align:center;margin:auto;font-size: 150%;">
                        <?php 
                            //payment
                            $query_get_transaction = "select count(refund_id) as refund_count from refund_request";
                            $query_run = mysqli_query($connection, $query_get_transaction);
                            $return_request_from_query_get_transaction = mysqli_num_rows($query_run) > 0;
                            
                            while($row = mysqli_fetch_array($query_run)){
                                echo $row['refund_count'];
                            }
                        ?>
                    </div>
                    <div style="flex: 75%;background: #0E203F;display: flex;flex-wrap: wrap; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;border-top-right-radius: 25px;">
                        <p
                        style="margin: auto;color: white;font-weight: bold;text-align:left;margin-left: 20px;font-size: 1rem;">
                            Request Refund</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap;">
            <div style="background:white;flex: 100%;margin: 5% 2% 5% 2%;height: 100%; flex-wrap: wrap;">
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;margin-bottom:-20px;">
                    <p style="   width: 100%;color: black;overflow: hidden;font-size: 1.2rem;">Latest Payments <b>Received Transactions</b>
                         <a href="bill_payment.php" style="text-decoration:none; text-align:center;  font-size:12px;  float:right; padding-top:5px;    width: 9%; height: 25px;  color: white;  background-color: #2c71ec;  border-radius: 15px ;">view more</a>

                </div>          

                <!-- transaction Table -->
           
                <table style="width:100%;">
                    <?php 
                
                $query = "select * from transaction
                inner join bills_transaction on bills_transaction.transaction_id = transaction.transaction_id
                inner join student on student.student_id = bills_transaction.sender_id
                inner join students_profile on students_profile.student_id = student.student_id
                inner join degree on degree.degree_id = student.degree_id limit 2";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;">
                        <th>Date & Time</th>
                        <th>Transaction No.</th>
                        <th>ID No.</th>
                        <th>Student Name</th>
                        <th>Amount</th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                    <tr>

                        <td style="font-size:14px; text-align:left; padding:10px;" onclick=""><?php echo $row['transaction_date'];?></td>
                        <td style="font-size:14px; text-align:left; padding:10px;">00000<?php echo $row['transaction_id'];?></td>
                        <td style="font-size:14px; text-align:left; padding:10px;"><?php echo $row['sender_id'];?></td>
                        <td style="width:50%; text-align:left; padding:10px;">
                            <b>
                                <?php echo $row['first_name']." ". $row['last_name'];?>
                            </b></br>
                            <div style="font-size:15px;">
                            <?php echo $row['degree_name'];?>
                            </div>
                        </td>
                        
                       
                        <td><?php echo $row['transaction_amount'];?></td>
                      
                    </tr>
                    <?php
                }
                ?>

                </table>

            </br>
            
      
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;margin-bottom:-20px;">
                    <p style="flex: 100%;color: black;overflow: hidden;font-size: 1.2rem;">Latest  <b>Cash In Transactions</b>
                    <a href="cash_in.php" style="text-decoration:none; text-align:center;  font-size:12px;  float:right; padding-top:5px;    width: 9%; height: 25px;  color: white;  background-color: #2c71ec;  border-radius: 15px ;">view more</a>
                   
                   
                </div>
                <!-- cash in transaction Table -->

                <table style="width:100%; " >
                <?php
                
                $query = "select * from transaction
                inner join cashier_transaction on cashier_transaction.transaction_id = transaction.transaction_id
                inner join student on student.student_id = cashier_transaction.receiver_id
                inner join students_profile on students_profile.student_id = student.student_id
                inner join degree on degree.degree_id = student.degree_id
                inner join linked_card on linked_card.student_id = student.student_id 
                inner join wallet on wallet.wallet_id = linked_card.wallet_id
                where transaction_type = '2' and wallet_name = 'Squidew Wallet' limit 2";             
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                ?>

                    <tr style="background: #0E203F; color: white;text-align: center;">
                        <th>Date & Time</th>
                        <th>Transaction No.</th>
                        <th>ID No.</th>
                        <th>Student Name</th>
                        <th>Balance</th>
                        <th>Amount</th>
                      
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                    <tr>        
                    <td style="font-size:14px; text-align:left; padding:10px; width:15%;" onclick=""><?php echo $row['transaction_date'];?></td>
                    <td style="font-size:14px; text-align:left; padding:10px;">00000<?php echo $row['transaction_id'];?></td>
                    <td style="font-size:14px; text-align:left; padding:10px;"><?php echo $row['receiver_id'];?></td>
                        <td style="width:50%; text-align:left; padding:10px;">
                            <b>
                                <?php echo $row['first_name']." ". $row['last_name'];?>
                            </b></br>
                            <div style="font-size:15px;">
                            <?php echo $row['degree_name'];?>
                            </div>
                        </td>
                        
                       
                       
                     <!-- need to change later-->
                        <td><?php echo $row['wallet_balance'];?></td>
                        <td><?php echo $row['transaction_amount'];?></td>
                        
                    </tr>
                    <?php
                }
                ?>

                </table>
                </br>
            
            
                
                <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap;margin-bottom:-20px;">
                <p style="flex: 100%;color: black;overflow: hidden;font-size: 1.2rem;">Latest <b>Cash Out Transactions</b>
                <a href="cash_out.php" style="text-decoration:none; text-align:center;  font-size:12px;  float:right; padding-top:5px;    width: 9%; height: 25px;  color: white;  background-color: #2c71ec;  border-radius: 15px ;">view more</a>
            
            </div>
            <!-- cash out transaction Table -->

            <table style="width:100%">
                <?php
            
            $query = $query =    "select * from transaction
            inner join cashier_transaction on cashier_transaction.transaction_id = transaction.transaction_id
            inner join student on student.student_id = cashier_transaction.receiver_id
            inner join students_profile on students_profile.student_id = student.student_id
            inner join degree on degree.degree_id = student.degree_id
            inner join linked_card on linked_card.student_id = student.student_id 
            inner join wallet on wallet.wallet_id = linked_card.wallet_id
            where transaction_type = '3' and wallet_name = 'Squidew Wallet' limit 2";             
            $run_query = mysqli_query($connection,$query);
            $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
            ?>

                <tr style="background: #0E203F; color: white;text-align: center;">
                <th>Date & Time</th>
                        <th>Transaction No.</th>
                        <th>ID No.</th>
                        <th>Student Name</th>
                        <th>Balance</th>
                        <th>Amount</th>
                        
                        
                </tr>

                <?php
                while($row = mysqli_fetch_array($run_query)){
                    ?>

                <tr>
                <td onclick="">
                <?php echo $row['transaction_date'];?></td>
                        <td><?php echo $row['transaction_id'];?></td>
                        <td><?php echo $row['receiver_id'];?></td>
                        <td style="width:50%; text-align:left; padding:10px;">
                            <b>
                                <?php echo $row['first_name']." ". $row['last_name'];?>
                            </b></br>
                            <div style="font-size:15px;">
                            <?php echo $row['degree_name'];?>
                            </div>
                        </td>
                     <!-- need to change later-->
                        <td><?php echo $row['wallet_balance'];?></td>
                        <td><?php echo $row['transaction_amount'];?></td>
                        
                </tr>
                <?php
            }
            ?>

            </table>
            </br>
            
            
                
        </div>
         
        


            </div>  


    </div>
</body>

</html>