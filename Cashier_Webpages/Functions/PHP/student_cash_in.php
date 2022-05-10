<?php

$student_id = $_POST["student_id"];
$total_amount = $_POST["total_amount"];
$cashier_id = $_POST["cashier_id"];
$fee_amount = "0";


//Test Data
//  $student_id = "18000020";
//  $description = "Billing";
//  $cashier_id = "1";
//  $total_amount = "500.00";
//  $fee_amount = "0";

$total_amount_deductable = bcadd($total_amount, $fee_amount, 2);

require '../../Database Settings/database_access_credentials.php';


//Fetch Student Necessary Data

$transaction_id = 0;

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

    
        createTransactionAndCashInTransaction($total_amount, $fee_amount, $student_id, $connection, $cashier_id);
       
        CreditWalletBalance($student_wallet_id, $total_amount, $student_wallet_balance, $connection);
    
    
  
}else{
    echo 'false';
}

function createTransactionAndCashInTransaction($total_amount, $fee_amount, $cashin_student_id, $connection, $cashier_id){
    global $transaction_id;
  
    $current_date_and_time = date("Y-m-d h:m:s");
    $create_cashier_transaction_query = "insert into transaction (transaction_amount, transaction_date, transaction_status, transaction_type) values (".$total_amount.",'".$current_date_and_time."','1','2');";
  
    if(mysqli_query($connection,$create_cashier_transaction_query)){
      $last_id = mysqli_insert_id($connection);

      //Transaction Return ID
      $transaction_id = $last_id;

      $create_cashiers_transaction_query = "insert into cashier_transaction (transaction_id,receiver_id,cashier_id) values ('".$last_id."','".$cashin_student_id."','".$cashier_id."');";    
      $run_create_new_cashier_transaction_query = mysqli_query($connection, $create_cashiers_transaction_query);
    }else{
      echo 'false';
    }
}

function CreditWalletBalance($student_wallet_id, $total_amount_to_be_credited_no_fee, $student_wallet_balance, $connection){
    global $transaction_id;
    
    $new_wallet_balance = bcadd($student_wallet_balance, $total_amount_to_be_credited_no_fee, 2);
    $query_credit_wallet_balance = "update wallet set wallet_balance = ".$new_wallet_balance." where wallet_id=".$student_wallet_id.";";
    $run_query_credit_wallet_balance = mysqli_query($connection, $query_credit_wallet_balance);
    echo $transaction_id;
    echo 'success';
}


?>