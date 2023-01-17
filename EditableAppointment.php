<?php
session_start();
include 'loggedin.php';
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
    include 'connect_to_db.php';
    $Appointment_pk = $_GET['id'];
    
    $sql_query = "SELECT AppDate, StartTime, EndTime, AppointmentID, Staff_ID FROM appointments WHERE AppointmentID=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $pk);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($AppDate, $StartTime, $EndTime, $AppointmentID, $Staff_ID);

    if($stmt->num_rows = 1) {
        $stmt->fetch();
        echo '<form action="EditableAppointment.php" id="update-form" method="POST">
        <h1>Appointment Details</h1>
        <input type="hidden" name="OldDate" value="'.$AppDate.'">
        <label for="AppDate">Appointment Date: </label>
        <input type="date" name="AppDate" value="'.$AppDate.'" required>
        <br><br>
        <label for="StartTime">Start Time: </label>
        <input type="time" name="StartTime" value="'.$StartTime.'" required>
        <br><br>
        <label for="EndTime">End Time: </label>
        <input type="time" name="EndTime" value="'.$EndTime.'" required>
        <br><br>
        <input type="hidden" name="AppointmentID" value="'.$AppointmentID.'">
        <br><br>
        <input type="hidden" name="Staff_ID" value="'.$Staff_ID.'">
        <br><br>
        <input type="submit" id="myButton2" value="Update" name="update2">
        </form>';
        } else{
            header('Location: home.php');
            exit();
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
    $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=? AND AppDate=?;";
    $stmt2 = $conn->prepare($update);
    $stmt2->bind_param("is", $Staff, $Date);
    $stmt2->execute();
    // update appointment
    $updquery = "UPDATE appointments SET AppDate=?, StartTime=?, EndTime=? WHERE AppointmentID=?;";
    $stmt3 = $conn->prepare($updquery);
    $stmt3->bind_param("sssi", $NewAppDate, $StartTime, $EndTime, $pk);
    $stmt3->execute();
    // re-run feature to check for conflicts on OldDate
    $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
         Staff_ID=? AND AppDate=? ORDER BY StartTime ASC;";
    $stmt4 = $conn->prepare($all_appointments);
    $stmt4->bind_param("is", $Staff, $Date);
    $stmt4->execute();
    $result = $stmt4->get_result();
    $Appointments = array();
    while($row = $result->fetch_array()) {
            $Appointments[] = $row;
    }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=?";
            $stmt5 = $conn->prepare($update);
            $stmt5->bind_param("i", $temp1);
            $stmt5->execute();
        }
    }
    //if Date's been changed, update apps on new date to not conflicting and rerun feature to check for conflicts
    if ($OldDate != $NewAppDate) {
        $all_appointments2 = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
        Staff_ID=? AND AppDate=? ORDER BY StartTime ASC;";
        $stmt5 = $conn->prepare($all_appointments);
        $stmt5->bind_param("is", $Staff, $NewAppDate);
        $stmt5->execute();
        $result2 = $stmt5->get_result();
        $Appointments = array();
        while($row = $result2->fetch_array()) {
            $Appointments[] = $row;
        }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=?";
            $stmt5 = $conn->prepare($update);
            $stmt5->bind_param("i", $temp1);
            $stmt5->execute();
        }
    }
         
    }
       // Display success message
    header('Location: show_conflicts.php');
    exit();
}
?>


    </div>
</body>
</html>