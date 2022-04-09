<?php

//$student_id = $_POST["student_id"];

//Test Data
 $student_id = "18000022";

require '../../Database Settings/database_access_credentials.php';


$query_peek_student_billing = "select term, due_date, balance, total_bill from student_account_statement where student_id = '".$student_id."' order by billing_id desc limit 1;";
$run_query_peek_billing = mysqli_query($connection, $query_peek_student_billing);

while($row = mysqli_fetch_assoc($run_query_peek_billing)){
    $jsonresult[] = $row;
    print(json_encode($jsonresult));
}

?>