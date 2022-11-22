<?php
$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}

$pk = $_GET['id'];

$query = "DELETE FROM appointments WHERE AppointmentID=$pk;";

if (mysqli_query($connection, $query)){
    // Display success message
    header('Location: home.php');
}else{
    // Display Failure, please retry message
    header('Location: home.php');
}