<?php

$student_id = $_POST["student_id"];
$verified_status = $_POST["verified"];

//Test Data
//$student_id = "18000001";
//$verified_status = "2";
//Pass: usjrstudent_jamar


require '../../Database Settings/database_access_credentials.php';

$query_update_verification_v = "update student set verified = '".$verified_status."' where student_id = '".$student_id."'";
$run_query_update_verification_change = mysqli_query($connection, $query_update_verification_v);
echo 'success';
//echo 'Password Change with Verification Update';


?>