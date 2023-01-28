<?php
session_start();
include 'loggedin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
</head>
<body>

    <div class="topnav" id="myTopnav">
        <a class='active' href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="BookAppointment.php">Book an Appointment</a>
        <a href="show_conflicts.php">Show Conflicts</a>
        <a href="NewPatientAccountForm.php">Add Patient</a>
        <a href="NewStaffForm.php">Add Hospital Staff</a>
        <a href="signout.php">Sign Out</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>


    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
    }
    </script>

    <div class="HomeContents">
        <?php
         echo "<h1> Welcome ".$_SESSION['Name']."</h1>"
        ?>
        <div class="container">

            <div class="column">
                <h2>Book Appointments</h2>
                <img src="images/screenshot.png" alt="ex1" height="260rem" width="370rem">
            </div>

            <div class="column">
                <h2>Conflict Detection</h2>
                <img src="images/screenshot.png" alt="ex2" height="260rem" width="370rem">
            </div>

            <div class="column">
                <h2>Add Patients Easily</h2>
                <img src="images/screenshot.png" alt="ex3" height="260rem" width="370rems">
            </div>

        </script>

        </div>
        <div class="container2">
            <button id="myButton" class="center submit-button" >Show me all Appointments</button>
            <script type="text/javascript">
            document.getElementById("myButton").onclick = function () {
            location.href ="AllAppointments.php";
            };
        </div>

       

    </div>
    
</body>
</html>