<?php

$user = $POST_["user"];
$password = $POST_["password"];

        $server_name = "xoooomautospafleet.com";
        $db_username = "ztcanrtj_xooom";
        $db_password = "wM9a3.A?UW-v";
        $db_name = "ztcanrtj_test_xoooom";

        //Connections: You can use '$connection' or '$conn' the later is shorter.
        $connection = mysqli_connect($server_name, $db_username, $db_password);
        $conn = mysqli_connect($server_name, $db_username, $db_password);
        
        $dbconfig = mysqli_select_db($connection,$db_name);

        if($dbconfig){  
             //echo 'Connected to Database';
            $query = "select * from student where student_id ='".$user."' and password ='".$password."';";
            $run_query = mysqli_query($connection, $query);
            $return_query = mysqli_num_rows($run_query) > 0;

            if($return_query){
                echo 'true';
            }else{
                echo 'false';
            }

        }else{
             echo 'Unable to connect to database;';
        }

?>
