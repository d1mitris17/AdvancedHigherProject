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
        echo '<div id="update-form">
        <button id="myButton" class="float-left submit-button" >Edit</button>
        <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
        location.href = "EditableProfile.php";
        };
        </script>
        <form action="UpdateEntry.php" method="POST">
        <input type="text" name="Fname" value="'.$row['Fname'].'" disabled>
        <br><br>
        <input type="text" name="Surname" value="'.$row['Surname'].'" disabled>
        <br><br>
        <input type="email" name="EmailAddress" value="'.$row['EmailAddress'].'" disabled>
        <br><br>
        <input type="text" name="Pword" value="'.$row['Pword'].'" disabled>
        <br><br>
        <input type="date" name="DateOfBirth" value="'.$row['DateofBirth'].'" disabled>
        <br><br>
        <select name="Sex" disabled>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </form>
    </div>';
        } else{
            header('Location: home.php');
        }
        
    ?>


    </div>
</body>
</html>