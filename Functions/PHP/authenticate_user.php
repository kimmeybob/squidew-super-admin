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

$query = "select * from super_admin_account";
$run_query = mysqli_query($connection,$query);
$return_request_from_run_query = mysqli_num_rows($run_query) > 0;

while($row = mysqli_fetch_array($run_query)){
    // echo $row['first_name'];
    if($Username == $row['username'] AND $Password == $row['password']){
        echo "Logging in...";
        ?>
<script>
//LocalStorage Data for User Credentials
localStorage.setItem("admin_id", "<?php echo $row['super_admin_id']?>");
localStorage.setItem("admin_profile_image", "<?php echo $row['profile_image']?>");
localStorage.setItem("admin_fname", "<?php echo $row['first_name']?>");
localStorage.setItem("admin_mname", "<?php echo $row['middle_name']?>");
localStorage.setItem("admin_lname", "<?php echo $row['last_name']?>");
localStorage.setItem("admin_suffix", "<?php echo $row['suffix']?>");
// localStorage.setItem("admin_status", "<?php //echo $row['account_status']?>");
</script>
<meta http-equiv="refresh" content="0; url=<?php echo $dashboard_from_auth_page;?>" />
<?php
break;
    }else{
  
    }
}

// if(){

// }
?>