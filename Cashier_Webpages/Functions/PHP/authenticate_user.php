<?php

//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';

session_start();

//-----> Form Data

$Username = "";
$Password = "";

if(isset($_POST['username']) AND isset($_POST['password'])){
    $Username = $_POST['username'];
    $Password = $_POST['password'];
}else{
    echo "No credentials submitted.";
    ?>
<meta http-equiv="refresh" content="0; url=<?php echo $index_login_page_from_auth_page;?>" />
<?php
}



// echo "Username: ".$Username."<br>Password: ".$Password;

//-----> Authentication PHP function

$query = "select * from cashier_account";
$run_query = mysqli_query($connection,$query);
$return_request_from_run_query = mysqli_num_rows($run_query) > 0;
$display = "";
while($row = mysqli_fetch_array($run_query)){
    // echo $row['first_name'];
    if($Username == $row['username'] AND $Password == $row['password']){
        $display = "Logging in...";
        $_SESSION['user_id'] = $row['cashier_id'];
        $_SESSION['hei_id'] = $row['hei_id'];
        
        
    ?>
    <script>
    //LocalStorage Data for User Credentials
    localStorage.setItem("cashier_id", "<?php echo $row['cashier_id']?>");
    localStorage.setItem("cashier_fname", "<?php echo $row['first_name']?>");
    localStorage.setItem("cashier_mname", "<?php echo $row['middle_name']?>");
    localStorage.setItem("cashier_lname", "<?php echo $row['last_name']?>");
    localStorage.setItem("cashier_suffix", "<?php echo $row['suffix']?>");
    localStorage.setItem("hei_id", "<?php echo $row['hei_id']?>");
            
    </script>
        
 <meta http-equiv="refresh" content="0; url=<?php echo $dashboard_from_auth_page;?>" /> 
<?php
    break;
    }else{
        $display = "Invalid credentials. Please try again.";
       
    }

}

 echo $display;
// if(){

// }
?>