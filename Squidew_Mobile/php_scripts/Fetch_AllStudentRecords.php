<?php

$hei_id = $_POST["hei_id"];

//Test Data
//$hei_id = '210';

require '../../Database Settings/database_access_credentials.php';

$query_fetch_student_records = " select student.student_id as s_id, student.hei_id,students_profile.*,profile_image.* from student
inner join students_profile on students_profile.student_id = student.student_id
inner join profile_image on profile_image.student_id = student.student_id
where student.hei_id = '".$hei_id."'";

$run_query = mysqli_query($connection, $query_fetch_student_records);
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