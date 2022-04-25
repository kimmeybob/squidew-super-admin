<?php

$student_id = $_POST["student_id"];
$account_name = $_POST["account_holder"];
$account_number = $_POST['account_number'];
$account_type = $_POST['account_type'];
$account_issuer = $_POST['account_issuer'];

$account_cvc = $_POST['account_cvc'];
$account_expiry = $_POST['account_expiry'];


//Test Data
// $student_id = "18000002";
// $account_name = "Daryl Gabuat";
// $account_number = "2229119292992922";
// $account_type = "Debit";
// $account_issuer = "Metro Bank";

// $account_cvc = "229";
// $account_expiry = "2022-12-01";


require '../../Database Settings/database_access_credentials.php';


$create_wallet_query = "insert into wallet (wallet_name, wallet_balance) values ('".$account_issuer."','0');";

if(mysqli_query($connection,$create_wallet_query)){
  $last_id = mysqli_insert_id($connection);
  $create_wallet_linked_card_query = "insert into linked_card (account_type,account_name,expiry_date,account_number,account_cvc,wallet_id,student_id) 
  values ('".strtoupper($account_type)."','".$account_name."','".$account_expiry."','".$account_number."','".$account_cvc."','".$last_id."','".$student_id."');";    
  $run_create_new_wallet_linked_card_query = mysqli_query($connection, $create_wallet_linked_card_query);
  echo 'success';
}else{
  echo 'false';
}

?>