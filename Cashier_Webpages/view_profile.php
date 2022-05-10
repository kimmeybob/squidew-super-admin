<?php
//Default_Style_Links 
require 'Router/Style_Links/links.php';
require 'Components/Cashier/header.php';
//Font
require 'Assets/Fonts/Robot_Regular_Web_Import.php';
//Main Links
require 'Router/Page_Links/main_links.php';
//Database Connection
require 'Database Settings/database_access_credentials.php';

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $default_header_style_link;?>" type="text/css" />
    <link rel="stylesheet" href="Styles/Cashier_side/view_profile_style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo $robot_reg_link;?>" rel="stylesheet">


    <!-- JQuery Specific Version for this Page. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
.query_sidenav {
  border: 2px solid #cdcdcdce;
  border-bottom: 0px;
  border-right: 0px;
  border-top: 0px;
}

@media screen and (max-width: 700px) {
  /* .sidenav {
      visibility: collapse;
    } */
  .body_container,
  .sidenav {
    /* flex-direction: column; */
  }
}
<style>
* {
  box-sizing: border-box;
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  height: 25px;
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}
input[type=submit] {
  background-color: #3A72E8;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}
input[type=submit]:hover {
  background-color:;
}
.containerform {
border-radius: 5px;
  background-color:;
  padding: 5px;
  height: 100%;
}

.col-25 {
  float: left;
  font-size:12px;
  width: 30%;

}
.col-75 {
  float: right;
  width: 70%;
  font-size:12px;
  padding-top:12px;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}


.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}


@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #0E203F;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 2px;
  height: 3%;
  background-color: #0E203F;
  color: white;
}
</style>
       </style>
</head>
<body>
<div class="body_container" style="display: flex;margin: 0 5% 0 0;">

<!-- Side Navigation -->
        <div class="side_nav_container" style="width: 240px;">
             <?php 
                require 'Components/Cashier/fixed_side_navigation_bar.php';
             ?>

        </div>

   
