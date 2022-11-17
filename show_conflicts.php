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
for ($ii=0; $ii<count($conflicts[0]); $ii++){
    $temp1 = $conflicts[0][$ii];
    $all_conflicts = "SELECT * FROM Appointments WHERE AppointmentID=$temp1";
    $result = mysqli_query($connection, $all_conflicts);
    $row = mysqli_fetch_array($result);
    echo '<tr>';
    echo '<td>' .$row['AppointmentID'].'</td>';
    echo '<td>' .$row['PatientID'].'</td>';
    echo '<td>' .$row['Staff_ID'].'</td>';
    echo '<td>' .$row['StartTime'].'</td>';
    echo '<td>' .$row['EndTime'].'</td>';
    echo '<td>' .$row['AppDate'].'</td>';
    echo '</tr>';
}

echo "<table>";

mysqli_close($connection);

    
?>