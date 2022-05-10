<?php
session_start();
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
    <link rel="stylesheet" href="Styles/Cashier_side/bill_payment_style.css" type="text/css" />
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
        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; ">
            <div style="background:white;flex: 100%;margin: 0% 2% 5% 2%;height: 100%; flex-wrap: wrap;">
                <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>Dashboard / Payments</b>
                <div style="background: white;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;">Latest <b>Payment</b>   records</p>
                    
                    <div style="background: white;flex: 100%;display: flex;flex-wrap: wrap; ">
                    </div>    
            </div>   
            <form id ="search" method="POST">
                    <b><span>Custom Search: </span></b> <br><br> <span>From:</span>
                        <input type="date" class="from_date" id="from_date" minlength="3" maxlength="50"
                            name="from_date" placeholder="e.g. 00/00/0000 "  />
                           
                             <span>To: &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="date" class="to_date" id="to_date" minlength="3" maxlength="50"
                            name="to_date" placeholder="e.g. 00/00/0000 "  />
                           
                            <input style="outline: none;
                        border-style: solid;
                        border-width: thin;
                        border-color: #2c71ec;
                        margin-left: 3%;
                        margin-right: 10%;
                        width: 7%;
                        height: 30px;
                        color: white;
                        font-size: normal;
                        background-color: #2c71ec;
                        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                        border-radius: 20px;"
                        type="submit"  value= "Search" name="datesearch" id="datesearch" class = "datesearch" >      
                        
                <form>
                    <br>
                    <br>

                  
            <table style="width:98.1%; ">      
            <tr style="background: #0E203F; color: white; text-align: center; ">
                        <th style="width:12%; font-size:14px;  ">Date & Time</th>
                        <th style="width:12%;font-size:14px;  ">Transaction No.</th>
                        <th style="width:10%;font-size:14px;  ">ID No.</th>
                        <th style="width:42%;font-size:14px; text-align: center; ">Student Name</th>
                        <th style="width:10%;font-size:14px; ">Type</th>
                        <th style="width:10%;font-size:14px;  ">Amount</th>
                        <th style="width:4%;">  Action </th>
                        
                        
                        
                    </tr>
