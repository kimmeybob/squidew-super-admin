<?php
//----> Database Connection Credentials
require '../../Database Settings/database_access_credentials.php';
require '../../Router/Page_Links/main_links.php';


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

$query = "select * from admin";
$run_query = mysqli_query($connection,$query);
$return_request_from_run_query = mysqli_num_rows($run_query) > 0;

while($row = mysqli_fetch_array($run_query)){
    // echo $row['first_name'];
    if($Username == $row['username'] AND $Password == $row['password']){
        echo "Logging in...";
        ?>
<meta http-equiv="refresh" content="0; url=<?php echo $dashboard_from_auth_page;?>" />
<?php
    }else{
        echo "Invalid credentials. Please try again.";
    }
}

// if(){

// }
?>