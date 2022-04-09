<?php

$student_id = $_POST["student_id"];
$recipient_id = $_POST["recipient_id"];
$hei_id = $_POST["school"];

//Test Data
//$student_id = "18000022";
//$recipient_id = "18000023";
//$hei_id = '210';


require '../../Database Settings/database_access_credentials.php';


//Fetch Sender Details
$query_student_sender_details = "select * from student
inner join students_profile on students_profile.student_id = student.student_id
inner join linked_card on linked_card.student_id = student.student_id
inner join wallet on wallet.wallet_id = linked_card.wallet_id
where student.student_id = '".$student_id."' and wallet.wallet_name = 'SQUIDEW Wallet';";
$run_query_student_sender_details = mysqli_query($connection, $query_student_sender_details);


while($row_user = mysqli_fetch_assoc($run_query_student_sender_details)){
    $jsonresult[] = $row_user;
}

$query_peek_student_id = "select * from student where student_id = '".$recipient_id."' and hei_id = '".$hei_id."';";
$run_query_peek_student_id = mysqli_query($connection, $query_peek_student_id);
$query_result = mysqli_num_rows($run_query_peek_student_id) > 0;

if(!$query_result){
    echo "false";
}else{
    
    //Fetch Receiver Details
    $query_student_receiver_details = "select * from student
    inner join students_profile on students_profile.student_id = student.student_id
    inner join profile_image on profile_image.student_id = student.student_id
    inner join linked_card on linked_card.student_id = student.student_id
    inner join wallet on wallet.wallet_id = linked_card.wallet_id
    where student.student_id = '".$recipient_id."' and wallet.wallet_name = 'SQUIDEW Wallet';";
    $run_query_student_sender_details = mysqli_query($connection, $query_student_receiver_details);

    while($row_recipient = mysqli_fetch_assoc($run_query_student_sender_details)){
        $jsonresult[] = $row_recipient;
    }

    print(json_encode($jsonresult));

}


?>