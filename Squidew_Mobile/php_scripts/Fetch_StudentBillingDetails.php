<?php

 //$student_id = $_POST["student_id"];

 //Test Date
 $student_id = '18000022';


require '../../Database Settings/database_access_credentials.php';
    
        $query = "select * from hei inner join student on student.hei_id = hei.hei_id inner join students_profile on students_profile.student_id = student.student_id inner join student_account_statement on student_account_statement.student_id = student.student_id where student.student_id = '".$student_id."'";
        $run_query = mysqli_query($connection, $query);
        $query_response = mysqli_num_rows($run_query) > 0;
        //echo "Number of Rows: ".$query_response."<br>";

        if($query_response){
            
            if(mysqli_num_rows($run_query) == 1){
                //1 Row only (Display Event though Expired or Not Yet Expired)
               // echo 'Only 1 Billing Row <br>';
                while($row = mysqli_fetch_assoc($run_query)){
                    $jsonresult[] = $row;
                }

            }else{
                //echo 'Multiple Billing Row <br>';
                
                //Multiple rows (Display Non-expired or more recent only)
                    while($row = mysqli_fetch_assoc($run_query)){
                        //Clear Array Variable
                        unset($jsonresult);

                        //echo "active";
                        $jsonresult[] = $row;   
                    } 
            }
            
            //Important to Print all data to be passed.
            print(json_encode($jsonresult));

        }else{
            echo "0";
        } 

            
        // //Due Date Check
        // $startdate = "2022-03-26";
        // $expire = strtotime($startdate. ' +  1 days');

        // $today = strtotime("today midnight");

        // echo $today."\n";
        
        // if($today >= $expire){
        //     echo "expired";
        // } else {
        //     echo "active";
        // }


        
?>