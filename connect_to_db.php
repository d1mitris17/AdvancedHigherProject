<?php
$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$conn = new mysqli($serverAddress, $serverUsername, $serverPassword, $serverDB);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>