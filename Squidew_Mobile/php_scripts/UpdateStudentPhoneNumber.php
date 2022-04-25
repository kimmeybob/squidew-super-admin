<?php

$student_id = $_POST["student_id"];
$phone_number = $_POST["phone_number"];

//Test Data
//$student_id = "18000002";
//$phone_number = "09566583893";

require '../../Database Settings/database_access_credentials.php';


$query_update_phone_number = "update students_profile set contact_number = '".$phone_number."' where student_id = '".$student_id."'";
$run_query_updae_phone_number = mysqli_query($connection, $query_update_phone_number);

?>