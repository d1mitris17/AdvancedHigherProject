<?php 
session_start();
include 'loggedin.php';
?>

<?php

/* create function */

$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}


if(isset($_POST['Book'])) {
    $DoctorID = $_POST['doctor'];
    $PatientID = $_POST['patient_id'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $Date = $_POST['date'];


    $sql_query = "INSERT INTO appointments(Staff_ID, PatientID, StartTime, EndTime, AppDate) VALUES('$DoctorID','$PatientID','$StartTime','$EndTime','$Date')";

    if(mysqli_query($connection, $sql_query)){
        $all_appointments = "SELECT * FROM appointments WHERE Staff_ID=$DoctorID AND AppDate=$Date";
        $result = mysqli_query($connection, $all_appointments);
        $arr = mysqli_fetch_array($result);
        /* call function */

        header('Location: home.php');
    } else{
        /* find way to add failled message*/
        header('Location: home.php');
    }

    mysqli_close($connection);

    }


?>