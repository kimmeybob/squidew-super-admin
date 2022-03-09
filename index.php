<?php

//Default_Style_Links 
require 'Router/Style_Links/links.php';
require 'Components/Super_Admin/header.php';
//Font
require 'Assets/Fonts/Robot_Regular_Web_Import.php';
//Main Links
require 'Router/Page_Links/main_links.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $default_header_style_link;?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo $super_admin_style_link;?>" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">

    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>SQUIDEW Super Admin Login Page</title>
</head>
<script>
$(document).ready(function() {
    $("#btn").click(function() {

        if ($("#username").val() == "") {
            $("#result_display").html("Your username is empty.");
        } else if ($("#password").val() == "") {
            $("#result_display").html("Your password is empty.");
        } else {
            $.ajax({
                url: '<?php echo $authenticate_user_function_link;?>',
                type: 'post',
                data: {
                    username: $("#username").val(),
                    password: $("#password").val(),
                },
                success: function(result) {
                    if (result.toString() == "") {
                        $("#result_display").html("Invalid credentials. Please try again.");
                    } else {

                        $("#result_display").html(result.toString());
                    }

                }
            });
        }

    });
});

function checkUserIsSignedIn() {
    if (localStorage.getItem("admin_id") === null) {
        //Do nothing since the user is not yet authenticated
    } else {
        window.location.href = "dashboard.php";
    }
}
</script>

<body>
    <script>
    checkUserIsSignedIn();
    </script>
    <div class="main">

    </div>
    <!-- Branding -->
    <div class="flex-container">
        <div class="branding_sectioning" style="width: 100%;">
            <div class="branding_sectioning_inner_containter">
                <div class="branding_image"></div>
                <span class="branding_tagline">See the difference.</span>
            </div>
        </div>

        <!-- Forms -->
        <div class="bg-text">
            <div class="form_container">
                <!-- <?php echo $authenticate_user_function_link;?> -->
                <form class="login_form" method="POST">
                    <span class="login_title">Login Account</span>
                    <!-- Error Message -->
                    <div class="results_container">
                        <p class="result_display" id="result_display"> </p>
                    </div>
                    <br>
                    <div class="label_holder" style="">Username:</div>
                    <input type="username" minlength="3" id="username" name="username" placeholder="enter your username"
                        required />
                    <br>
                    <br>
                    <div class="label_holder">Password:</div>
                    <input type="password" minlength="6" id="password" name="password" placeholder="enter your password"
                        required />

                    <div class="forgot_container"><a href="#forgot" id="forgot_password">Forgot Password?</a></div>
                    <br>
                    <br>
                    <br>
                    <input type="button" value="Login" id="btn" />

                </form>
            </div>
            <div class="branding_form_container">
                <span class="branding_footer_form">Powered By <b>SQUIDEW</b></span>
            </div>
        </div>



</body>


</html>