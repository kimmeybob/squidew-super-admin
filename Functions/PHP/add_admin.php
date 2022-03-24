<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//LIVE ARRAY TO USE
 $post_params_field_array = array(
    $_POST["admin_fname"],
    $_POST["admin_mname"],
    $_POST["admin_lname"],
    $_POST["admin_email"],
    $_POST["admin_contact"],
    $_POST["admin_birthdate"],
    $_POST["admin_username"],
    $_POST["admin_password"],
    $_POST["admin_account_status"],
    $_POST["admin_associated_hei"],
    $_POST["admin_suffix"],
    $_POST["admin_gender"],
    $_POST["admin_location"],
    $_POST["admin_profile_image"]); 

//Username and Password
//Username is Email
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$generated_password = substr( str_shuffle( $chars ), 0, 8 );


// TEST ARRAY <-- Disable this 
// $post_params_field_array = array(
//     $_POST["add_admin_fname"],
//     $_POST["add_admin_mname"],
//     $_POST["add_admin_lname"],
//     $_POST["add_email"],
//     $_POST["add_contact_number"],
//     $_POST["add_birthdate"],
//     $_POST["admin_username"],
//     $_POST["admin_password"],
//     $_POST["admin_status"],
//     $_POST["associated_hei"],
//     $_POST["add_suffix"],
//     $_POST["add_gender"],
//     $_POST["add_admin_location"],
//     $_POST["admin_profile_image"]);

$post_params_field_array_data_value = array();


// echo $post_params_field_array[0]."<br>";
// echo $post_params_field_array[1]."<br>";
// echo $post_params_field_array[2]."<br>";
// echo $post_params_field_array[3]."<br>";
// echo $post_params_field_array[4]."<br>";
// echo $post_params_field_array[5]."<br>";
// echo $post_params_field_array[6]."<br>";
// echo $post_params_field_array[7]."<br>";
// echo $post_params_field_array[8]."<br>";
// echo $post_params_field_array[9]."<br>";
// echo $post_params_field_array[10]."<br>";
// echo $post_params_field_array[11]."<br>";

$query_push_new_hei_profile = "insert into admin (first_name,middle_name,last_name,email,contact_number,birthdate,username,password,account_status, hei_id, suffix, sex, home_address, profile_image) value ('".$post_params_field_array[0]."','".$post_params_field_array[1]."','".$post_params_field_array[2]."','".$post_params_field_array[3]."','".$post_params_field_array[4]."','".$post_params_field_array[5]."','".$post_params_field_array[3]."','".$generated_password."','".$post_params_field_array[8]."',(select hei_id from hei where hei_id= '".$post_params_field_array[9]."'),'".$post_params_field_array[10]."','".$post_params_field_array[11]."','".$post_params_field_array[12]."','".$post_params_field_array[13]."')";
$query_run = mysqli_query($connection, $query_push_new_hei_profile);

?>