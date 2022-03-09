<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

$include_username = false;
$include_password = false;

//Live Data
$admin_profile_image = $_POST['edit_admin_profile_image'];
$admin_id = $_POST['edit_admin_id'];
$admin_associated_hei = $_POST['edit_hei_name'];
$admin_fname = $_POST['edit_admin_fname'];
$admin_mname = $_POST['edit_admin_mname'];
$admin_lname = $_POST['edit_admin_lname'];
$admin_location = $_POST['edit_admin_location'];
$admin_email = $_POST['edit_admin_email'];
$admin_contact = $_POST['edit_admin_contact'];
$admin_gender = $_POST['edit_admin_gender'];
$admin_suffix = $_POST['edit_admin_suffix'];
$admin_birthdate = $_POST['edit_admin_birthdate'];

//Test Data
// $admin_profile_image = "hello.png";
// $admin_id = $_POST['edit_admin_id'];
// $admin_associated_hei = $_POST['edit_associated_hei'];
// $admin_fname = $_POST['edit_admin_fname'];
// $admin_mname = $_POST['edit_admin_mname'];
// $admin_lname = $_POST['edit_admin_lname'];
// $admin_location = $_POST['edit_admin_location'];
// $admin_email = $_POST['edit_email'];
// $admin_contact = $_POST['edit_contact_number'];
// $admin_gender = $_POST['edit_gender'];
// $admin_suffix = $_POST['edit_suffix'];
// $admin_birthdate = $_POST['edit_birthdate'];

//Check if username is blank
if(trim($_POST['edit_username']) == ""){
    //Field is Empty
}else{
    $admin_username = $_POST['edit_username'];
    $include_username = true;
}

//Check if passwor is blank
if(trim($_POST['edit_password']) == ""){
    //Field is Empty
}else{
    $admin_password = $_POST['edit_password'];
    $include_password = true;
}
$admin_account_status = "1";



if($include_username && $include_password){
    //Both Username and Password is to be updated
    $query_update_admin_profile = "update admin set first_name = '".$admin_fname."', middle_name = '".$admin_mname."', last_name = '".$admin_lname."', email = '".$admin_email."', contact_number = '".$admin_contact."', birthdate = '".$admin_birthdate."', suffix = '".$admin_suffix."', sex = '".$admin_gender."', home_address = '".$admin_location."', profile_image = '".$admin_profile_image."', username = '".$admin_username."', password = '".$admin_password."' where admin_id = '".$admin_id."'";
}else if($include_username){
    //Only Username is to be updated
    $query_update_admin_profile = "update admin set first_name = '".$admin_fname."', middle_name = '".$admin_mname."', last_name = '".$admin_lname."', email = '".$admin_email."', contact_number = '".$admin_contact."', birthdate = '".$admin_birthdate."', suffix = '".$admin_suffix."', sex = '".$admin_gender."', home_address = '".$admin_location."', profile_image = '".$admin_profile_image."', username = '".$admin_username."' where admin_id = '".$admin_id."'";
}else if($include_password){
    //Only Password is to be updated
    $query_update_admin_profile = "update admin set first_name = '".$admin_fname."', middle_name = '".$admin_mname."', last_name = '".$admin_lname."', email = '".$admin_email."', contact_number = '".$admin_contact."', birthdate = '".$admin_birthdate."', suffix = '".$admin_suffix."', sex = '".$admin_gender."', home_address = '".$admin_location."', profile_image = '".$admin_profile_image."', password = '".$admin_password."' where admin_id = '".$admin_id."'";
}else{
    //Neither Username and Password is to be updated
    $query_update_admin_profile = "update admin set first_name = '".$admin_fname."', middle_name = '".$admin_mname."', last_name = '".$admin_lname."', email = '".$admin_email."', contact_number = '".$admin_contact."', birthdate = '".$admin_birthdate."', suffix = '".$admin_suffix."', sex = '".$admin_gender."', home_address = '".$admin_location."', profile_image = '".$admin_profile_image."' where admin_id = '".$admin_id."'";
}

$query_run = mysqli_query($connection, $query_update_admin_profile);


?>