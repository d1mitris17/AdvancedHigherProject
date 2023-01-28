<?php
session_start();
include 'loggedin2.php';
?>

<!DOCTYPE html>

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
            $conn->close();
            header('Location: home.php');
            exit();
        } else {
            session_destroy();
            echo '
            <script>
                window.alert("Password is invalid")
            </script>';
        }
    } else{
        session_destroy();
        echo '
        <script>
            window.alert("Username is invalid")
        </script>';
    }
    $conn->close();
    }
?>

<html lang="en">
<head>
    <title>Log in - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
</head>
<body>

    <div class="pos">
        <div class="log-in-form">
            <img src="images/logo.png" alt="logo">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input name="username" type="text" placeholder="Username">
                <br><br>
                <input type="password" name="password" placeholder="Password">
                <br><br>
                <input type="submit" name="login" id="login" value="Log in">
                <br><br>
            </form>
        </div>
    </div>

</body>
</html>
