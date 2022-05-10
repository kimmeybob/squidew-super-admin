<?php

$student_id = $_POST["student_id"];
$pin = $_POST["pin"];

//Test Data
//$student_id = "18000001";
//$pin = "0000";



require '../../Database Settings/database_access_credentials.php';


$query_update_pin = "update student set auth_pin = '".$pin."' where student_id = '".$student_id."'";
$run_query_update_update_pin = mysqli_query($connection, $query_update_pin);
echo 'success';


?>