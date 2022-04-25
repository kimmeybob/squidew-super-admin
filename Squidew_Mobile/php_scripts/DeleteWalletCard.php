<?php

$student_id = $_POST['student_id'];
$account_number = $_POST['account_number'];

//Test
//$student_id = '18000019';
//$account_number = '5678-9463-8406-6798';

require '../../Database Settings/database_access_credentials.php';

$fetch_linked_card_details_query = "select * from linked_card where account_number = '".$account_number."' and student_id = '".$student_id."'";
$run_query = mysqli_query($connection, $fetch_linked_card_details_query);

while($row = mysqli_fetch_array($run_query)){
    $linked_card_id = $row["linked_card_id"];
    $wallet_card_id = $row["wallet_id"];
}

//echo "LInked card: ".$linked_card_id." | Wallet_id: ".$wallet_card_id;
$delete_linked_card_query = "delete from linked_card where linked_card_id = '".$linked_card_id."'";
$run_query_delete_linked_card = mysqli_query($connection, $delete_linked_card_query);

$delete_wallet_card_query = "delete from wallet where wallet_id = '".$wallet_card_id."'";
$run_query_delete_wallet_card = mysqli_query($connection, $delete_wallet_card_query);

echo 'success';

?>