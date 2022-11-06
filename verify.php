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


if(mysqli_connect_errno()) {
    die("Failed to connect".mysqli_connect_errno());
}


if(isset($_POST['Login'])) {
    $email = $_POST['email'];
    $pword = $_POST['password'];

    $sql_query = "SELECT * FROM patient WHERE email = '$email' AND userPass = '$password'";

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