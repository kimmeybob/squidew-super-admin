<?php 

 $student_id = $_POST["student_id"];
 $firebase_conversation_link = $_POST["firebase_conversation_link"];



//Test Data
// $student_id = "18000002";
// $firebase_conversation_link = "afjewijklfmew-asmd1";


require '../../Database Settings/database_access_credentials.php';

$delete_conversation_query = "delete from message where conversation_link = '". $firebase_conversation_link."' and sender_id = '".$student_id."'";    
$run_delete_conversation_query = mysqli_query($connection, $delete_conversation_query);


?>