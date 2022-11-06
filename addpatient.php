<?php
session_start();
$_SESSION['loggedin'] = false;
?>

<?php

$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "HospitalManagementSystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli.connect_errno()){
    die("Failed to connect")
}


if(isset($_POST['Register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $pword = $_POST['password'];
    $sex = $_POST['sex'];

    $sql_query = "INSERT INTO `patient`(`Password`, `Name`, `Surname`, `Email Address`, `Date of Birth`, `Sex`) VALUES ('$pword','$name','$surname','$email','$dob','$sex')";

    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['loggedin'] = true;
        header('Location: home.php');
    } else{
        header('Location: index.html');
    }
    }


?>