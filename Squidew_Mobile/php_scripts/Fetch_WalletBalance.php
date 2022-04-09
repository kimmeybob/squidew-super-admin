<?php

$student_id = $_POST["student_id"];

//Test Data
//  $student_id = "18000022";

require '../../Database Settings/database_access_credentials.php';


$query_fetch_wallet_balance = "select * from student
inner join linked_card as lc on lc.student_id = student.student_id
inner join wallet as w on w.wallet_id = lc.wallet_id 
where student.student_id = '".$student_id."' and wallet_name = 'SQUIDEW Wallet';";
$run_query_query_fetch_wallet_balance = mysqli_query($connection, $query_fetch_wallet_balance);

while($row = mysqli_fetch_assoc($run_query_query_fetch_wallet_balance)){
    $jsonresult[] = $row;
}
print(json_encode($jsonresult));

?>