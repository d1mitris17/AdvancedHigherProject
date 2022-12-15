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
        echo '<div id="update-form">
        <button id="myButton" class="float-left submit-button" >Edit</button>
        <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
        location.href = "EditableProfile.php";
        };
        </script>
        <h1>Profile Details</h1>
        <form action="UpdateEntry.php" method="POST">
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" value="'.$row['Fname'].'" disabled>
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" value="'.$row['Surname'].'" disabled>
        <br><br>
        <label for="Username">Username: </label>
        <input type="text" name="Username" value="'.$row['Username'].'" disabled>
        <br><br>
        <label for="Pword">Password: </label>
        <input type="password" name="Pword" value="'.$row['Pword'].'" disabled>
        <br><br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" value="'.$row['DateofBirth'].'" disabled>
        <br><br>
        <label for="Sex">Sex: </label>
        <select name="Sex" disabled>
            <option value=" ">'.$row['Sex'].'</option>
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