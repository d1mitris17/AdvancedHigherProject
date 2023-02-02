<?php
session_start();
include 'loggedin.php';
include 'connect_to_db.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Appointment</title>
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

    <div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
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



    <div class="all_appointments">
    <div class="container">
    <div class="filter">
    <label for="Doctor">Doctor ID</label>
    <select name="Doctor" id="DoctorMenu">
        <option value="">All</option>
        <?php
        $pk = $_SESSION['pk'];
        $query = 'SELECT Staff_ID, Fname, Surname FROM staff WHERE StaffType="Doctor"';
        $stmt= $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while($row=$result->fetch_array()){
                echo"<option value='".$row['Staff_ID']."'>".$row['Fname']." ".$row['Fname']."</option>";
            }
        }
        ?>
    </select>

    <button id="Search">Search</button>
        <script type="text/javascript">
        document.getElementById("Search").onclick = function () {
        var e = document.getElementById("DoctorMenu");
        var value = e.value;
        if (value == ''){
            location.href = "all_appointments.php";
        } else {
        let loc = "all_appointments.php?id=";
        let url = loc.concat(value)
        location.href = url;
        }
        };
        </script>
    </div>

    <?php
    
    $query = "SELECT * FROM appointments WHERE Staff_ID LIKE ? ORDER BY AppDate ASC, StartTime ASC, EndTime ASC";
    $stmt= $conn->prepare($query);
    if (isset($_GET['id'])) {
        $pk = $_GET['id'];
        $stmt->bind_param("i", $pk);
    }else{
        $pk = '%';
        $stmt->bind_param("s", $pk);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo "<h1>All Appointments</h1>";
        echo "<table>";
        echo '<tr>';
        echo '<th>AppointmentID</th>';
        echo '<th>PatientID</th>';
        echo '<th>Staff_ID</th>';
        echo '<th>StartTime</th>';
        echo '<th>EndTime</th>';
        echo '<th>AppDate</th>';
        echo '</tr>';
        while($row=$result->fetch_array()){
            echo '<tr>';
            echo '<td>' .$row['AppointmentID'].'</td>';
            echo '<td>' .$row['PatientID'].'</td>';
            echo '<td>' .$row['Staff_ID'].'</td>';
            echo '<td>' .$row['StartTime'].'</td>';
            echo '<td>' .$row['EndTime'].'</td>';
            echo '<td>' .$row['AppDate'].'</td>';
            echo '<td><a id="Edit" href="EditableAppointment.php?id='.$row['AppointmentID'].'">Edit</a></td>';
            echo '<td><a id="Delete" href="delete_app.php?id='.$row['AppointmentID'].'">Delete</a></td>';
            echo '</tr>';
        }
        echo "<table>";
    }
        
    

    ?>
    </div>
    </div>
</body>
</html>