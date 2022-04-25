<?php

$transaction_id = $_POST["transaction_id"];

//Test Data
//$transaction_id = "44";

require '../Database Settings/database_access_credentials.php';

$query_update_transaction_status = "update transaction set transaction_status = '9' where transaction_id = '".$transaction_id."'";
$run_query_update_transaction_status = mysqli_query($connection, $query_update_transaction_status);


?>