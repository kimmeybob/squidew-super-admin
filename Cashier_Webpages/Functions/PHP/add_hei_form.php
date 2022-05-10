<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

//Add HEI Form Params
$post_params_field_array = array("hei_id","hei_name","hei_location","hei_type","hei_status","hei_start_contract", "hei_end_contract");
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


$query_push_new_hei_profile = "insert into hei (HEI_Name,HEI_Type,Status,Start,End) value ('".$post_params_field_array_data_value[1]."','".$post_params_field_array_data_value[3]."','".$post_params_field_array_data_value[4]."','".$post_params_field_array_data_value[5]."','".$post_params_field_array_data_value[6]."')";
$query_run = mysqli_query($connection, $query_push_new_hei_profile);
// $return_response_from_push_new_hei_profile = mysqli_num_rows($query_run) > 0;

// while($row = mysqli_fetch_array($query_run)){

// }



?>