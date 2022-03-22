<?php

$user = $_POST["user"];
$password = $_POST["password"];

        $server_name = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "squidew";

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
                echo 'true';
            }else{
                echo 'false';
            }

        }else{
             echo 'Unable to connect to database;';
        }

?>