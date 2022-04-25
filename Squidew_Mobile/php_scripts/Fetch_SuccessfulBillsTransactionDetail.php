<?php

$transaction_id = $_POST["transaction_id"];

//Test Data
//$transaction_id = "43";

require '../../Database Settings/database_access_credentials.php';


$query_peek_bills_transaction = "select * from transaction inner join bills_transaction on bills_transaction.transaction_id = transaction.transaction_id where transaction.transaction_id ='".$transaction_id."';";
$run_query_peek_transaction = mysqli_query($connection, $query_peek_bills_transaction);

while($row = mysqli_fetch_assoc($run_query_peek_transaction)){
    $jsonresult[] = $row;
    print(json_encode($jsonresult));
}



?>