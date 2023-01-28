<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<head>
    <title>Profile</title>
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
        <a href="home.php">Home</a>
        <a class='active' href="profile.php">Profile</a>
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

    <div class="profilecontainer">
    <?php
    include 'connect_to_db.php';

    $pk = $_SESSION['pk'];

    $sql_query = "SELECT Fname, Surname, Username, DateofBirth, Sex FROM staff WHERE Staff_ID=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $pk);

    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($Fname, $Surname, $Username, $DateofBirth, $Sex);

    if($stmt->num_rows == 1) {
        $stmt->fetch();
        echo '<div id="update-form">
        <button id="EditBut" class="float-left submit-button" >Edit</button>
        <script type="text/javascript">
        document.getElementById("EditBut").onclick = function () {
        location.href ="EditableProfile.php";
        };
        </script>
        <h1>Profile Details</h1>
        <form action="" method="POST">
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" value="'.$Fname.'" disabled>
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" value="'.$Surname.'" disabled>
        <br><br>
        <label for="Username">Username: </label>
        <input type="text" name="Username" value="'.$Username.'" disabled>
        <br><br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" value="'.$DateofBirth.'" disabled>
        <br><br>
        <label for="Sex">Sex: </label>
        <select name="Sex" disabled>
            <option value=" ">'.$Sex.'</option>
       </select>
       <br>
       <input type="submit" id="UpdateDis" value="Update" name="update" disabled>
        </form>
        </div>';
        } else{
            // error
            header('Location: signout.php');
            exit();
        }
        
    ?>
    </div>
</body>
</html>