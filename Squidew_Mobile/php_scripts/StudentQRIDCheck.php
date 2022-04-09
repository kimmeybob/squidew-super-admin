<?php

$student_id = $_POST["student_id"];
$hei_id = $_POST["school"];

//Test Data
//$student_id = "18000022";
//$hei_id = "210";

require '../../Database Settings/database_access_credentials.php';


$query_peek_student_id = "select * from student where student_id = '".$student_id."' and hei_id = '".$hei_id."';";
$run_query_peek_student_id = mysqli_query($connection, $query_peek_student_id);
$query_result = mysqli_num_rows($run_query_peek_student_id) > 0;

if(!$query_result){
    echo "false";
}else{
    while($row = mysqli_fetch_assoc($run_query_peek_student_id)){
        $jsonresult[] = $row;
    }
    print(json_encode($jsonresult));
}




?>