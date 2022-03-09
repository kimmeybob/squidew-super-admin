<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//Add HEI Form Params
$post_params_field_array = array("hei_id","hei_name","hei_type","hei_status","hei_start_contract","hei_end_contract","hei_email","hei_contact","hei_location", "hei_profile_image");
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
console.log('Value: ' + "<?php echo $_POST[(String)$post_params_field_array[$i]]; ?>");
</script>

<?php
        }else{
        //Form Fields have not been set.
        }
}

$query_push_new_hei_profile = "insert into hei (hei_name,hei_type,status,start,end,company_email,contact_number,address,profile_image) value ('".$post_params_field_array_data_value[1]."','".$post_params_field_array_data_value[2]."','".$post_params_field_array_data_value[3]."','".$post_params_field_array_data_value[4]."','".$post_params_field_array_data_value[5]."','".$post_params_field_array_data_value[6]."','".$post_params_field_array_data_value[7]."','".$post_params_field_array_data_value[8]."','".$post_params_field_array_data_value[9]."')";
$query_run = mysqli_query($connection, $query_push_new_hei_profile);

if ($query_run) {
        echo "success"; //anything on success
    } else {
        die(header("HTTP/1.0 404 Not Found")); //Throw an error on failure
    }


?>