<?php 
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
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


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}

$all_conflicts = "SELECT * FROM Appointments WHERE Overlapping=1";
$result = mysqli_query($connection, $all_conflicts);
if(mysqli_num_rows($result)>0){
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
    while($row=mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>' .$row['AppointmentID'].'</td>';
        echo '<td>' .$row['PatientID'].'</td>';
        echo '<td>' .$row['Staff_ID'].'</td>';
        echo '<td>' .$row['StartTime'].'</td>';
        echo '<td>' .$row['EndTime'].'</td>';
        echo '<td>' .$row['AppDate'].'</td>';
        echo '<td><a href="EditableAppointment.php?id='.$row['AppointmentID'].'">Edit</a></td>';
        echo '<td><a href="delete_app.php?id='.$row['AppointmentID'].'">Delete</a></td>';
        echo '</tr>';
    }
    echo "<table>";
}else{
    echo "<h1>No Conflicts in Appointments</h1>";
}
    

mysqli_close($connection);
    
?>
</body>
</html>