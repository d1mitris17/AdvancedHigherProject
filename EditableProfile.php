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
        <form action="EditableProfile.php" method="POST">
        <h1>Profile Details</h1>
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" value="'.$row['Fname'].'" required>
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" value="'.$row['Surname'].'" required>
        <br><br>
        <label for="Username">Username: </label>
        <input type="text" name="Username" value="'.$row['Username'].'" required>
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
        </form>
        <button id="CancelBut" class="float-left submit-button">Cancel</button>
        <script type="text/javascript">
        document.getElementById("CancelBut").onclick = function () {
        location.href="profile.php";
        };
        </script>
        </div>';
        
        
        } else{
            header('Location: home.php');
        }
        
    ?>
<?php

    if(isset($_POST['update'])) {
        $Fname = $_POST['Fname'];
        $Surname = $_POST['Surname'];
        $Username = $_POST['Username'];
        $Pword = $_POST['Pword'];
        $DateofBirth = $_POST['DateOfBirth'];
        $Sex = $_POST['Sex'];
        $pk = $_SESSION['pk'];
        $sql_query = "UPDATE staff SET Fname='$Fname', Surname='$Surname', Username='$Username', Pword='$Pword', DateOfBirth='$DateofBirth', Sex='$Sex' WHERE Staff_ID = $pk";
        if(mysqli_query($connection, $sql_query)){
            $_SESSION['Name'] = $Fname;
            echo '
        <script>
            window.alert("Details have been modified successfully")
        </script>';
            header('Location: profile.php');
        } else{
            header('Location: index.php');
        }
    }


?>
</body>
</html>