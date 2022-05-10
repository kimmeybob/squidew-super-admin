<?php 

$student_id = $_POST["student_id"];
$recipient_id = $_POST["recipient_id"];
$firebase_conversation_link = $_POST['firebase_conversation_link'];



//Test Data
// $student_id = "18000002";
// $recipient_id = "18000003";
// $firebase_conversation_link = "afjewijklfmew-asmd";


require '../../Database Settings/database_access_credentials.php';

$create_conversation_query = "insert into message (conversation_link,receiver_id,sender_id) 
  values ('".$firebase_conversation_link."','".$recipient_id."','".$student_id."');";    
$run_create_conversation_query = mysqli_query($connection, $create_conversation_query);



?>