<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

$delete_admin_id = $_POST['admin_id'];

$query = "delete from admin where admin_id = $delete_admin_id";
$query_run = mysqli_query($connection,$query);


?>