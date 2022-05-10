<?php

$student_id = $_POST["student_id"];

//Test Data
//$student_id = '18000002';

require '../../Database Settings/database_access_credentials.php';

$query_fetch_student_conversation = "select * from message where sender_id = '".$student_id."' OR receiver_id = '".$student_id."' ORDER BY message_id DESC";
$run_query = mysqli_query($connection, $query_fetch_student_conversation);



while($row = mysqli_fetch_assoc($run_query)){
  //   echo $row['message_id']." Sender: ".$row['sender_id']."<br>";
   //  echo $row['message_id']." Receiver: ".$row['receiver_id']."<br>";

    //Reset Return Object
    $returnObj = new stdClass();

    $returnObj->message_id = $row['message_id'];
    $returnObj->conversation_link = $row['conversation_link'];

    if($row['sender_id'] == $student_id){

        $returnObj->recipient_id = $row['receiver_id'];
        $inner_query = "select * from students_profile inner join profile_image on students_profile.student_id = profile_image.student_id where students_profile.student_id = '".$row['receiver_id']."'";
        $run_inner_query = mysqli_query($connection, $inner_query);

        while($inner_row = mysqli_fetch_array($run_inner_query)){
            $returnObj->recipient_name = $inner_row['first_name']." ".$inner_row['last_name'];
            $returnObj->profile_image = $inner_row['profile_image'];
        }

    }else{

        $returnObj->recipient_id = $row['sender_id'];
        $inner_query = "select * from students_profile inner join profile_image on students_profile.student_id = profile_image.student_id where students_profile.student_id = '".$row['sender_id']."'";
        $run_inner_query = mysqli_query($connection, $inner_query);

        while($inner_row = mysqli_fetch_array($run_inner_query)){
            $returnObj->recipient_name = $inner_row['first_name']." ".$inner_row['last_name'];
            $returnObj->profile_image = $inner_row['profile_image'];
        }

    }

    //Return Loop
    $OutputreturnObj[] = $returnObj;
}

// echo "<br><br><br><br><br>";
print(json_encode($OutputreturnObj));

?>