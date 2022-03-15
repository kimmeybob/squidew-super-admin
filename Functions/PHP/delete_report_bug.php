<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

$report_bug_id = $_POST['report_bug_id'];

$query = "delete from report_bug where report_id = $report_bug_id";
$query_run = mysqli_query($connection,$query);


?>