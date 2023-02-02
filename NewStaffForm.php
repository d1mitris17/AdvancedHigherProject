<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
    <script defer src="form_validation_NewStaffForm.js"></script>
</head>
<body>

    <div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="BookAppointment.php">Book an Appointment</a>
        <a href="show_conflicts.php">Show Conflicts</a>
        <a href="NewPatientAccountForm.php">Add Patient</a>
        <a class='active' href="NewStaffForm.php">Add Hospital Staff</a>
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
    
    <div class="addEntry">
        <div class="container">
        <form action="NewStaffForm.php" method="POST" id="form">
            <input name="name" type="text" placeholder="Name" id="name">
            <input name="surname" type="text" placeholder="Surname" id="surname">
            <br><br>
            <input name="username" type="text" placeholder="Username" id="username">
            <input type="password" name="password" placeholder="Password" id="password">
            <br><br>
            <input name="dob" type="date" placeholder="Date Of Birth" max="2023-12-31" id="dob">           
            <input type="text" placeholder="Employee Type" name="type" id="type">
            <br><br>
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br><br>
            <input type="submit" name="Register2" id="Register" value="Register">
        </form>
        </div>
        <div id="error"></div>

    </div>

    <?php
    include 'connect_to_db.php';
    
    if(isset($_POST['Register2'])) {
        

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $dob = $_POST['dob'];
        $pword = $_POST['password'];
        $sex = $_POST['sex'];
        $type = $_POST['type'];
        $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);

        $sql_query = "INSERT INTO staff(Pword, Fname, Surname, Username, DateofBirth, Sex, StaffType) VALUES(?, ?, ?, ?, ?, ?, ?);";

        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("sssssss", $hashed_pword, $name, $surname, $username, $dob, $sex, $type);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $conn->close();
            header('Location: home.php');
            exit();
        } else{
            $conn->close();
            header('Location: NewStaffForm.php');
            exit();
        }

    }
    ?>
</body>
</html>