<?php

$student_id = $_POST["student_id"];
$new_email = $_POST["new_email"];

//Test Data
//$student_id = "18000001";
//$new_email = "1234";
//lazarodigamon@gmail.com


require '../../Database Settings/database_access_credentials.php';


    $query_update_email = "update students_profile set email = '".$new_email."' where student_id = '".$student_id."'";
    $run_query_update_email = mysqli_query($connection, $query_update_email);
    echo 'success';

?>