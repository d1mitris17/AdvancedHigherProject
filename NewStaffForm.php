<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <ul class="nav-bar">
        <li><a href="home.php"><img src="images/logo.png" alt="logo"></a></li>
        <li><a id="link" href="profile.php">Profile</a></li>
        <li><a id="link" href="BookAppointment.php">Book an Appointment</a></li>
        <li><a id="link" href="show_conflicts.php">Show Conflicts</a></li>
        <li><a id="link" href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a id="link" href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a id="link" href="signout.php">Sign Out</a></li>
    </ul>   
    
<div class="details-form">
        <form action="NewStaffForm.php" method="POST">
            <input name="name" type="text" placeholder="Name" required>
            <input name="surname" type="text" placeholder="Surname" required>
            <br><br>
            <input name="username" type="text" placeholder="Username" required>
            <input name="dob" type="date" placeholder="Date Of Birth" max="2023-12-31" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" required >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br><br>
            <input type="text" required placeholder="Employee Type" name="type">
            <input type="submit" name="Register2" id="Register" value="Register">
        </form>
    </div>

    <?php
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";


    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

    if(mysqli_connect_errno()){
        die("Failed to connect".mysqli_connect_errno());
    }
    
    if(isset($_POST['Register2'])) {
        

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $pword = $_POST['password'];
    $sex = $_POST['sex'];
    $type = $_POST['type'];

    $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);

    $sql_query = "INSERT INTO staff(Pword, Fname, Surname, Username, DateofBirth, Sex, StaffType) VALUES('$hashed_pword','$name','$surname','$username','$dob','$sex', '$type');";

    if(mysqli_query($connection, $sql_query)){
        mysqli_close($connection);
        header('Location: home.php');
    } else{
        mysqli_close($connection);
        header('Location: home.php');
    }


    }
    ?>
</body>
</html>