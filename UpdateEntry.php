<?php
session_start();
?>

<?php
$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);


if(mysqli_connect_errno()) {
    die("Failed to connect".mysqli_connect_errno());
}


if(isset($_POST['update'])) {
    $Fname = $_POST['Fname'];
    $Surname = $_POST['Surname'];
    $EmailAddress = $_POST['EmailAddress'];
    $Pword = $_POST['Pword'];
    $DateofBirth = $_POST['DateOfBirth'];
    $Sex = $_POST['Sex'];
    $pk = $_SESSION['pk'];
    $sql_query = "UPDATE staff SET Fname='$Fname', Surname='$Surname', EmailAddress='$EmailAddress', Pword='$Pword', DateOfBirth='$DateofBirth', Sex='$Sex' WHERE Staff_ID = $pk";
    if(mysqli_query($connection, $sql_query)){
        $_SESSION['Name'] = $Fname;
        header('Location: profile.php');
    } else{
        header('Location: index.php');
    }
    }


?>