<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Book an Appointment</title>
</head>
<body>
    <h1>Choose Patient: </h1>
    <?php
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";
    
    
    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
    
    
    if(mysqli_connect_errno()) {
        die("Failed to connect".mysqli_connect_errno());
    }

    $sql_query = "SELECT * FROM patient"

    $result = mysqli_query($connection, $query)
    
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
        

    }
    ?>
</body>
</html>