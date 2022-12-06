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

$pk = $_GET['id'];

$getInf = "SELECT AppDate, Staff_ID FROM appointments WHERE AppointmentID=$pk;";

if (mysqli_query($connection, $getInf)){
    $result = mysqli_query($connection, $getInf);
    $row = mysqli_fetch_array($result);
    // set all appointments with the date and doctor to not conflict
        $Staff = $row['Staff_ID'];
        $Date = $row['AppDate'];
        $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=$Staff AND AppDate='$Date';";
        mysqli_query($connection, $update);
    // drop appointment
    $delquery = "DELETE FROM appointments WHERE AppointmentID=$pk;";
    mysqli_query($connection, $delquery);
    // re-run feature to check for conflicts
    $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
    Staff_ID=$Staff AND AppDate='$Date' ORDER BY StartTime ASC;";
    $result2 = mysqli_query($connection, $all_appointments);
    $Appointments = array();
    while($row = mysqli_fetch_array($result2)) {
            $Appointments[] = $row;
    }
    if(count($Appointments)>1){
        $conflicts = find_conflicts($Appointments);
        for ($ii=0; $ii<count($conflicts[0]); $ii++){
            $temp1 = $conflicts[0][$ii];
            $all_conflicts = "SELECT * FROM Appointments WHERE AppointmentID=$temp1";
            $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=$temp1"; 
            $result = mysqli_query($connection, $all_conflicts);
            mysqli_query($connection, $update);
            $row = mysqli_fetch_array($result);
            echo '<tr>';
            echo '<td>' .$row['AppointmentID'].'</td>';
            echo '<td>' .$row['PatientID'].'</td>';
            echo '<td>' .$row['Staff_ID'].'</td>';
            echo '<td>' .$row['StartTime'].'</td>';
            echo '<td>' .$row['EndTime'].'</td>';
            echo '<td>' .$row['AppDate'].'</td>';
            echo '<td><a href="edit_app.php?id='.$row['AppointmentID'].'">Edit</a></td>';
            echo '<td><a href="delete_app.php?id='.$row['AppointmentID'].'">Delete</a></td>';
            echo '</tr>';
        }
        }
    // Display success message
    // header('Location: home.php');
}else{
    // Display Failure, please retry message
    header('Location: home.php');
}