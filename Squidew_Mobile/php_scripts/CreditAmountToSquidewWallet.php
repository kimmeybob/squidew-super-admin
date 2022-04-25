<?php

$student_id = $_POST["student_id"];
//$total_amount = $_POST["total_amount"];

//Test Data
//$student_id = "18000001";
$total_amount = "1000.00";

require '../../Database Settings/database_access_credentials.php';

//Fetch Recipient Data
$fetch_student_recipient_data_query = "select * from student
inner join hei on hei.hei_id = student.hei_id
inner join students_profile on students_profile.student_id = student.student_id
inner join linked_card on linked_card.student_id = student.student_id
inner join wallet on wallet.wallet_id = linked_card.wallet_id
where wallet.wallet_name = 'SQUIDEW Wallet' and student.student_id='".$student_id."'";

$run_query_recipient_fetch = mysqli_query($connection, $fetch_student_recipient_data_query);
$query_response_recipient = mysqli_num_rows($run_query_recipient_fetch) > 0;

if($query_response_recipient){

    
    //Details for Transaction Checkout Receipt
    $returnObj = new stdClass();
    
    while($fetch_recipient_details_row = mysqli_fetch_array($run_query_recipient_fetch)){
        
        $recipient_wallet_balance = $fetch_recipient_details_row['wallet_balance'];
        $recipient_wallet_id = $fetch_recipient_details_row['wallet_id'];

        //echo $fetch_recipient_details_row['wallet_id'];

    
        //$recipient_wallet_id = 0;

        //return Obj
        $returnObj->recipient_id = $student_id;
        $returnObj->recipient_fname = $fetch_recipient_details_row['first_name'];
        $returnObj->recipient_lname = $fetch_recipient_details_row['last_name'];
        $returnObj->paymethod = "GCash";
        $returnObj->amount = $total_amount;
    }

        //Wallet Additions for Recipient
        $recipient_new_balance = bcadd($recipient_wallet_balance, $total_amount, 2); 

         //echo "Recipient ID: ".$student_id."\n";
         //echo "Recipient Balance: ".$recipient_new_balance."\n";
         //echo "Wallet Id: ".$recipient_wallet_id."\n";

        $add_recipient_balance_query = "update wallet set wallet_balance = '".$recipient_new_balance."' where wallet_id = '".$recipient_wallet_id."'";
        $run_add_recpient_balance_query = mysqli_query($connection, $add_recipient_balance_query);
        
        //Create Transaction and Peer Transaction Records
        $current_date_and_time = date("Y-m-d h:m:s");

        //return Obj
        $returnObj->date_and_time = $current_date_and_time;

        //print();
   
}else{
    $inner_return_code_status = "false";
}

?>