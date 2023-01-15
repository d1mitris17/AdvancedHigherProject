<?php
session_start();
include 'loggedin2.php';
?>

<?php
if(isset($_POST['login'])) {
    include 'connect_to_db.php';

    $stmt = $conn->prepare("SELECT Staff_ID, Fname, Pword FROM staff WHERE Username=?");
    $stmt->bind_param("s", $username);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($Staff_ID, $Fname, $Pword);
    if($stmt->num_rows == 1){
        $stmt->fetch();
        if(password_verify($password, $Pword)){
            $_SESSION['Name'] = $Fname;
            $_SESSION['pk'] = $Staff_ID;
            $_SESSION['loggedin'] = true;
            mysqli_close($connection);
            echo 'success';
            header('Location: home.php');
        } else {
            session_destroy();
            echo '
            <script>
                window.alert("Password is invalid")
            </script>';
        }
    } else{
        echo '
        <script>
            window.alert("Username is invalid")
        </script>';
    }
    }
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
        <form action="" method="POST">
            <input name="username" type="text" placeholder="Username">
            <br><br>
            <input type="password" name="password" placeholder="Password">
            <br><br>
            <input type="submit" name="login" id="login" value="Log in">
            <br><br>
        </form>
    </div>


</body>
</html>
