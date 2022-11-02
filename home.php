<?php

$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "customerdetails";

$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if (mysqli_connect_errno()) {
    die("Failed to connect ". mysqli_connect_errno());
}

if (isset( $_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password1'];

    $sqlQuery = "INSERT INTO details (firstname, lastname, gender, email, password1) VALUES ('$firstname', '$lastname', '$gender', '$email', '$password')";

    if (mysqli_query($connection, $sqlQuery)) {
        echo("Data inserted successfully...");
    } else {
        echo("Error: " . mysqli_error($connection));
    }
  
    mysqli_close($connection);
    
}
?>