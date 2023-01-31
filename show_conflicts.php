<?php 
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
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
        <a class='active' href="show_conflicts.php">Show Conflicts</a>
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

    <div class="show_conflicts"> 
    <div class="container"> 
<?php
include 'connect_to_db.php';

$all_conflicts = "SELECT * FROM Appointments WHERE Overlapping=1";
$stmt = $conn->prepare($all_conflicts);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<h1>Conflicts have been detected</h1>";
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
}else{
    echo "<h1>No Conflicts in Appointments</h1>";
}


$conn->close();
    
?>
</div>
</div>

</body>
</html>