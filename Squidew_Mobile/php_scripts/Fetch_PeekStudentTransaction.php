<?php

//$student_id = $_POST["student_id"];

//Test Data
$student_id = "18000019";

require '../../Database Settings/database_access_credentials.php';



$query_fetch_student_transaction = "Select t.transaction_id, t.transaction_amount, t.transaction_date,
t.transaction_status, t.transaction_status, t.transaction_type, 
pt.receiver_id as p_receiver_id, pt.sender_id as p_sender_id, ct.receiver_id as c_receiver_id, ct.cashier_id as c_sender_id, 
crt.sender_id as crt_receiver_id, crt.sender_id as crt_sender_id,
bt.sender_id as b_receiver_id, bt.sender_id as b_sender_id from transaction as t 
left join peer_transaction as pt on t.transaction_id = pt.transaction_id
left join cashier_transaction as ct on t.transaction_id = ct.transaction_id
left join credits_transaction as crt on t.transaction_id = crt.transaction_id
left join bills_transaction as bt on t.transaction_id = bt.transaction_id order by t.transaction_id desc";
$run_query_fetch_transaction = mysqli_query($connection, $query_fetch_student_transaction);

//Details for Transactions

while($initial_row = mysqli_fetch_array($run_query_fetch_transaction)){
    $transaction_type = $initial_row['transaction_type'];


    if($transaction_type == "0"){
        //Peer-To-Peer: SQUIDEW Peer-to-Peer Money Transfer Transaction

        if($initial_row['p_receiver_id'] == $student_id || $initial_row['p_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];
            $returnObj->sender_id = $initial_row['p_receiver_id'];
            $returnObj->receiver_id = $initial_row['p_sender_id'];

            //Return Loop
            $OutputreturnObj[] = $returnObj;

        }

    }else if($transaction_type == "1"){
        //BILLS: Bills Paid with GCASH
        
        if($initial_row['b_receiver_id'] == $student_id || $initial_row['b_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];
            $returnObj->sender_id = $initial_row['b_receiver_id'];
            $returnObj->receiver_id = $initial_row['b_sender_id'];

            //Return Loop
            $OutputreturnObj[] = $returnObj;

        }
    }else if($transaction_type == "2"){
        //Cashier: Cash-In via Physical Campus CASHIER

        if($initial_row['c_receiver_id'] == $student_id || $initial_row['c_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];   
            $returnObj->sender_id = $initial_row['c_receiver_id'];
            $returnObj->receiver_id = $initial_row['c_sender_id'];


            //Return Loop
            $OutputreturnObj[] = $returnObj;

        }
    }else if($transaction_type == "3"){
        //Cashier: Cash-Out Via Physical Campus CASHIER
        
        if($initial_row['c_receiver_id'] == $student_id || $initial_row['c_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];    
            $returnObj->sender_id = $initial_row['c_receiver_id'];
            $returnObj->receiver_id = $initial_row['c_sender_id'];

            //Return Loop
            $OutputreturnObj[] = $returnObj;
        }
        
    }else if($transaction_type == "4"){
        //BILLS: Bills Paid with SQUIDEW 

        if($initial_row['b_receiver_id'] == $student_id || $initial_row['b_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];        
            $returnObj->sender_id = $initial_row['b_receiver_id'];
            $returnObj->receiver_id = $initial_row['b_sender_id'];

            
            //Return Loop
            $OutputreturnObj[] = $returnObj;

        }
    }else if($transaction_type == "5" ){
        //Cash In: Cash In Via GCash
        //echo 'Has a Gcash Cash In Transaction!';

        if($initial_row['crt_receiver_id'] == $student_id || $initial_row['crt_sender_id'] == $student_id){

            //Reset Return Object
            $returnObj = new stdClass();

            //Return Obj
            $returnObj->transaction_id = $initial_row['transaction_id'];
            $returnObj->transaction_amount = $initial_row['transaction_amount'];
            $returnObj->transaction_date = $initial_row['transaction_date'];
            $returnObj->transaction_status = $initial_row['transaction_status'];
            $returnObj->transaction_type = $initial_row['transaction_type'];        
            $returnObj->sender_id = $initial_row['crt_receiver_id'];
            $returnObj->receiver_id = $initial_row['crt_sender_id'];
            
            //Return Loop
            $OutputreturnObj[] = $returnObj;   
        }   
    }else{
        //echo 'empty set';
    }

}

print(json_encode($OutputreturnObj));


?>