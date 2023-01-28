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