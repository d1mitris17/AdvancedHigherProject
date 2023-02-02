<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
    <script defer src="form_validation_profile.js"></script>
</head>
<body>
<div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a class='active' href="profile.php">Profile</a>
        <a href="BookAppointment.php">Book an Appointment</a>
        <a href="show_conflicts.php">Show Conflicts</a>
        <a href="NewPatientAccountForm.php">Add Patient</a>
        <a href="NewStaffForm.php">Add Hospital Staff</a>
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
    
    <div class="profilecontainer">
    <?php
    include 'connect_to_db.php';

    $pk = $_SESSION['pk'];


    if(isset($_POST['update'])) {
        $Fname = $_POST['Fname'];
        $Surname = $_POST['Surname'];
        $Username = $_POST['Username'];
        $DateofBirth = $_POST['DateOfBirth'];
        $Sex = $_POST['Sex'];

        $sql_query2 = "UPDATE staff SET Fname=?, Surname=?, Username=?, DateOfBirth=?, Sex=? WHERE Staff_ID=?";
        $stmt2 = $conn->prepare($sql_query2);
        $stmt2->bind_param("sssssi", $Fname, $Surname, $Username, $DateofBirth, $Sex, $pk);
        $stmt2->execute();

        if($stmt2->affected_rows == 1){
            $conn->close();
            $_SESSION['Name'] = $Fname;
            echo '
        <script>
            window.alert("Details have been modified successfully")
        </script>';
            header('Location: home.php');
            exit();
        } else{
            $conn->close();
            header('Location: index.php');
            exit();
        }
    }

    $sql_query = "SELECT Fname, Surname, Username, DateofBirth, Sex FROM staff WHERE Staff_ID=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $pk);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($Fname, $Surname, $Username, $DateofBirth, $Sex);
    if($stmt->num_rows == 1) {
        $stmt->fetch();
        echo '<div id="update-form">
        <button id="CancelBut" class="float-left submit-button">Cancel</button>
        <script type="text/javascript">
        document.getElementById("CancelBut").onclick = function () {
        location.href="profile.php";
        };
        </script>
        <form action="EditableProfile.php" method="POST" id="form">
        <h1>Profile Details</h1>
        <label for="Fname">First Name: </label>
        <input type="text" name="Fname" id="Fname" value="'.$Fname.'" >
        <br><br>
        <label for="Surname">Surname: </label>
        <input type="text" name="Surname" id="Surname" value="'.$Surname.'" >
        <br><br>
        <label for="Username">Username: </label>
        <input type="text" name="Username" id="Username" value="'.$Username.'" >
        <br><br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" id="DateOfBirth" value="'.$DateofBirth.'" >
        <br><br>
        <label for="Sex">Sex: </label>
        <select name="Sex" id="Sex">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br>
        <input type="submit" id="Update" value="Update" name="update">
        </form>
        <br><br>
        <div id="error"></div>
        </div>';
        
        
        } else{
            header('Location: home.php');
            exit();
        }
        
 



?>
</div>
</body>
</html>