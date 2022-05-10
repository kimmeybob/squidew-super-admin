<?php

$student_id = $_POST["student_id"];
$new_password = $_POST["new_password"];
$verified_status = $_POST["verified"];

//Test Data
// $student_id = "18000001";
// $new_password = "1234";
// $verified_status = "0";
//Pass: usjrstudent_jamar


require '../../Database Settings/database_access_credentials.php';

if($verified_status == "0"){

    $query_update_password_v = "update student set password = '".$new_password."', verified = '1' where student_id = '".$student_id."'";
    $run_query_update_password_no_verification_change = mysqli_query($connection, $query_update_password_v);
    echo 'success';

    //Create OTP PIN 
    //echo 'Password Change with Verification Update';

}else{
    
    $query_update_password_nv = "update student set password = '".$new_password."' where student_id = '".$student_id."'";
    $run_query_update_password = mysqli_query($connection, $query_update_password_nv);
    echo 'success'; 
    //echo 'Password Change with No Verification Update';

}



?>