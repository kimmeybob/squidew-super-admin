<?php

$user = $_POST["user"];
$password = $_POST["password"];

//Test Case
//$user = "18000001";
//$password = "usjrstudent_jamar";

        
        // $server_name = "localhost";
        // $db_username = "root";
        // $db_password = "";
        // $db_name = "squidew";

        require '../../Database Settings/database_access_credentials.php';

        //Connections: You can use '$connection' or '$conn' the later is shorter.
        $connection = mysqli_connect($server_name, $db_username, $db_password);
        $conn = mysqli_connect($server_name, $db_username, $db_password);
        
        $dbconfig = mysqli_select_db($connection,$db_name);

        if($dbconfig){  
             //echo 'Connected to Database';
            $query = "select * from student where student_id = '".$user."' and password ='".$password."';";
            $run_query = mysqli_query($connection, $query);
            $return_query = mysqli_num_rows($run_query) > 0;
            
            if($return_query){
                //Successfully Logged In 

                $Student_Logged_ID = '0';
                while($row = mysqli_fetch_array($run_query)){
                    $Student_Logged_ID = $row['student_id'];
                    
                    //Update student last login
                    $update_student_login_date = "update student set last_login = '".date("Y-m-d")."' where student_id ='".$Student_Logged_ID."'";
                    $run_update_date_query = mysqli_query($connection, $update_student_login_date);
                }
                
                //echo 'true';
                $query_fetch_user_data = "select *, students_profile.contact_number as contact_number, hei.contact_number as hei_contact_number from student 
                inner join students_profile on students_profile.student_id = student.student_id 
                inner join hei on hei.hei_id = student.hei_id 
                inner join degree on degree.degree_id = student.degree_id 
                inner join profile_image on profile_image.student_id = student.student_id 
                inner join linked_card on linked_card.student_id = student.student_id
                inner join wallet on wallet.wallet_id = linked_card.wallet_id where students_profile.student_id = '".$Student_Logged_ID."' and wallet.wallet_name = 'SQUIDEW Wallet';";
                
                $run_query_fetch_user_data = mysqli_query($connection, $query_fetch_user_data);
                
                while($sub_row = mysqli_fetch_assoc($run_query_fetch_user_data)){
                    $jsonresult[] = $sub_row;
                }
                
                //Important to Print all data to be passed.
                print(json_encode($jsonresult));

            }else{
                echo 'false';
            }

        }else{
             echo 'Unable to connect to database;';
        }

?>