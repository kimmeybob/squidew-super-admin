<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

$activate_admin_id = $_POST['admin_id'];

$query = "update admin set account_status = '1' where admin_id = $activate_admin_id";
$query_run = mysqli_query($connection,$query);


?>