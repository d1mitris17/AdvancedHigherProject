<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>Profile</title>
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
        <h1>Profile Details</h1>
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" value="'.$row['Fname'].'" required>
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" value="'.$row['Surname'].'" required>
        <br><br>
        <label for="EmailAddress">Email Address: </label>
        <input type="email" name="EmailAddress" value="'.$row['EmailAddress'].'" required>
        <br><br>
        <label for="Pword">Password: </label>
        <input type="text" name="Pword" value="'.$row['Pword'].'" required>
        <br><br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" value="'.$row['DateofBirth'].'" required>
        <br><br>
        <label for="Sex">Sex: </label>
        <select name="Sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br><br>
        <input type="submit" id="myButton2" value="Update" name="update">
        </form>';
        
        } else{
            header('Location: home.php');
        }
        
    ?>


    </div>
</body>
</html>