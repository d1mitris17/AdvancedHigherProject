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


if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pword = $_POST['password'];

    $sql_query = "SELECT * FROM patient WHERE EmailAddress='$email' AND Pword='$pword'";

    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $_SESSION['Name'] = $row['fname'];
        $_SESSION['loggedin'] = true;
        $_SESSION['pk'] = $row['PatientID'];
        header('Location: home.php');
    } else{
        header('Location: index.php');
    }
    }


?>