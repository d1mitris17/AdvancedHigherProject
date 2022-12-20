<?php
session_start();
include 'loggedin2.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log in - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="details-form">
        <img src="images/logo.png" alt="logo">
        <form action="index.php" method="POST">
            <input name="username" type="username" placeholder="Username" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <br><br>
            <input type="submit" name="login" id="login" value="Log in">
            <br><br>
        </form>
        <a href="ResetPassword.php">Forgoten yout Password?</a>
    </div>
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
    $username = $_POST['username'];
    $pword = $_POST['password'];

    $sql_query = "SELECT * FROM staff WHERE Username='$username' AND Pword='$pword'";

    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $_SESSION['Name'] = $row['Fname'];
        $_SESSION['pk'] = $row['Staff_ID'];
        $_SESSION['loggedin'] = true;
        echo '
        <script>
            window.alert("Log in successful")
        </script>';
        header('Location: home.php');
    } else{
        echo '
        <script>
            window.alert("Username and Password have not been found")
        </script>';
    }
    }
?>


</body>
</html>