</table>
                <!--  Payment transaction tables -->
                <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; overflow-x: hidden; overflow-y:auto; height: 40%">
                <table style="width:100%;">
                    <?php 
                
                $query = "select *, transaction_amount as amount from transaction
                inner join bills_transaction on bills_transaction.transaction_id = transaction.transaction_id
                inner join student on student.student_id = bills_transaction.sender_id
                inner join students_profile on students_profile.student_id = student.student_id
                inner join degree on degree.degree_id = student.degree_id
                inner join hei on hei.hei_id = student.hei_id where hei.hei_id = '".$_SESSION['hei_id']."';";
                
                $run_query = mysqli_query($connection,$query);
                $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                  

                ?>
        <!--search-->
        <?php 
                    if(isset($_POST['datesearch'])){

                        $to_date = $_POST['to_date'];
                        $from_date = $_POST['from_date'];

                        if($to_date != "" && $from_date != ""){
                      
                        $query = "select *, transaction_amount as amount from transaction
                        inner join bills_transaction on bills_transaction.transaction_id = transaction.transaction_id
                        inner join student on student.student_id = bills_transaction.sender_id
                        inner join students_profile on students_profile.student_id = student.student_id
                        inner join degree on degree.degree_id = student.degree_id
                        inner join linked_card on linked_card.student_id = student.student_id 
                        inner join wallet on wallet.wallet_id = linked_card.wallet_id
                        inner join hei on hei.hei_id = student.hei_id 
                        where (transaction.transaction_type = '4' OR transaction.transaction_type = '1' OR transaction.transaction_type = '6') and(transaction.transaction_date BETWEEN '".$from_date."' AND '".$to_date."') and wallet_name = 'Squidew Wallet' and hei.hei_id = '".$_SESSION['hei_id']."'";             
    
                        $run_query = mysqli_query($connection, $query);
                        


                        }
                        else{
                            echo '<script>alert("from/to date cannot be empty")</script>';
                        }
                        
                    }


                    
                   
                    ?>
        <!-- end search -->
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
                        <td style="font-size:14px; text-align:left;  width:12%;" onclick=""><?php echo $row['transaction_date'];?></td>
                        <td style="font-size:14px; text-align:left;  width:12%;">00000<?php echo $row['transaction_id'];?></td>
                        <td style="width:10%; font-size:14px; "><?php echo $row['sender_id'];?></td>
                        <td style="width:42%;font-size:14px; text-align:left; padding:10px;  ">
                            <b>
                                <?php echo $row['first_name']." ". $row['last_name'];?>
                            </b></br>
                            <div style="font-size:15px;">
                            <?php echo $row['degree_name'];?>
                            </div>
                        </td>
                        <td style="width:10%;font-size:14px;  "><?php echo $row['transaction_type'];?></td>
                        <td style="width:10%; font-size:14px; "><?php echo $row['amount'];?></td>
                        <td style="width:5%; ">
                            <form action="" method="GET">
                            <!-- Do not remove input | input search serves as a Constructor method which has student_id as params -->
                                <input style="display: none;" type="text" name="search" required value="<?php echo $row['transaction_id'];?>" class="form-control">
                                <input style="outline: none; border:none; border-color: #2c71ec; width: 10%;
                                 color: white; width:50px; height:20px;
                                 background-color: #2c71ec;
                                 border-radius: 15px; "type="submit" value="View" id="btn">   
                            </form>                 
                        </td>
                        <!-- <td style="width:8%;   ">
                            <form action="" method="GET">
                                    <div style> -->
                                        <!-- Do not remove input | input search serves as a Constructor method which has student_id as params -->
                                        <!-- <input style="display: none;" type="text" name="search" required value="<?php echo $row['transaction_id'];?>" class="form-control">
                                        <input style="outline: none; border-style: solid; border-width: thin;border-color: #2c71ec; margin-left: 10%; margin-right: 10%;  width: 50%; height: 30px; color: white; font-size: normal; background-color: #2c71ec; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 20px;"type="submit" value="View" id="btn"> 
                                    </div>
                            </form> 
                        </td> -->
                        
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

         <div class="query_sidenav" style="width: 280px; overflow-x: hidden; overflow-y:auto; height: 50%">
            <div style="margin: 48px 1.2rem 2% 1.2rem;font-size: 1.2rem;font-weight: bold;text-align: left;">


  

                                <form action="" method="GET">
                                    <div style =>
                                        <input type="text" name="search"  value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search " style="height:30px;">
                                        <button type="submit" style="height:30px;"><i class="fa fa-search" aria-hidden="true" ></i></button>
                                    </div>
                                </form>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","squidew");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "select * from transaction
                                        inner join bills_transaction on bills_transaction.transaction_id = transaction.transaction_id
                                        inner join student on student.student_id = bills_transaction.sender_id
                                        inner join students_profile on students_profile.student_id = student.student_id
                                        inner join degree on degree.degree_id = student.degree_id where transaction.transaction_id = '".$filtervalues."';";
                                        // and CONCAT(transaction.transaction_id) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                         
                                                 <p style="font-size: 0.9rem; text-align:center ">------------------Details------------------   </p> 
                                         <p id="" style="font-size:0.8rem; ">Student ID No. : <?= $items['student_id']; ?>
                                         <p id="" style="font-size:0.8rem; ">Student Name : <?= $items['first_name'].' '.$items['middle_name'].' '.$items['last_name']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Transaction ID: <?= $items['transaction_id']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Transaction Type : <?= $items['transaction_type']; ?></p>
                                         <p id="" style="font-size:0.8rem; ">Amount : <?= $items['transaction_amount']; ?></p>

                                         
                                                
                                                
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