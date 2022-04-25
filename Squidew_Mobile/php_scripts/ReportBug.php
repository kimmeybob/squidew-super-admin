<?php

$report_title = $_POST["report_title"];
$report_description = $_POST["report_description"];
$student_email = $_POST['student_email'];

//Tests
// $report_title = "Missing Icon";
// $report_description = "Icon is missing in mobile";
// $student_email = "carlsankim@gmail.com";



$now = new DateTime();
$date_and_time = $now->format('Y-m-d H:i:s');

require '../../Database Settings/database_access_credentials.php';

$report_bug_query = "insert into report_bug (report_time, report_message, status, report_title, email) 
values ('".$date_and_time."', '".$report_description."','0','".$report_title."','".$student_email."')";
$run_report_bug_query = mysqli_query($connection, $report_bug_query);

?>