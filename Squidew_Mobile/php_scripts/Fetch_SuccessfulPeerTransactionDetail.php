<?php

$transaction_id = $_POST["transaction_id"];

//Test Data
//$transaction_id = "37";

require '../../Database Settings/database_access_credentials.php';
          

$query_peek_peer_transaction = "select * from transaction inner join peer_transaction on peer_transaction.transaction_id = transaction.transaction_id inner join student on student.student_id = peer_transaction.receiver_id inner join students_profile on students_profile.student_id = student.student_id where transaction.transaction_id ='".$transaction_id."';";
$run_query_peer_transaction = mysqli_query($connection, $query_peek_peer_transaction);

while($row = mysqli_fetch_assoc($run_query_peer_transaction)){
    $jsonresult[] = $row;
    print(json_encode($jsonresult));
}



?>