<div name = "container" id = "container" class="container" style = " padding-top:50px; width: 400px; background:white; ">

    <div class="profile" id = "profile" >
        <?php
            $select = mysqli_query($conn, "SELECT *,cashier_account.contact_number as contact_number FROM `cashier_account` inner join hei on hei.hei_id = cashier_account.hei_id WHERE cashier_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select) > 0){
                $fetch = mysqli_fetch_assoc($select);
            }
            
                echo '<img src="././Assets/Images/UC-Logo.png" alt="Avatar"
                style="width: 80px;height: 8 0px;background: #46A5DB;border: 2px solid gray; border-radius: 80px;   display: block;
                margin-left: auto;
                margin-right: auto;">';
            
        ?>
            <div style="width:400px; height:50px;  text-align:center; ;">
                    <p><b><?php echo $fetch['first_name'].' '.$fetch['last_name']; ?></b>
                     <p style="color:black;">Cashier 00000<?php echo $fetch['cashier_id']; ?>
            </div>
        
            <br>
        <div style="padding-left:15px;padding-right:15px; ">
                <h4 style="text-align:center;">---------------------------  Account Details  --------------------------</h4>
                 <div style="text-align:left">

                 <div class="row">
                             <div class="col-25">
                                <label >Name:</label>
                            </div>
                            <div class="col-75">
                            <?php echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'].' '.$fetch['suffix']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label >University:</label>
                            </div>
                            <div class="col-75">
                            <?php echo $fetch['hei_name']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Email Address :</label>
                            </div>
                            <div class="col-75">
                            <td><?php echo $fetch['email']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Contact number :</label>
                            </div>
                            <div class="col-75">
                            <?php echo $fetch['contact_number']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Home Address :</label>
                            </div>
                            <div class="col-75">
                            <?php echo $fetch['home_address']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Username:</label>
                            </div>
                            <div class="col-75">
                            <?php echo $fetch['username']; ?>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Password:</label>
                            </div>
                            <div class="col-75">
                            <?php 

                           $display_pass = "";

                            for($i=0;$i<strlen($fetch['password']);$i++){
                                $display_pass =  $display_pass."*";
                            }echo $display_pass;
                            

                            ?>
                            </div>
                        </div>
                        </div>
                 <button
                    style="flex: auto;font-size:0.9rem;background: #3A72E8;border: none;padding: 3% 10% 3% 10%;color: white; display: block;
                margin-left: auto;
                margin-right: auto;"
                    onclick="edit_cashier_details('<?php echo $fetch['cashier_id']; ?>','<?php echo $fetch['first_name'];?>', '<?php echo $fetch['middle_name']; ?>', '<?php echo $fetch['last_name']; ?>', '<?php echo $fetch['suffix']; ?>', '<?php echo $fetch['email']; ?>', '<?php echo $fetch['username']; ?>', '<?php echo $fetch['password']; ?>', '<?php echo $fetch['contact_number']; ?>', '<?php echo $fetch['home_address']; ?>');">
                    Update Account Profile 
                </button>
        </div>     
        </table>
      
             </div><br><br><br><br>

 
            <!-- report and feedback modal -->
            <button onclick="document.getElementById('reportModal').style.display='block'" style="flex: auto;font-size:0.8rem;background: #3A72E8;border: none;color: white; display: block;
                margin-left: auto; margin-right: auto; width: 100%; height: 50px; text-align:left; padding-left:10px;">Report & Feedback</button>
            <div id="report_feedback_modal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
            <span class="close">&times;</span>
            <div style="flex: auto;font-size:1rem;background: #3A72E8; border: none;color: white; display: block;
                margin-left: auto; margin-right: auto; width: 100%; height: 35px; text-align:center; padding-top:20px; ">Report & Feedback</div>     
                <div class="containerform">
                    <form action="/action_page.php">
                        <div class="row">
                            <div class="col-25">
                                 <label for="report_type">Report Type</label>
                            </div>
                             <div class="col-75">
                                 <input type="text" id="report_type" name="report_type" placeholder="Eg. Account Issue">
                             </div>
                        </div>

                        <div class="row">
                             <div class="col-25">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-75">
                                <textarea id="description" name="description" placeholder="Write your report here..." style="height:200px"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" >
                            <input type="submit" value="Send Report & Feedback">
                        </div>
                    </form>
                </div>
            </div>

         </div>
    </div>

                <script>
                // Get the modal
                var modal = document.getElementById("report_feedback_modal");

                // Get the button that opens the modal
                var btn = document.getElementById("report_feedback");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                modal.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                }
                </script>

<!-- update profile modal -->
<div id="sidebar_modal_container_add" style="z-index: 2;  display: none; flex-wrap: wrap;position: flex; ">
    <div id="outer_modal" style="opacity: 1.45;flex:auto;  "onclick="closeModal();">
    </div>
    <div style="right: 400px;width: auto;position: fixed;z-index: 2;" onclick="closeModal();">
        <div style="padding: 0.6rem 0.9rem;">
            <i class="fa-solid fa-xmark" style="color: blue;font-size: 1.2rem;"></i>
        </div>
        <div style="background: #ADADAD;opacity: 90.45;">
        </div>
    </div>
