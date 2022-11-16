<?php 
session_start();
include 'loggedin.php';
?>

<?php
$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}
$conflicts = $_SESSION['Conflicts'];
echo "<table>";
foreach($conflicts as $id) {
    $sql_query = "SELECT * FROM Appointments WHERE AppointmentID=$id";
    $result = mysqli_query($connection, $all_appointments);
    echo '<tr>';
    foreach($row as $key => $field) {
        echo '<td>' . htmlspecialchars($field) . '</td>';
    }
    // echo "<td><a href='BookAppointment2.php?id=".$row['PatientID']."'>Select Patient</a></td>";
    echo '</tr>';
}

echo "<table>";

mysqli_close($connection);

    
?>