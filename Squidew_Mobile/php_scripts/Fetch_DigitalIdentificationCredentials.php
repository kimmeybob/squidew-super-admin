<?php

$student_id = $_POST["student_id"];

//Test Data
//$student_id = "18000022";

require '../../Database Settings/database_access_credentials.php';


$query_qrid_details = "select * from student inner join digital_id on digital_id.student_id = student.student_id inner join students_profile on students_profile.student_id = student.student_id inner join profile_image on profile_image.student_id = student.student_id where student.student_id = '".$student_id."';";
$run_query_qrid_details = mysqli_query($connection, $query_qrid_details);

while($row = mysqli_fetch_assoc($run_query_qrid_details)){
    $jsonresult[] = $row;
}
print(json_encode($jsonresult));

?>