<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';


$edit_HEI_Name = $_POST['edit_hei_name'];
$edit_HEI_Type = $_POST['edit_hei_type'];
$edit_HEI_Status = $_POST['edit_hei_status'];
$edit_HEI_Start = $_POST['edit_hei_start'];
$edit_HEI_End = $_POST['edit_hei_end'];

$edit_HEI_ID = $_POST['edit_hei_id'];

//Joint Fields (HEI image)
// $edit_HEI_ID = $_POST['edit_hei_id'];

//To be Added and Implemented (add this to the Update HEI query)
$edit_HEI_Location = $_POST['edit_hei_location'];
$edit_HEI_email = $_POST['edit_hei_email'];
$edit_HEI_contact = $_POST['edit_hei_contact'];
$edit_HEI_profile = $_POST['edit_hei_profile'];


$query_update_hei_profile = "update hei set hei_name = '".$edit_HEI_Name."', profile_image = '".$edit_HEI_profile."',hei_type = '".$edit_HEI_Type."', status = '".$edit_HEI_Status."', start = '".$edit_HEI_Start."', end = '".$edit_HEI_End."' where hei_id = '".$edit_HEI_ID."'";
$query_run = mysqli_query($connection, $query_update_hei_profile);

?>