<div style=" width: 100%; height: 92.35%; ">
    <div style="flex: auto;font-size:1rem;background: #3A72E8; border: none;color: white; display: block;
                margin-left: auto; margin-right: auto; width: 100%; height: 35px; text-align:center; padding-top:20px; ">Update Profile</div>     
                
        <div id="sidebar_modal_add" style= " height: 100%;background: white;z-index: 2;width: 400px;display: flex;box-shadow: 0 0 10px rgba(0, 0, 0, 0.35);display: flex;flex-wrap: wrap;">
            
                
            <form method="POST" id="createForm" style="display: block;height: 100%; width:100%;margin: 15px;font-weight: bold;font-size: 1rem;text-align: left;">
            <div style="display: flex;flex-wrap: wrap;width:100%;">
            
                    <div class="row">
                        <div class="col-25">
                        <label for="university">Cashier ID No. </label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_cashier_id" id="edit_cashier_id" minlength="3" maxlength="50"
                    name="edit_cashier_id" value="<?php echo $fetch['cashier_id']; ?>" value="DEFAULT_ID" style="border:none;" readonly />
                        </div>
                    </div>
            </div>
            <div class="containerform">
                    <div class="row">
                        <div class="col-25">
                        <label for="university">University</label>
                        </div>
                        <div class="col-75">
                            <input type ="text" class="edit_hei" value ="<?php echo $fetch['hei_name'];?>" id="edit_hei" style="color: gray;" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">First Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="edit_cashier_fname" id="edit_cashier_fname" minlength="3" maxlength="50" name="edit_cashier_fname" placeholder="e.g. First Name"
                              required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="mname">Middle Name</label>
                        </div>
                        <div class="col-75">
                             <input type="text" class="edit_cashier_mname" id="edit_cashier_mname" minlength="3" maxlength="50" name="edit_cashier_mname" placeholder="e.g. Middle Name"
                              required />
            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="Lname">Last Name</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_cashier_lname" id="edit_cashier_lname" minlength="3" maxlength="50" name="edit_cashier_lname" placeholder="e.g. Last Name"
                              required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="suffix">Suffix</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_suffix" id="edit_suffix" minlength="3" maxlength="50" name="edit_suffix" placeholder="e.g. I, II, II, JR. SR."
                              required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_email" id="edit_email" minlength="3" maxlength="50" name="edit_email" placeholder="e.g. cashier@squidew.com"
                              required />
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-25">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_location" id="edit_location" minlength="3" maxlength="50" name="edit_location" placeholder="e.g. XXXXXXXXXXX"
                            required />
                        </div>
                    </div>                
                     <div class="row">
                        <div class="col-25">
                            <label for="address">Contact No.</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_contact_number" id="edit_contact_number" minlength="3" maxlength="50" name="edit_contact_number" placeholder="e.g. XXXXXXXXXXX"
                             >
                        </div>
                    </div>
                                    
                     <div class="row">
                        <div class="col-25">
                            <label for="usename">Username</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_username" id="edit_username" minlength="6" maxlength="50" name="edit_username" placeholder="username" value=""
                              disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-75">
                        <input type="text" class="edit_password" id="edit_password" minlength="6" maxlength="50" name="edit_password" placeholder="password" autocomplete="new-password" value=""
                              required />
                        </div>
                    </div>
           <br>
           <br>
        
            <input type="button" value="Submit" id="edit_new_profile_btn"
                style="background: #2C71EC;width: 70%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 5px;margin: 0 15% 0 15%;" />
            </br>
            </br> 
            </div> 
            <br><br>
        </form>
                    
        </div>

    </div>
</div>
<div id="reportModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="document.getElementById('reportModal').style.display='none'">&times;</span>
      <h2>Report & Feedback</h2>
    </div>
    <div class="modal-body">
     
    <div
        style="margin: 1rem 1.2rem 2% 1.2rem;font-size: 1rem;font-weight: normal;text-align: center;display: flex;flex-wrap: wrap;">
        
        <form id= "report_form" style="width:80%; padding: 10px 10px;">
        <div style="flex: 40%;text-align: left;font-weight: bold;">
            Title:
        </div>
        <input type="text" class="report_title" id="report_title" minlength="3"
                            maxlength="50" name="report_title" placeholder="Error in xxxxxx"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br><br>
    
        <div style="flex: 40%;text-align: left;font-weight: bold;">
            Email Address:
        </div>
        <input type="text" class="reporter_email" id="reporter_email" minlength="3"
                            maxlength="50" name="reporter_email" placeholder="reporter@squidew.com"
                            style="border: none;margin: 10 0 10 0;width: 100%;font-size: 1.1rem;border: 1px solid #ADADAD;font-weight: normal;padding: 5px 0px 5px 10px"
                            required />
                        <br><br>
         <div style="flex: 40%;text-align: left;font-weight: bold;">
            Description :
        </div>
                        <textarea id="report_description" name="report_description" class = "report_description" placeholder ="Report Description...." rows="4" cols="50" style="font-size: 20px;resize:none; width:100%; height:50%;"></textarea>
  <br><br>
    <input type="button" value="Submit" id="send_report"
                            style="background: #2C71EC; float:left; width: 15%;border: none;font-size: 1rem;padding: 10px;color: white;border-radius: 20px;" />
                            <br><br><br><br>
                       <br>    <br>     
    <!-- close div-->
        </div>



