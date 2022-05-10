<?php

$hei_id = $_POST["hei_id"];

//Test Data
//$hei_id = '101';

require '../../Database Settings/database_access_credentials.php';


$query_fetch_social_medial_link = "select * from department where hei_id='".$hei_id."'";
$run_query_fetch_social_medial_link = mysqli_query($connection, $query_fetch_social_medial_link);

if($response_num = mysqli_num_rows($run_query_fetch_social_medial_link) <= 0){
    echo 'false';
}else{
    while($row = mysqli_fetch_assoc($run_query_fetch_social_medial_link)){
        $returnObj = new stdClass();

        $returnObj->department_id = $row['department_id'];
        $returnObj->social_media_link = $row['social_media_link'];
        $returnObj->department_status = $row['department_status'];
        $returnObj->hei_id = $row['hei_id'];
        $returnObj->department_name = $row['department_name'];
        $returnObj->department_email = $row['department_email'];
        $returnObj->department_contact_number = $row['department_contact_number'];

        $OutputreturnObj[] = $returnObj;
    }
    print(json_encode($OutputreturnObj));
}



?>