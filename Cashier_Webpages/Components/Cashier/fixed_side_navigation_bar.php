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
    padding-top: 30px;
    border: 2px solid #cdcdcdce;
    border-bottom: 0px;
    border-left: 0px;
    border-top: 0px;

}

.sidenav a {
    padding: 6px 15px 6px 16px;
    text-decoration: none;
    font-size: 1rem;
    color: #000000;
    display: block;
    padding-left: 30px;
}

.sidenav .active_nav {
    background: black;
    color: white;
}

.sidenav a:hover {
    color: #0d2140;
    font-weight: bold;
}
</style>
<script>
if (localStorage.getItem("cashier_id") === null) {
    console.log("Unknown User logged out.");
    localStorage.clear();
    window.location.href = "index.php";
} else {

}
</script>


<!-- Nav Links -->
<div class="sidenav" style="background: white;">
 
    <div class="profile_container" id="view_profile" style="display: flex;flex-wrap: wrap;flex: 30%;background: white;">

        <div style="flex: 0 auto;text-align: center;">
            <img src="././Assets/Images/UC-Logo.png" alt="Avatar"
                style="width: 42px;height: 42px;background: #46A5DB;border-radius: 60px;margin: 0 -10px 0 25px;">
        </div>
        <div style="flex: 50%;display: flex;flex-wrap: wrap;text-align: left; ">
            <p style="flex:100%;overflow: hidden;color: black;padding: 0;margin:0;font-size: 1.0rem;">
            <a href= "view_profile.php"><b id = "cashier_name" ></b></a>
                <script>
                var cashier_fname = "UNATHORIZED";
                var cashier_lname = "USER";

                //Checks if FirstName Exists in Local Storage
                if (localStorage.getItem("cashier_fname") === null) {
                    //FirstName Local Storage Data Does not Exist
                    cashier_fname = "UNATHORIZED";
                } else {
                    console.log("Cashier FName: " + localStorage.getItem("cashier_fname"));
                    cashier_fname = localStorage.getItem("cashier_fname");
                    //Checks if LastName Exists in Local Storage
                    if (localStorage.getItem("cashier_lname") === null) {
                        //Last Name Local Storage Data Does not Exist
                        cashier_lname = "USER";
                    } else {
                        console.log("Cashier LName: " + localStorage.getItem("cashier_lname"));
                        cashier_lname = localStorage.getItem("cashier_lname");

                        //Sets the Tag with the Admin Name
                        document.getElementById("cashier_name").innerHTML = cashier_fname + " " + cashier_lname;
                    }
                }
                </script>

            </p>
            <p style="flex: 100%;overflow: hidden;color: black;padding-left:30px; 0;margin:0;font-size: 0.9rem;">
             Cashier</p>
        </div>
            
 
    </div>
    </br>
    <a href="cashier_dashboard.php" id="dashboard">Dashboard</a>
    <a href="bill_payment.php" id="payment">Bills Payment</a>
    <a href="cash_in.php" id="cashin">Cash In</a>
    <a href="cash_out.php" id="cashout">Cash Out</a>
    <a href="student_acc.php" id="studentaccount">Student Accounts</a>
    <a href="refund.php" id="refund">Refunds</a>
    <a href="Functions/PHP/generate_receipt.php" id="generate_receipts">Generate Receipt</a>

    <br>

    <script>
    function signOutUser() {
        console.log("User logged out.");
        localStorage.clear();
        window.location.href = "index.php";
    }
    </script>
    <a onclick="signOutUser()">Sign Out</a>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div style="background: white;bottom: 3%;text-align: left;width: 100%;margin: 20% 0;">
        <span style="padding: 0 2px 3px 30px; font-size:15px;">Powered by </span>
        <b style="font-size:17px;color: black" class=" brand">SQUIDEW</b>
    </div>
    <!-- <div style="background: white;bottom: 3%;text-align: left;width: 100%;margin: 20% 0;">
        <span style="padding: 0 8px 6px 30px;">Powered by </span>
        <br><b style="padding: 0 8px 6px 30px;font-size: 1.5rem;color: #287BEE" class=" brand">SQUIDEW</b>
    </div> -->

</div>