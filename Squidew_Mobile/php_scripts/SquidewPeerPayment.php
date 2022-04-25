<?php

$student_id = $_POST["student_id"];
$recipient_id = $_POST["recipient_id"];
$total_amount = $_POST["total_amount"];

$inner_return_code_status = "";


//Test Data
//$student_id = "18000001";
//$recipient_id = "18000002";
//$total_amount = "10.00";

//$total_amount_deductable = bcadd($total_amount, $fee_amount, 2);

require '../../Database Settings/database_access_credentials.php';


//Fetch Student Necessary Data

$fetch_student_sender_data_query = "select * from student
inner join hei on hei.hei_id = student.hei_id
inner join students_profile on students_profile.student_id = student.student_id
inner join linked_card on linked_card.student_id = student.student_id
inner join wallet on wallet.wallet_id = linked_card.wallet_id
where wallet.wallet_name = 'SQUIDEW Wallet' and student.student_id='".$student_id."'";
$run_query_sender_fetch = mysqli_query($connection, $fetch_student_sender_data_query);
$query_response = mysqli_num_rows($run_query_sender_fetch) > 0;

if($query_response){

    $sender_wallet_balance = 0.00;
    $recipient_wallet_balance = 0.00;
    $sender_wallet_id = 0;
    $recipient_wallet_id = 0;

    

    //Details for Transaction Checkout Receipt
    $returnObj = new stdClass();
    
    $recipient_wallet_id = 0;
    
    while($fetch_sender_details_row = mysqli_fetch_array($run_query_sender_fetch)){
        $sender_wallet_balance = $fetch_sender_details_row['wallet_balance'];
        $sender_wallet_id = $fetch_sender_details_row['wallet_id'];

    }

    //Fetch Recipient Data
    $fetch_student_recipient_data_query = "select * from student
    inner join hei on hei.hei_id = student.hei_id
    inner join students_profile on students_profile.student_id = student.student_id
    inner join linked_card on linked_card.student_id = student.student_id
    inner join wallet on wallet.wallet_id = linked_card.wallet_id
    where wallet.wallet_name = 'SQUIDEW Wallet' and student.student_id='".$recipient_id."'";
    $run_query_recipient_fetch = mysqli_query($connection, $fetch_student_recipient_data_query);
    $query_response_recipient = mysqli_num_rows($run_query_recipient_fetch) > 0;

    if($query_response_recipient){
        
        while($fetch_recipient_details_row = mysqli_fetch_array($run_query_recipient_fetch)){
            
            $recipient_wallet_balance = $fetch_recipient_details_row['wallet_balance'];
            $recipient_wallet_id = $fetch_recipient_details_row['wallet_id'];

            //echo $fetch_recipient_details_row['wallet_id'];

            //return Obj
            $returnObj->recipient_id = $fetch_recipient_details_row['student_id'];
            $returnObj->recipient_fname = $fetch_recipient_details_row['first_name'];
            $returnObj->recipient_lname = $fetch_recipient_details_row['last_name'];
            $returnObj->paymethod = "SQUIDEW Pay";
            $returnObj->amount = $total_amount;
        }

        if($sender_wallet_balance < bcadd($total_amount,0,2)){
            $inner_return_code_status = "false";
        }else{
             //Wallet Deductions for Sender
           $sender_new_balance = bcsub($sender_wallet_balance, $total_amount, 2); 

           $deduct_sender_balance_query = "update wallet set wallet_balance = '".$sender_new_balance."' where wallet_id = '".$sender_wallet_id."'";
           $run_deduct_sender_balance_query = mysqli_query($connection, $deduct_sender_balance_query);

            //Wallet Additions for Recipient
            $recipient_new_balance = bcadd($recipient_wallet_balance, $total_amount, 2); 

            // echo "Recipient ID: ".$recipient_id."\n";
            // echo "Recipient Balance: ".$recipient_new_balance."\n";
            // echo "Wallet Id: ".$recipient_wallet_id."\n";

            $add_recipient_balance_query = "update wallet set wallet_balance = '".$recipient_new_balance."' where wallet_id = '".$recipient_wallet_id."'";
            $run_add_recpient_balance_query = mysqli_query($connection, $add_recipient_balance_query);
            
            //Create Transaction and Peer Transaction Records
            $current_date_and_time = date("Y-m-d h:m:s");
            $create_peer_transaction_query = "insert into transaction (transaction_amount, transaction_date, transaction_status, transaction_type) values (".$total_amount.",'".$current_date_and_time."','1','0');";
            
            //return Obj
            $returnObj->date_and_time = $current_date_and_time;

            if(mysqli_query($connection,$create_peer_transaction_query)){
              $last_id = mysqli_insert_id($connection);

              //return Obj
              $returnObj->reference_id = $last_id;

              $create_peer_transaction_query = "insert into peer_transaction (transaction_id,receiver_id, sender_id) values ('".$last_id."','".$recipient_id."','".$student_id."');";    
              $run_create_new_peer_transaction_query = mysqli_query($connection, $create_peer_transaction_query);
              
              //Response and Result
              //print(json_encode($returnObj));

              print($last_id);

            }else{
              echo 'false';
            }
        }
       
    }else{
        $inner_return_code_status = "false";
    }
    
}else{
    echo 'false';
}

echo $inner_return_code_status;

?>