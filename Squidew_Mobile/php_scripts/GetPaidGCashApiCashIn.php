<?php


$student_id = $_POST["student_id"];
$description = $_POST["description"];
//$total_amount = $_POST["total_amount"];
$fee_amount = $_POST["fee_amount"];


//Test Data
//$student_id = "18000021";
//$description = "Billing";
$total_amount = "1.00";
//$fee_amount = "0";


require '../../Database Settings/database_access_credentials.php';

//Fetch Student Necessary Data

$fetch_student_data_query = "select * from student
inner join hei on hei.hei_id = student.hei_id
inner join students_profile on students_profile.student_id = student.student_id
inner join linked_card on linked_card.student_id = student.student_id
inner join wallet on wallet.wallet_id = linked_card.wallet_id
where wallet.wallet_name = 'GCASH' and student.student_id='".$student_id."';";
$run_query = mysqli_query($connection, $fetch_student_data_query);
$query_response = mysqli_num_rows($run_query) > 0;

//Required Variables
$student_name = "";
$student_email = "";
$student_mobile = "";
$hei_name = "";

//Details for Gcash API Checkout Receipt
$returnObj = new stdClass();
$squidew_transaction_id = 0;


if($query_response){

    while($row = mysqli_fetch_array($run_query)){
        $student_name = $row["first_name"]." ".$row["last_name"];
        $student_email = $row['email'];
        $student_mobile = $row['contact_number'];
        $hei_name = $row['hei_name'];
    }
    creatCashinTransaction($domain_link,$total_amount, $fee_amount, $student_id,$connection, $student_name,$student_email,$student_mobile,$student_id,$description,$total_amount,$fee_amount,$hei_name);
    
}else{
    
}

function creatCashinTransaction($domain_link,$bills_total_amount, $bills_fee_amount, $bills_student_id, $connection, $student_name,$student_email,$student_mobile,$student_id,$description,$total_amount,$fee_amount,$hei_name){
  global $returnObj;
  global $squidew_transaction_id;

  $sum_total_amount = bcadd($bills_total_amount, $bills_fee_amount, 2);
  
  $current_date_and_time = date("Y-m-d h:m:s");
  $create_cash_in_transaction_query = "insert into transaction (transaction_amount, transaction_date, transaction_status, transaction_type) values (".$sum_total_amount.",'".$current_date_and_time."','0','5');";

  if(mysqli_query($connection,$create_cash_in_transaction_query)){
    $last_id = mysqli_insert_id($connection);
    $create_cash_in_transaction_query = "insert into credits_transaction (transaction_id,sender_id) values ('".$last_id."','".$bills_student_id."');";

    //Transaction ID
    $returnObj->transaction_id = $last_id.'';
    $squidew_transaction_id = $last_id;

    if(mysqli_query($connection, $create_cash_in_transaction_query)){
      GENERATE_API_LINK($last_id,$domain_link,$student_name,$student_email,$student_mobile,$student_id,$description,$total_amount,$fee_amount,$hei_name);
    }else{
      echo 'false'; 
    }
  }else{
    echo 'false';
  }

}


function GENERATE_API_LINK($last_id,$domain_link,$student_name,$student_email,$student_mobile,$student_id,$description,$total_amount,$fee_amount,$hei_name){
  global $returnObj;  
  global $squidew_transaction_id;
  
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://g.payx.ph/payment_request',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
	'x-public-key' => 'pk_0a8b907482bcd7c96cd6b721ccc5e977',
	'amount' => $total_amount,
	'description' => $description,
    'fee' => $fee_amount,
    'merchantname' => 'SQUIDEW - '.$hei_name,
    'customername' => $student_name,
    'customeremail' => $student_email,
    'customermobile' => $student_mobile,
    'merchantlogurl' => 'https://firebasestorage.googleapis.com/v0/b/squidew-8401a.appspot.com/o/hei_images%2Fsquidewe_academy_logo.png?alt=media&token=799ad567-73f1-40d9-ab95-7fccc6f296bc',
    'webhooksuccessurl' => 'https://'.$domain_link.'/SQUIDEW/Dumps/success.php?transaction_id='.$last_id,
    'webhookfailurl' => 'https://'.$domain_link.'/SQUIDEW/Dumps/failed.php?transaction_id='.$last_id,
    'redirectsuccessurl' => 'https://'.$domain_link.'/SQUIDEW/Dumps/success.php?transaction_id='.$last_id,
    'redirectfailurl' => 'http://'.$domain_link.'/SQUIDEW/Dumps/failed.php?transaction_id='.$last_id,
    "checkouturl" => "https://getpaid.gcash.com/checkout/247d025e78852022936d0b59e6d96d7f",
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$data = json_decode($response, true);

print_r($data['data']['checkouturl']."?squidew_transaction_id=".$squidew_transaction_id);

//API Link 
//$returnObj->api_link = $data['data']['checkouturl'];

//Response and Result
//print(json_encode($returnObj));

//header("Location: ".$data['data']['checkouturl']);
}



?>