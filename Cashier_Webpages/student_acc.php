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
    <link rel="stylesheet" href="Styles/Cashier_side/student_acc_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">


    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Student Accounts</title>
    <style>
          
  th,
  td {
    border-bottom: 1px white;

  }
  tr:hover {
    background: #013f96;
    color: white;
    transition: 0.3s;
  }
  tr{
  background:rgb(204, 204, 204);
  
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
        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; heigh">
            <div style="background:white;flex: 100%;margin: 0% 2% 5% 2%;height: 100%; flex-wrap: wrap;">
                <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>Student Account</b>
                <div style="background: white;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;">Latest <b>Student Account</b>   records</p>
                    
                    <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap; ">
                   
                    
                    </div>    
            </div>   
            <table style="width:98%; ">      
            <tr style="background: #0E203F; color: white;text-align: center; ">
                        <th style="width:10%;  ">ID No.</th>
                        <th style="width:50%;  ">Student </th>
                        <th style="width:15%;  ">Wallet Balance</th>
                        <th style="width:15%;  ">Account Balance</th>
                        <th style="width:10%;  "></th>
                        
                    </tr>
</table>
                <!-- Stundents in tables -->
                <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; overflow-x: hidden; overflow-y:auto; height: 23%">
                <table style="width:100%;">
                    <?php 
                
                $query = "select student.account_status as account_status, 
                student.student_id as student_id, 
                students_profile.first_name as first_name, 
                students_profile.last_name as last_name, 
                students_profile.middle_name as middle_name, 
                degree.degree_name as degree_name, 
                student.year_level as year_level, 
                wallet.wallet_balance as squid_credit, 
                student_account_statement.balance as account_balance from student
                inner join students_profile on student.student_id = students_profile.student_id
                inner join linked_card on student.student_id = linked_card.student_id
                inner join wallet on wallet.wallet_id = linked_card.wallet_id 
                inner join degree on degree.degree_id = student.degree_id
                inner join student_account_statement on student.student_id = student_account_statement.student_id where wallet_name = 'Squidew Wallet'";
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                

                ?>

                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        $student_status = "Active";
                        if($row['account_status'] == 0){
                            $student_status = "Offline";
                        }else if($row['account_status'] == 1){
                            $student_status = "Active";
                        }else{
                            $student_status = "On Leave";
                        }
                        ?>

                    <tr >
                        <td onclick="" style="width:10%; "><?php echo $row['student_id'];?></td>
                        <td style="width:50%; text-align:left; padding:10px;  ">
                            <b>
                                <?php echo $row['first_name']." ". $row['last_name'];?>
                            </b></br>
                            <div style="font-size:15px;">
                            <?php echo $row['degree_name'];?>
                            </div>
                        </td>
                        <td style="width:15%;  "><?php echo $row['squid_credit'];?></td>
                        <td style="width:15%;  "><?php echo $row['account_balance'];?></td>
                        <td style="width:10%;   ">
                            <form action="" method="GET">
                                    <div style>
                                        <!-- Do not remove input | input search serves as a Constructor method which has student_id as params -->
                                        <input style="display: none;" type="text" name="search" required value="<?php echo $row['student_id'];?>" class="form-control">
                                        <input style="outline: none; border-style: solid; border-width: thin;border-color: #2c71ec; margin-left: 10%; margin-right: 10%;  width: 50%; height: 30px; color: white; font-size: normal; background-color: #2c71ec; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 20px;"type="submit" value="View" id="btn"> 
                                    </div>
                            </form> 
                        </td>
                        
                    </tr>
                    <?php
                }
                ?>
