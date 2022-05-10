<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

$edit_HEI_ID = $_POST['remove_id'];

$query = "delete from hei where HEI_ID = $edit_HEI_ID";
$query_run = mysqli_query($connection,$query);


?>