</form>
                      

        
        
   



    </div>
    <div class="modal-footer">
    <span style="padding: 0 2px 3px 30px; font-size:15px;">Powered by </span>
        <b style="font-size:17px;color: white" class=" brand">SQUIDEW</b>
    </div>
  </div>

</div>

</body>
<script>
const reportbtn = document.querySelector('#send_report');

reportbtn.addEventListener('click', function(e) {

e.preventDefault();
  
if(document.getElementById("report_title").value ==""){
            alert("Error: Title Field cannot be empty! Please try again...");    
        }
    else if(document.getElementById("reporter_email").value ==""){
            alert("Error: Email Field cannot be empty! Please try again...");    
        } 
    else if(document.getElementById("report_description").value ==""){
            alert("Error: Report Description Field cannot be empty! Please try again...");    
        }  
    else{           
            submitReport();
    }

})


function submitReport() {

                       //Add trapping
                       $.ajax({
                           url: 'Functions/PHP/send_report.php',
                           type: 'post',
                           data: {

                               title: $(".report_title").val(), 
                               email: $(".reporter_email").val(), 
                               description: $(".report_description").val(), 



                           },
                           success: function(result) {
                               alert("Successfully sent a report. Thank you for getting in touch. We will respond to you very soon. ")
                               document.getElementById('reportModal').style.display='none'
                               console.log("Successfully sent a report.");
                               console.log($(".report_title").val());
                               console.log($(".reporter_email").val());
                               console.log($(".report_description").val());
                               report_form.reset();
                               //display loader
                               // $(".hei_details_container").load(" .hei_details_container");
                               // $(".main_data_container").load(" .main_data_container");

                           },
                           error: function(data) {
                               alert("error occured" + data); //===Show Error Message====

                           }

                       });
                   }

</script>



<script>

function openModal() {
    sidebar_modal_container_add.style.display = "flex";
}

function closeModal() {
    sidebar_modal_container_add.style.display = "none";
}






function submitUpdateRecord() {
    
    console.log("Entered SubmitUpdateRecord()");
    //Add trapping
    $.ajax({
        url: 'Functions/PHP/update_cashier_account.php',
        type: 'post',
        data: {


            edit_cashier_id: $(".edit_cashier_id").val(),
            edit_cashier_fname: $(".edit_cashier_fname").val(),
            edit_cashier_mname: $(".edit_cashier_mname").val(),
            edit_cashier_lname: $(".edit_cashier_lname").val(),
            edit_cashier_location: $(".edit_location").val(),
            edit_cashier_email: $(".edit_email").val(),
            edit_cashier_contact: $(".edit_contact_number").val(),
            edit_cashier_suffix: $(".edit_suffix").val(),
            edit_cashier_username: $(".edit_username").val(),
            edit_cashier_password: $(".edit_password").val(),
            
     
           
        },
        success: function(result) {
            closeModal();
            reload();
            //display loader
            document.getElementById("top_bar_loader").style.display = "none";
            $(" .profile").load(" .profile");
            // $(".hei_details_container").load(" .hei_details_container");
            // $(".main_data_container").load(" .main_data_container");
            // createForm.reset();
        },
        error: function(data) {
            alert("error occured" + data); //===Show Error Message====
        }

    });
}
function edit_cashier_details(cashier_id,first_name, middle_name, last_name,suffix, email, username, password, contact, address) {

openModal();
document.getElementById("edit_contact_number").value = contact;
document.getElementById("edit_username").value = username;
document.getElementById("edit_password").value = password;
document.getElementById("edit_cashier_id").value = cashier_id;
document.getElementById("edit_cashier_fname").value = first_name;
document.getElementById("edit_cashier_mname").value = middle_name;
document.getElementById("edit_cashier_lname").value = last_name;
document.getElementById("edit_suffix").value = suffix;
document.getElementById("edit_email").value = email;
document.getElementById("edit_location").value = address;


}


const edit_btn = document.querySelector('#edit_new_profile_btn');
edit_btn.addEventListener('click', function(e) {

e.preventDefault();
submitUpdateRecord();

})
   </script>

 
</html>