</div>
</table>
                <p style="display: none;padding: 0 0 0 1rem" id="table_empty_set_data_display">

            </div>

        </div>
            </div>
            <!-- END of Main Content Container -->
            <!-- Side Navigation -->
    <div style="width: 280px; padding-left:10px; margin-right:-75px; border-left: 2px solid rgb(204, 204, 204); " >

         <div class="query_sidenav" style="width: 280px;">
            <div style="margin: 48px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">


  

                                <form action="" method="GET">
                                    <div style =>
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search " style="height:30px;">
                                        <button type="submit" style="height:30px;"><i class="fa fa-search" aria-hidden="true" ></i></button>
                                    </div>
                                </form>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","squidew");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "select student.account_status as account_status, 
                                                    student.student_id as student_id, 
                                                    students_profile.first_name as first_name, 
                                                    students_profile.last_name as last_name, 
                                                    students_profile.middle_name as middle_name, 
                                                    degree.degree_name as degree_name, 
                                                    student.year_level as year_level, 
                                                    wallet.wallet_balance as squid_credit,
                                                    student.*, students_profile.*, degree.*, wallet.*, student_account_statement.*,
                                                    student_account_statement.balance as account_balance from student
                                                    inner join students_profile on student.student_id = students_profile.student_id
                                                    inner join linked_card on student.student_id = linked_card.student_id
                                                    inner join wallet on wallet.wallet_id = linked_card.wallet_id 
                                                    inner join degree on degree.degree_id = student.degree_id
                                                    inner join student_account_statement on student.student_id = student_account_statement.student_id WHERE wallet.wallet_name = 'Squidew Wallet' and CONCAT(student.student_id) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                         
                                                 <p style="font-size: 0.9rem; text-align:center ">------------------Student Details------------------   </p> 
                                         <p id="" style="font-size:0.8rem; ">Student ID No. : <?= $items['student_id']; ?>
                                         <p id="" style="font-size:0.8rem; ">Student Name : <?= $items['first_name'].' '.$items['middle_name'].' '.$items['last_name']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Squid Credit: <?= $items['wallet_balance']; ?>.00</p>
                                         <p id="" style="font-size:0.8rem; ">Account Balanace : <?= $items['balance']; ?></p>

                                         <p id="" style="font-size: 0.9rem; text-align:center ">-----------------Billing Statement----------------   </p> 
                                         <p id="" style="font-size:0.8rem; ">tuition Fee &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['tuition_fee']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Laboratory Fee &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['laboratory']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Registration Fee &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['registration']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Misc Fee &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['misc']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Aircon & Media &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['aircon_and_media']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Less Payments &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['less_payment']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Less Discount &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['less_discount']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Add adjustments Fee &nbsp&nbsp&nbsp&nbsp: <?= $items['add_adjustment']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Total Bill &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $items['total_bill']; ?></p>

                                         
                                         <p style="font-size: 0.9rem; text-align:center ">--------------------transactions--------------------   </p> 
                                         <table style="width:100%">
                                          <tr style="background: #0E203F; color: white;text-align: center;">
                                            
                                             <th style="font-size:0.8rem;">Date</th>
                                             <th style="font-size:0.8rem;">Amount</th>
                                             <th style="font-size:0.8rem;"></th>
                                         </tr>
                                            </table>
                                                
                                                
                                                <?php
                                            }
                                        
                                    $con = mysqli_connect("localhost","root","","squidew");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "Select t.transaction_id, t.transaction_amount, t.transaction_date,
                                        t.transaction_status, t.transaction_status, t.transaction_type, 
                                        pt.receiver_id as p_receiver_id, pt.sender_id as p_sender_id, ct.receiver_id as c_receiver_id, ct.cashier_id as c_sender_id,
                                        bt.sender_id as b_receiver_id, bt.sender_id as b_sender_id from transaction as t 
                                        left join peer_transaction as pt on t.transaction_id = pt.transaction_id
                                        left join cashier_transaction as ct on t.transaction_id = ct.transaction_id
                                        left join bills_transaction as bt on t.transaction_id = bt.transaction_id order by t.transaction_id desc
                                        ";
                                        $query_run = mysqli_query($con, $query);
 
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                               if( $items['b_sender_id'] == $filtervalues){
                                                   ?>

                                                    <table style="width:100%">
                                                        <tr style="text-align: center;">
                                                            <td style="width:81.5px"><p style=" color:black ; font-size:0.8rem;"><?=  $items['transaction_date']; ?></td>
                                                            <td style="width:115.5px"><p style=" color:black; font-size:0.8rem;"><?=  $items['transaction_amount']; ?></td>
                                                            <td>
                                                                    <div class="dropdown" style="margin: auto;">
                                                                        <button class="dropdown"
                                                                            style="margin: auto;background: white;width: 22px;height: 22px;border-radius: 22px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
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
                                                    </table>

                                                   <?php
                                                }else if( $items['c_sender_id']  == $filtervalues){
                                                    ?>
                                                    
                                                        <table style="width:100%">
                                                            <tr style="text-align: center;">
                                                                <td style="width:81.5px"><p style=" color:black ; font-size:0.8rem;"><?=  $items['transaction_date']; ?></td>
                                                                <td style="width:115.5px"><p style=" color:black; font-size:0.8rem;"><?=  $items['transaction_amount']; ?></td>
                                                                <td>
                                                                    <div class="dropdown" style="margin: auto;">
                                                                        <button class="dropdown"
                                                                            style="margin: auto;background: white;width: 22px;height: 22px;border-radius: 22px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
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
                                                        </table>

                                                    <?php
                                                }else if( $items['p_sender_id']  == $filtervalues){
                                                    ?>
                                                    <table style="width:100%">
                                                        <tr style="text-align: center;">
                                                            <td style="width:81.5px"><p style=" color:black ; font-size:0.8rem;"><?=  $items['transaction_date']; ?></td>
                                                            <td style="width:115.5px"><p style=" color:black; font-size:0.8rem;"><?=  $items['transaction_amount']; ?></td>
                                                            <td>
                                                                <div class="dropdown" style="margin: auto;">
                                                                    <button class="dropdown"
                                                                        style="margin: auto;background: white;width: 22px;height: 22px;border-radius: 22px;border: 1px solid #A1A1A1;box-shadow: 0 0 1px rgba(0, 0, 0, 0.35)">
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
                                                    </table>
                                                    <?php
                                               } // Closing sa If Statement
                                            }//End of For Each Loop
                                            
                                        }
                                        
                                    }
                                        
                                        }
                                        else
                                        {
                                            ?>
                                               
                                                    <td colspan="4">No Record Found</td>
                                                
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


        </body>
</html>