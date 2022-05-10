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
    <link rel="stylesheet" href="Styles/Cashier_side/cash_in_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Cash In</title>
    <style>
    tr:hover {
  background: #013f96;
  color: white;
  transition: 0.3s;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
td{
    text-align: left;

}
    </style>

</head> 

<body>
    <div class="body_container" style="display: flex;margin: 0 5% 0 0;">

        <!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
            <?php 
                require 'Components/Cashier/fixed_side_navigation_bar.php';
             ?>

        </div>
        <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; heigh">
            <div style="background:white;flex: 100%;margin: 0% 2% 5% 2%;height: 100%; flex-wrap: wrap;">
                <p style="background: white;color: black;font-size: 1.5rem;overflow: hidden;"><b>Cash In</b></p>
                <div style="background: white;flex-wrap: wrap;">
                    <p style="flex: 60%;color: black;overflow: hidden;font-size: 1.2rem;">Latest <b>Cash In</b></p>
                    
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
                    <tr style="background: #0E203F; color: white;text-align: center; ">
                        <th style="width:12%; font-size:14px;">Date & Time</th>
                        <th style="width:12%; font-size:14px;">TransactionNo.</th>
                        <th style="width:10%; font-size:14px;">ID No.</th>
                        <th style="width:42%; font-size:14px; ">Student Name</th>
                        <th style="width:10%; font-size:14px;">Wallet Ballance</th>
                        <th style="width:10%; font-size:14px;">Amount</th>
                        <th style="width:4%;">Action</th>
                        
                    </tr>
                </table>

                <!-- cash in tables -->
                <div class="main_data_container" style="flex: 60%;background: white;display: flex;flex-wrap: wrap; overflow-x: hidden; overflow-y:auto; height: 29%">
                <table style="width:100%">
                    <?php
                        $query =    "select * from transaction
                        inner join cashier_transaction on cashier_transaction.transaction_id = transaction.transaction_id
                        inner join student on student.student_id = cashier_transaction.receiver_id
                        inner join students_profile on students_profile.student_id = student.student_id
                        inner join degree on degree.degree_id = student.degree_id
                        inner join linked_card on linked_card.student_id = student.student_id 
                        inner join wallet on wallet.wallet_id = linked_card.wallet_id
                        inner join hei on hei.hei_id = student.hei_id
                        where transaction_type = '2' and wallet_name = 'Squidew Wallet' and hei.hei_id = '".$_SESSION['hei_id']."'";             
                        $run_query = mysqli_query($connection,$query);
                        $return_request_from_run_query = mysqli_num_rows($run_query) > 0;
                    ?>
                   
                    <?php
                    while($row = mysqli_fetch_array($run_query)){
                        ?>

                            <tr>
                                <td style="font-size:14px; text-align:left;  width:11.5%;" onclick=""><?php echo $row['transaction_date'];?></td>
                                <td style="font-size:14px; text-align:left;  width:12%;">00000<?php echo $row['transaction_id'];?></td>
                                <td style="font-size:14px; text-align:left;  width:10%;"><?php echo $row['student_id'];?></td>
                                <td style="width:40.8%;; padding:10px; ">
                                    <b>
                                        <?php echo $row['first_name']." ". $row['last_name'];?>
                                    </b></br>
                                    <div style="font-size:15px;">
                                    <?php echo $row['degree_name'];?>
                                    </div>
                                </td>
                                <td style="width:10%;"><?php echo $row['wallet_balance'];?></td>
                                <td style="width:10%;"><?php echo $row['transaction_amount'];?></td>
                        
                                <td style="width:10%;" >
                                    <div class="dropdown" style="margin: auto;">
                                            <form action="" method="GET">
                                            <div style>
                                                <!-- Do not remove input | input search serves as a Constructor method which has student_id as params -->
                                                <input style="display: none;" type="text" name="search" required value="<?php echo $row['transaction_id'];?>" class="form-control">
                                <input style="outline: none; border:none; border-color: #2c71ec; width: 10%;
                                 color: white; width:50px; height:20px;
                                 background-color: #2c71ec;
                                 border-radius: 15px; "type="submit" value="View" id="btn">   
                            </form>    </div>
                                    </form> 
                                            
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>
                        <?php
                    }
                    ?>

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
  <!--fetch id numbers -->
                 <select id = "id_options" class = "id_options" style="display:none;" >
                    <?php
                        $query = "select * from student inner join hei on hei.hei_id = student.hei_id where hei.hei_id = '".$_SESSION['hei_id']."';";
                        $query_run = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($query_run)){
                    ?>
                    <option value =<?php echo $row['student_id']?>><?php echo $row['student_id'] ?></option>
                                                
                    <?php
                     }
                    ?>
                </select>
                                   <!--end -->
                            Cash In Form
                            <form>
                                <br>
                                <div style="margin-bottom: 5%;">
                                    <div style="margin-bottom: 2.5%;font-size: 0.9rem;font-weight: normal;">Student ID No.</div>
  
                                    <div  style="display:flex;flex-wrap: wrap;width: calc(100% - 1.2rem);height: 3%">

                                        <div style="background: #092041;display: flex;flex: 20%;color: white;">
                                            <div style="margin: auto;text-align:center;font-size: 0.8rem">ID#</div>
                                        </div>
                                        
                                        <div style="display: flex;flex: 20%;">
                                            <input style="padding: 2.5%;" type="number" name="cash_in_student_id_number" id="cash_in_student_id_number_id" required placeholder="E.g 18229132" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div>
                                    <div style="margin-bottom: 2.5%;font-size: 0.9rem;font-weight: normal;">Amount</div>
  
                                    <div  style="display:flex;flex-wrap: wrap;width: calc(100% - 1.2rem);height: 3%">

                                        <div style="background: #092041;display: flex;flex: 20%;color: white;">
                                            <div style="margin: auto;text-align:center;font-size: 0.8rem">PHP</div>
                                        </div>
                                        
                                        <div style="display: flex;flex: 20%;">
                                            <input style="padding: 2.5%;" type="number" step="any" name="cash_in_amount" id="cash_in_amount_id" required placeholder="0.00" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div style="display: none;">
                                    <div style="margin-bottom: 2.5%;font-size: 0.9rem;font-weight: normal;">Description (Optional)</div>
  
                                    <div  style="display:block;flex-wrap: wrap;width: calc(100% - 1.2rem);height: 6%">
                                        
                                        <div style="display: flex;flex: 100%;">
                                            <textarea style="display: block;padding: 2.5%;resize: none;" type="text" name="cash_in_description" id="cash_in_description_id" rows="3" cols="29" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br></form>
                                <div style="display: block;flex: 100%;background:white;">
                                        <button style="width: calc(103% - 1.2rem);padding: 5%;background: #2C71EC;color: white;border: none;" id="cash_in_submit" class="cash_in_submit">CASH IN</button>
                                </div>
                                

                                <?php 
                                    $con = mysqli_connect("localhost","root","","squidew");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "select * from transaction
                                        inner join cashier_transaction on cashier_transaction.transaction_id = transaction.transaction_id
                                        inner join student on student.student_id = cashier_transaction.receiver_id
                                        inner join students_profile on students_profile.student_id = student.student_id
                                        inner join degree on degree.degree_id = student.degree_id
                                        inner join linked_card on linked_card.student_id = student.student_id 
                                        inner join wallet on wallet.wallet_id = linked_card.wallet_id
                                        where transaction_type = '2' and wallet_name = 'Squidew Wallet' and transaction.transaction_id= '".$filtervalues."'";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                         
                                                 <p style="font-size: 0.9rem; text-align:center ">--------------Transaction Details---------------   </p> 
                                                 <p id="" style="font-size:0.8rem; ">Date : <?= $items['transaction_date']; ?>
                                                <p id="" style="font-size:0.8rem; ">Transaction No. : <?= $items['transaction_id']; ?>
                                                <p id="" style="font-size:0.8rem; ">Student ID No. : <?= $items['student_id']; ?>
                                                <p id="" style="font-size:0.8rem; ">Student Name : <?= $items['first_name'].' '.$items['middle_name'].' '.$items['last_name']; ?></p>
                                                <p id="" style="font-size:0.8rem; ">Amount : <?= $items['transaction_amount']; ?></p>
                                     
                                        
                                                <?php
                                            }
                                        
                                        }
                                        
                                    }
                                ?>

                        
                            </body>
                        </table>
                       
                    </div>
                
                </div>
                
            </div>
        
        </div>
       
    </div>

