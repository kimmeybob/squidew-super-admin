<?php

$student_id = $_POST["student_id"];

//Test Data
//$student_id = '18000022';

require '../../Database Settings/database_access_credentials.php';

$query_fetch_student_wallets = "select * from wallet
inner join linked_card on linked_card.wallet_id = wallet.wallet_id
inner join student on student.student_id = linked_card.student_id where
student.student_id = '".$student_id."'";

$run_query = mysqli_query($connection, $query_fetch_student_wallets);
$query_fetch_response = mysqli_num_rows($run_query) > 0;

if($query_fetch_response){
    while($row = mysqli_fetch_assoc($run_query)){
        $jsonresult[] = $row;
    }

    print(json_encode($jsonresult));
}else{
    print("false");
}

?>