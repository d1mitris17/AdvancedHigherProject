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
        <form action="EditableProfile.php" method="POST">
        <h1>Profile Details</h1>
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" value="'.$Fname.'" required>
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" value="'.$Surname.'" required>
        <br><br>
        <label for="Username">Username: </label>
        <input type="text" name="Username" value="'.$Username.'" required>
        <br><br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" value="'.$DateofBirth.'" required>
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
            exit();
        }
        
 

    if(isset($_POST['update'])) {
        $Fname = $_POST['Fname'];
        $Surname = $_POST['Surname'];
        $Username = $_POST['Username'];
        $Pword = $_POST['Pword'];
        $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);
        $DateofBirth = $_POST['DateOfBirth'];
        $Sex = $_POST['Sex'];
        $pk = $_SESSION['pk'];

        $sql_query2 = "UPDATE staff SET Fname=?, Surname=?, Username=?, Pword=?, DateOfBirth=?, Sex=? WHERE Staff_ID=?";
        $stmt2 = $conn->prepare($sql_query2);
        $stmt2->bind_param("ssssssi", $Fname, $Surname, $Username, $hashed_pword, $DateofBirth, $Sex, $pk);
        $stmt2->execute();

        if($stmt2->affected_rows = 1){
            $conn->close();
            $_SESSION['Name'] = $Fname;
            echo '
        <script>
            window.alert("Details have been modified successfully")
        </script>';
            header('Location: profile.php');
            exit();
        } else{
            $conn->close();
            header('Location: index.php');
            exit();
        }
    }


?>
</body>
</html>