<?php
        $server_name = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "squidew";

        //Domain / Localhost IP
        $domain_link = "192.168.254.101";

        //Connections: You can use '$connection' or '$conn' the later is shorter.
        $connection = mysqli_connect($server_name, $db_username, $db_password);
        $conn = mysqli_connect($server_name, $db_username, $db_password);
        
        $dbconfig = mysqli_select_db($connection,$db_name);

        if($dbconfig){
             //echo 'Connected to Database';
        }else{
             //echo 'Unable to connect to database;';
        }

?>