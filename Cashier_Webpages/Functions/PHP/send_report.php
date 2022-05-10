<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';
session_start();


//LIVE data TO USE
$title = $_POST['title'];
$email = $_POST['email'];
$description = $_POST['description'];



$query_add_report = "insert into report_bug(report_title, report_message, email, status, report_time) values 
('".$title."', '".$description."', '".$email."','0', NOW());";
$query_run = mysqli_query($connection, $query_add_report);

// 

?>