<script>

function validateid(user) {


let listOptions = document.getElementById('id_options').options;
var bool = false;

    for (let i = 0; i < listOptions.length; i++) {
            if (listOptions[i].value == user) {
   
                bool = true;  
        
                }
            
            }

    return bool;
}
$(document).ready(function() {
    //Add HEI Profile Form Button
    $("#cash_in_submit").click(function() {
        //Add trapping
        if(document.getElementById("cash_in_student_id_number_id").value ==""){
        alert("Error: Student ID Number Field cannot be empty! Please try again...");    
        }
        else if(document.getElementById("cash_in_amount_id").value ==""){
            alert("Error: Cash In Amount Field cannot be empty! Please try again...");    
        }
        else{
            var id = document.getElementById("cash_in_student_id_number_id").value;
            if(validateid(id)==true){
                
            
                    $.ajax({
                        url: 'Functions/PHP/student_cash_in.php',
                        type: 'post',
                        data: {
                            student_id: $("#cash_in_student_id_number_id").val(),
                            cashier_id:  localStorage.getItem("cashier_id"),
                            total_amount: $("#cash_in_amount_id").val(),
                        },
                        success: function(result) {
                            location.reload();
                            //alert("Response: "+result);
                        }
                    });
            }
            else{
                alert("Student doesn't exist!");
            }
            
        
     }
    });
});
</script>

</html>
