<?php 
//Font
require 'Assets/Fonts/Robot_Regular_Web_Import.php';

?>
<style>
.sidenav {
    height: 100%;
    flex: 100%;
    margin-top: 0%;
    left: 0;
    background-color: white;
    padding-top: 48px;
    border: 2px solid #cdcdcdce;
    border-bottom: 0px;
    border-left: 0px;
    border-top: 0px;

}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 1rem;
    color: #000000;
    display: block;
    padding-left: 30px;
}

.sidenav .active_nav {
    background: #0d2140;
    color: white;
}

.sidenav a:hover {
    color: #0d2140;
    font-weight: bold;
}
</style>


<!-- Nav Links -->
<script>
if (localStorage.getItem("admin_id") === null) {
    console.log("Unknown User logged out.");
    localStorage.clear();
    window.location.href = "index.php";
} else {

}
</script>
<div class="sidenav" style="background: white;">

    <div class="profile_container" style="display: flex;flex-wrap: wrap;flex: 30%;background: white;">

        <div style="flex: 0 auto;text-align: center;">

            <img id="super_admin_profile"
                style="width: 42px;height: 42px;background: white;border-radius: 60px;margin: 0 15px 0 25px;">
            <script>
            var profile_image = localStorage.getItem("admin_profile_image");
            document.getElementById("super_admin_profile").src = profile_image;
            </script>
        </div>
        <div style="flex: 50%;display: flex;flex-wrap: wrap;text-align: left;">
            <p style="flex:100%;overflow: hidden;color: black;padding: 0;margin:0;font-size: 1rem;">
                <b id="admin_name">ADMIN_NAME</b>
                <script>
                var admin_fname = "UNATHORIZED";
                var admin_lname = "USER";

                //Checks if FirstName Exists in Local Storage
                if (localStorage.getItem("admin_fname") === null) {
                    //FirstName Local Storage Data Does not Exist
                    admin_fname = "UNATHORIZED";
                } else {
                    console.log("Admin FName: " + localStorage.getItem("admin_fname"));
                    admin_fname = localStorage.getItem("admin_fname");
                    //Checks if LastName Exists in Local Storage
                    if (localStorage.getItem("admin_lname") === null) {
                        //Last Name Local Storage Data Does not Exist
                        admin_lname = "USER";
                    } else {
                        console.log("Admin LName: " + localStorage.getItem("admin_lname"));
                        admin_lname = localStorage.getItem("admin_lname");

                        //Sets the Tag with the Admin Name
                        document.getElementById("admin_name").innerHTML = admin_fname + " " + admin_lname;
                    }
                }
                </script>

            </p>
            <p id="admin_role" style="flex: 100%;overflow: hidden;color: black;padding: 0;margin:0;font-size: 0.9rem;">
                Developer
            </p>

            <script>
            var admin_status = "UNATHORIZED";
            //Checks Account Status/Role Local Storage
            if (localStorage.getItem("admin_status") === null) {
                admin_status = "UNATHORIZED";
            } else {
                if (localStorage.getItem("admin_status") == "1") {
                    admin_status = "Developer";

                    //Sets the Tag with the Admin Name
                    document.getElementById("admin_role").innerHTML = admin_status;
                } else if (localStorage.getItem("admin_status") == "0") {
                    admin_status = "Guest";

                    //Sets the Tag with the Admin Name
                    document.getElementById("admin_role").innerHTML = admin_status;
                } else {
                    //Add more rolse here.
                }



            }
            </script>
        </div>

    </div>

    <br>
    <br>
    <br>

    <a href="dashboard.php" id="dashboard">Dashboard</a>
    <a href="report_and_feedback.php" id="reports_and_feedback">Reports & Feedback</a>
    <a href="admin_page.php" id="admin_accounts">Admin Accounts</a>

    <br>
    <br>

    <script>
    function signOutUser() {
        console.log("User logged out.");
        localStorage.clear();
        window.location.href = "index.php";
    }
    </script>
    <a onclick="signOutUser()">Sign Out</a>

    <!-- <div style="background: white;bottom: 3%;text-align: left;width: 100%;margin: 20% 0;">
        <span style="padding: 0 8px 6px 30px;">Powered by </span>
        <br><b style="padding: 0 8px 6px 30px;font-size: 1.5rem;color: #287BEE" class=" brand">SQUIDEW</b>
    </div> -->

</div>