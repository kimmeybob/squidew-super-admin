<?php

$student_id = $_POST["student_id"];
$description = $_POST["description"];
$total_amount = $_POST["total_amount"];
$fee_amount = $_POST["fee_amount"];


//Test Data
// $student_id = "18000021";
// $description = "Billing";
// $total_amount = "1.00";
// $fee_amount = "1.90";

$total_amount_deductable = bcadd($total_amount, $fee_amount, 2);

require '../../Database Settings/database_access_credentials.php';


//Fetch Student Necessary Data

$fetch_student_data_query = "select * from student
inner join hei on hei.hei_id = student.hei_id
inner join student_account_statement on student_account_statement.student_id = student.student_id
inner join students_profile on students_profile.student_id = student.student_id
inner join linked_card on linked_card.student_id = student.student_id
inner join wallet on wallet.wallet_id = linked_card.wallet_id
where wallet.wallet_name = 'SQUIDEW Wallet' and student.student_id='".$student_id."';";
$run_query = mysqli_query($connection, $fetch_student_data_query);
$query_response = mysqli_num_rows($run_query) > 0;

if($query_response){

    $student_wallet_balance = 0.00;
    $student_wallet_id = 0.00;

    //for Account Statements
    $current_bill_balance = 0.00;
    $current_overall_balance = 0.00;
    $billing_id = 0;
    
    while($row = mysqli_fetch_array($run_query)){
        $student_wallet_balance = $row["wallet_balance"];
        $student_wallet_id = $row["wallet_id"];
        $current_bill_balance = $row["total_bill"];
        $current_overall_balance = $row["balance"];
        $billing_id = $row["billing_id"];
    }

    if(bcsub($student_wallet_balance, $total_amount_deductable, 2) < 0){
        echo "insufficient";
    }else{
        createTransactionAndBillingTransaction($total_amount, $fee_amount, $student_id, $connection);
        deductStudentAccountBalance($student_id, $total_amount,$current_bill_balance,$current_overall_balance, $billing_id, $connection);
        deductWalletBalance($student_wallet_id, $total_amount, $student_wallet_balance, $connection);
    }
    
  
}else{
    echo 'false';
}

function createTransactionAndBillingTransaction($total_amount, $fee_amount, $bills_student_id, $connection){
  
    $current_date_and_time = date("Y-m-d h:m:s");
    $create_billing_transaction_query = "insert into transaction (transaction_amount, transaction_date, transaction_status, transaction_type) values (".$total_amount.",'".$current_date_and_time."','0','0');";
  
    if(mysqli_query($connection,$create_billing_transaction_query)){
      $last_id = mysqli_insert_id($connection);
      $create_bills_transaction_query = "insert into bills_transaction (transaction_id,sender_id) values ('".$last_id."','".$bills_student_id."');";    
      $run_create_new_bills_transaction_query = mysqli_query($connection, $create_bills_transaction_query);
    }else{
      echo 'false';
    }
}

function deductStudentAccountBalance($student_id, $total_amount,$current_bill_balance,$current_overall_balance, $billing_id, $connection){
    $new_total_bill = 0.00;
    $new_over_all_balance = 0.00;
    $raw_new_total_bill = bcsub($current_bill_balance, $total_amount, 2); 

    if($raw_new_total_bill > 0){
         //Paid amount is not greater than billing balance.
         $new_total_bill = $raw_new_total_bill;
         $new_over_all_balance = $current_overall_balance;
    }else{
        $raw_new_total_bill_for_deduction = abs(bcsub($current_bill_balance, $total_amount, 2)); 
        //Check if Amount paid is excess or greater than required bill amount
        $new_total_bill = 0.00;
        $new_over_all_balance = bcsub($current_overall_balance, $raw_new_total_bill_for_deduction, 2); 
    }
    $query_update_billing_statement = "update student_account_statement set total_bill = ".$new_total_bill.", balance = ".$new_over_all_balance." where billing_id = ".$billing_id.";";
    $run_query_billing_Statement = mysqli_query($connection, $query_update_billing_statement);
}

function deductWalletBalance($student_wallet_id, $total_amount_deductable_no_fee, $student_wallet_balance, $connection){
    $new_wallet_balance = bcsub($student_wallet_balance, $total_amount_deductable_no_fee, 2);
    $query_deduct_wallet_balance = "update wallet set wallet_balance = ".$new_wallet_balance." where wallet_id=".$student_wallet_id.";";
    $run_query_deduct_wallet_balance = mysqli_query($connection, $query_deduct_wallet_balance);
    echo 'success';
}


?>