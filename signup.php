<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Springfield General Hospital </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="details-form">
        <h1>Springfield General Hospital</h1>
        <form action="add.php" method="POST">
            <input name="patientID" type="text" placeholder="PatientID" required>
            <br><br>
            <input name="email" type="email" placeholder="Email" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <br><br>
            <input name="confirmpassword" type="password" placeholder="Confirm Password" required>
            <br><br>
            <input type="submit" id="login" value="Register">
            <br><br>
        </form>
    </div>
    <div class="details-form">
        <p class="register">Already have an account? <a class="register" href="index.php">Log in</a></p>
    </div>
</body>
</html>