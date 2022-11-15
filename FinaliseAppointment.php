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


if(isset($_POST['Book'])) {
    $DoctorID = $_POST['doctor'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $Date = $_POST['Date'];


    $sql_query = "INSERT INTO $table(Pword, Fname, Surname, EmailAddress, DateofBirth, Sex) VALUES('$pword','$name','$surname','$email','$dob','$sex')";

    if(mysqli_query($connection, $sql_query)){
        header('Location: home.php');
    } else{
        header('Location: home.php');
    }

    mysqli_close($connection);

    }


?>
    ?>