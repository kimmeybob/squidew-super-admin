<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';
session_start();
$include_username = false;
$include_password = false;

//Live Data



$cashier_id = $_POST['edit_cashier_id'];
$cashier_fname = $_POST['edit_cashier_fname'];
$cashier_mname = $_POST['edit_cashier_mname'];
$cashier_lname = $_POST['edit_cashier_lname'];
$cashier_email = $_POST['edit_cashier_email'];
$cashier_contact = $_POST['edit_cashier_contact'];
$cashier_suffix = $_POST['edit_cashier_suffix'];
$cashier_password = $_POST['edit_cashier_password'];
$cashier_username = $_POST['edit_cashier_username'];

//Check if passwor is blank
if(trim($_POST['edit_student_password']) == ""){
    //Field is Empty
}else{
    $student_password = $_POST['edit_student_password'];
    $include_password = true;
}
if(trim($_POST['edit_cashier_username']) == ""){
    //Field is Empty
}else{
    $include_username = $_POST['edit_cashier_username'];
    $include_username = true;
}



if($include_username && $include_password){
    //Both Username and Password is to be updated
    $query = "update cashier_account set first_name = '".$cashier_fname."', last_name = '".$cashier_lname."', middle_name = '".$cashier_mname."', suffix = '".$cashier_suffix."', contact_number  = '".$cashier_contact."', email  = '".$cashier_email."',  username  = '".$cashier_username."', password  = '".$cashier_password."' where cashier_id = '".$cashier_id."'; ";
    $query_run = mysqli_query($connection,$query);

}else if($include_username){
    //Only Username is to be updated
    $query = "update cashier_account set first_name = '".$cashier_fname."', last_name = '".$cashier_lname."', middle_name = '".$cashier_mname."', suffix = '".$cashier_suffix."',  contact_number  = '".$cashier_contact."', email  = '".$cashier_email."',  username  = '".$cashier_username."' where cashier_id = '".$cashier_id."'; ";
    $query_run = mysqli_query($connection,$query);
}else if($include_password){
    //Only Password is to be updated
    $query = "update cashier_account set first_name = '".$cashier_fname."', last_name = '".$cashier_lname."', middle_name = '".$cashier_mname."', suffix = '".$cashier_suffix."', contact_number  = '".$cashier_contact."',  email  = '".$cashier_email."',   password  = '".$cashier_password."' where cashier_id = '".$cashier_id."'; ";
    $query_run = mysqli_query($connection,$query);
}else{
    //Neither Username and Password is to be updated
    $query = "update cashier_account set first_name = '".$cashier_fname."', last_name = '".$cashier_lname."', middle_name = '".$cashier_mname."', suffix = '".$cashier_suffix."', contact_number  = '".$cashier_contact."',  email  = '".$cashier_email."',  where cashier_id = '".$cashier_id."'; ";
    $query_run = mysqli_query($connection,$query);
   
}
  


?>