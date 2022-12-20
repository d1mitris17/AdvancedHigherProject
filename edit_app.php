<?php

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

$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}

if (isset($_POST['update'])){
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
    $updquery = "UPDATE appointments SET AppDate='$NewAppDate' StartTime='$StartTime', EndTime='$EndTime' WHERE AppointmentID=$pk;";
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
        $updateNew = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=$Staff AND AppDate='$NewAppDate';";
    mysqli_query($connection, $updateNew);
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
    header('Location: show_conflicts.php');
}else{
    // Display Failure, please retry message
    header('Location: home.php');
}
?>