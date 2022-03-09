<?php
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//LIVE ARRAY TO USE
$post_params_field_array = array(
     "admin_fname",
     "admin_mname",
     "admin_lname",
     "admin_email",
     "admin_contact",
     "admin_birthdate",
     "admin_username",
     "admin_password",
     "admin_account_status",
     "admin_associated_hei",
     "admin_suffix",
     "admin_gender",
     "admin_location",
     "admin_profile_image");

// TEST ARRAY <-- Disable this 
// $post_params_field_array = array(
//     "add_admin_fname",
//     "add_admin_mname",
//     "add_admin_lname",
//     "add_email",
//     "add_contact_number",
//     "add_birthdate",
//     "admin_username",
//     "admin_password",
//     "admin_status",
//     "associated_hei",
//     "add_suffix",
//     "add_gender",
//     "add_admin_location",
//     "admin_profile_image");

$post_params_field_array_data_value = array();


 for($i = 0;$i < sizeof($post_params_field_array); $i++){
    $post_params_field_string_holder = $post_params_field_array[$i];
    if(isset($_POST[(String)$post_params_field_array[$i]])){
        array_push($post_params_field_array_data_value, $_POST[(String)$post_params_field_array[$i]]);
        // print_r($post_params_field_array_data_value[$i].", "); 
    ?>

<!-- For Console Debugging -->
<script>
console.log("<?php echo $post_params_field_array[$i].' is Set.'; ?>");
console.log('Admin Value: ' + "<?php echo $_POST[(String)$post_params_field_array[$i]]; ?>");
</script>

<?php
        }else{
        //Form Fields have not been set.
        }
}

echo $post_params_field_array_data_value[11];
$query_push_new_hei_profile = "insert into admin (first_name,middle_name,last_name,email,contact_number,birthdate,username,password,account_status, hei_id, suffix, sex, home_address, profile_image) value ('".$post_params_field_array_data_value[0]."','".$post_params_field_array_data_value[1]."','".$post_params_field_array_data_value[2]."','".$post_params_field_array_data_value[3]."','".$post_params_field_array_data_value[4]."','".$post_params_field_array_data_value[5]."','".$post_params_field_array_data_value[6]."','".$post_params_field_array_data_value[7]."','".$post_params_field_array_data_value[8]."',(select hei_id from hei where hei_id= '".$post_params_field_array_data_value[9]."'),'".$post_params_field_array_data_value[10]."','".$post_params_field_array_data_value[11]."','".$post_params_field_array_data_value[12]."','".$post_params_field_array_data_value[13]."')";
$query_run = mysqli_query($connection, $query_push_new_hei_profile);



?>