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
<div class="sidenav" style="background: white;">

    <div class="profile_container" style="display: flex;flex-wrap: wrap;flex: 30%;background: white;">

        <div style="flex: 0 auto;text-align: center;">
            <img src="././Assets/Images/login_branding_image.svg" alt="Avatar"
                style="width: 42px;height: 42px;background: #46A5DB;border-radius: 60px;margin: 0 15px 0 25px;">
        </div>
        <div style="flex: 50%;display: flex;flex-wrap: wrap;text-align: left;">
            <p style="flex:100%;overflow: hidden;color: black;padding: 0;margin:0;font-size: 1.1rem;">
                <b>Carlsan Kim</b>
            </p>
            <p style="flex: 100%;overflow: hidden;color: black;padding: 0;margin:0;font-size: 1rem;">
                Admin</p>
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

    <a href="#signout">Sign Out</a>

    <!-- <div style="background: white;bottom: 3%;text-align: left;width: 100%;margin: 20% 0;">
        <span style="padding: 0 8px 6px 30px;">Powered by </span>
        <br><b style="padding: 0 8px 6px 30px;font-size: 1.5rem;color: #287BEE" class=" brand">SQUIDEW</b>
    </div> -->

</div>