<?php
session_start();
include 'loggedin.php';
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
    include 'connect_to_db.php';

    $pk = $_SESSION['pk'];

    $sql_query = "SELECT Fname, Surname, Username, DateofBirth, Sex FROM staff WHERE Staff_ID=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $pk);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($Fname, $Surname, $Username, $DateofBirth, $Sex);
    if($stmt->num_rows = 1) {
        $stmt->fetch();
        echo '<div id="update-form">
        <button id="myButton" class="float-left submit-button" >Edit</button>
        <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
        location.href ="EditableProfile.php";
        };
        </script>
        <h1>Profile Details</h1>
        <form action="EditableProfile.php" method="POST">
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
        </form>
        </div>';
        } else{
            // error
            header('Location: signout.php');
            exit();
        }
        
    ?>
</body>
</html>