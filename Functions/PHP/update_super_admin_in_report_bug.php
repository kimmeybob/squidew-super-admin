<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//Live Data
$report_bug_id = $_POST['report_bug_id'];
$super_admin_id_input = $_POST['report_assignee'];


$query_update_assignee = "update report_bug set super_admin_id = (select super_admin_id from super_admin_account where super_admin_id = '".$super_admin_id_input."') where report_id = ".$report_bug_id;
$query_run = mysqli_query($connection, $query_update_assignee);

?>