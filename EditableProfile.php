<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav-bar">
        <a href="home.php"><img src="images/logo.png" alt="logo"></a>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="BookAppointment.php">Book an Appointment</a></li>
            <li><a href="Prescriptions.php">Prescriptions</a></li>
            <li><a href="NewPatientAccountForm.php">Add Patient</a></li>
            <li><a href="NewStaffForm.php">Add Hospital Staff</a></li>
            <li><a href="signout.php">Sign Out</a></li>
        </ul>    
    </div>

    <div id="details">
    <?php
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";
    $pk = $_SESSION['pk'];
    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
    $sql_query = "SELECT * FROM staff WHERE Staff_ID='$pk'";
    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);
        echo '<form action="UpdateEntry.php" id="update-form" method="POST">
        <input type="text" name="Fname" value="'.$row['Fname'].'" required>
        <br><br>
        <input type="text" name="Surname" value="'.$row['Surname'].'" required>
        <br><br>
        <input type="email" name="EmailAddress" value="'.$row['EmailAddress'].'" required>
        <br><br>
        <input type="text" name="Pword" value="'.$row['Pword'].'" required>
        <br><br>
        <input type="date" name="DateOfBirth" value="'.$row['DateofBirth'].'" required>
        <br><br>
        <select name="Sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br><br>
        <input type="submit" value="Update" name="update">
        </form>';
        
        } else{
            header('Location: home.php');
        }
        
    ?>


    </div>
</body>
</html>