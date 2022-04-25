<?php

$transaction_id = $_POST["transaction_id"];

//Test Data
//$transaction_id = "43";

require '../../Database Settings/database_access_credentials.php';


$update_cashin_transaction_query = "update transaction set transaction_status = '1'";
$run_query_update_cashin_transaction_status = mysqli_query($connection, $update_cashin_transaction_query);

$query_peek_credits_transaction = "select * from transaction inner join credits_transaction on credits_transaction.transaction_id = transaction.transaction_id where transaction.transaction_id ='".$transaction_id."';";
$run_query_peek_transaction = mysqli_query($connection, $query_peek_credits_transaction);

while($row = mysqli_fetch_assoc($run_query_peek_transaction)){
    $jsonresult[] = $row;
    print(json_encode($jsonresult));
}



?>