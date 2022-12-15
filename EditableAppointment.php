<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul class="nav-bar">
        <li><a href="home.php"><img src="images/logo.png" alt="logo"></a></li>
        <li><a id="link" href="profile.php">Profile</a></li>
        <li><a id="link" href="BookAppointment.php">Book an Appointment</a></li>
        <li><a id="link" href="show_conflicts.php">Show Conflicts</a></li>
        <li><a id="link" href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a id="link" href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a id="link" href="signout.php">Sign Out</a></li>
    </ul>

    <div id="details">
    <?php
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";
    $Appointment_pk = $_GET['id'];
    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
    $sql_query = "SELECT * FROM appointments WHERE AppointmentID='$Appointment_pk'";
    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);
        echo '<form action="EditableAppointment.php" id="update-form" method="POST">
        <h1>Appointment Details</h1>
        <input type="hidden" name="OldDate" value="'.$row['AppDate'].'">
        <label for="AppDate">Appointment Date: </label>
        <input type="date" name="AppDate" value="'.$row['AppDate'].'" required>
        <br><br>
        <label for="StartTime">Start Time: </label>
        <input type="time" name="StartTime" value="'.$row['StartTime'].'" required>
        <br><br>
        <label for="EndTime">End Time: </label>
        <input type="time" name="EndTime" value="'.$row['EndTime'].'" required>
        <br><br>
        <input type="hidden" name="AppointmentID" value="'.$row['AppointmentID'].'">
        <br><br>
        <input type="hidden" name="Staff_ID" value="'.$row['Staff_ID'].'">
        <br><br>
        <input type="submit" id="myButton2" value="Update" name="update2">
        </form>';
        } else{
            header('Location: home.php');
        }
        
    

    function find_conflicts($Appointments){
        $conflicts = array();
        $temp_conflicts = array($Appointments[0][2]);
        $end = $Appointments[0][1];
        for ($ii=1; $ii<count($Appointments); $ii++){
            if ($Appointments[$ii][0]>=$end){
                if(count($temp_conflicts)>1){
                    $conflicts[] = $temp_conflicts;
                }
                $temp_conflicts = array();
            }
            $end = max($Appointments[$ii][1], $end);
            $temp_conflicts[] = $Appointments[$ii][2];
        }
        if(count($temp_conflicts)>1){
            $conflicts[] = $temp_conflicts;
        }
        return $conflicts;
    }


if (isset($_POST['update2'])){
    // Get info from form
    $OldDate = $_POST['OldDate'];
    $pk = $_POST['AppointmentID'];
    $Staff = $_POST['Staff_ID'];
    $NewAppDate = $_POST['AppDate'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    // set all appointments with the PastDate and doctor to not conflicting 
    $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=$Staff AND AppDate='$OldDate';";
    mysqli_query($connection, $update);
    // update appointment
    $updquery = "UPDATE appointments SET AppDate='$NewAppDate', StartTime='$StartTime', EndTime='$EndTime' WHERE AppointmentID=$pk;";
    mysqli_query($connection, $updquery);
    // re-run feature to check for conflicts on OldDate
    $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
    Staff_ID=$Staff AND AppDate='$OldDate' ORDER BY StartTime ASC;";
    $result2 = mysqli_query($connection, $all_appointments);
    $Appointments = array();
    while($row = mysqli_fetch_array($result2)) {
            $Appointments[] = $row;
    }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=$temp1"; 
            mysqli_query($connection, $update);
        }
    }
    //if Date's been changed, update apps on new date to not conflicting and rerun feature to check for conflicts
    if ($OldDate != $NewAppDate) {
        $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=$Staff AND AppDate='$NewAppDate';";
    mysqli_query($connection, $update);
    $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
    Staff_ID=$Staff AND AppDate='$NewAppDate' ORDER BY StartTime ASC;";
    $result3 = mysqli_query($connection, $all_appointments);
    $Appointments = array();
    while($row = mysqli_fetch_array($result3)) {
            $Appointments[] = $row;
    }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=$temp1"; 
            mysqli_query($connection, $update);
        }
    }
         
    }
       // Display success message
    header('Location: home.php');
}
?>


    </div>
</body>
</html>