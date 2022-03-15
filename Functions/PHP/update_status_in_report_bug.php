<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//Live Data
$report_bug_id = $_POST['report_bug_id'];
$report_status_input = $_POST['report_status'];


$query_update_status = "update report_bug set status = '".$report_status_input."' where report_id = ".$report_bug_id;
$query_run = mysqli_query($connection, $query_update_status);

?>