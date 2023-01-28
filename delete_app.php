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

include 'connect_to_db.php';

$pk = $_GET['id'];

$getInf = "SELECT AppDate, Staff_ID FROM appointments WHERE AppointmentID=?;";
$stmt = $conn->prepare($getInf);
$stmt->bind_param("i", $pk);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($Date, $Staff);
$stmt->fetch();

if ($stmt->num_rows == 1){
    // set all appointments with the date and doctor to not conflict
        $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=? AND AppDate=?";
        $stmt2 = $conn->prepare($update);
        $stmt2->bind_param("is", $Staff, $Date);
        $stmt2->execute();
        // drop appointment
        $delquery = "DELETE FROM appointments WHERE AppointmentID=?";
        $stmt3 = $conn->prepare($delquery);
        $stmt3->bind_param("i", $pk);
        $stmt3->execute();
        // re-run feature to check for conflicts
        $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE Staff_ID=? AND AppDate=? ORDER BY StartTime ASC";
        $stmt4 = $conn->prepare($all_appointments);
        $stmt4->bind_param("is", $Staff, $Date);
        $stmt4->execute();
        $result2 = $stmt4->get_result();
        $Appointments = array();

        while($row = $result2->fetch_array()) {
            $Appointments[] = $row;
        }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=?";
        $stmt5 = $conn->prepare($update);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $stmt5->bind_param("i", $temp1);
            $stmt5->execute();
        }
        }
    // Display success message
    $conn->close();
    header('Location: show_conflicts.php');
    exit();
}else{
    // Display Failure, please retry message
    $conn->close();
    header('Location: show_conflicts.php');
    exit();
}