<?php 
session_start();
include 'loggedin.php';
?>

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


if(isset($_POST['Book'])) {
    $DoctorID = $_POST['doctor'];
    $PatientID = $_POST['patient_id'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $Date = $_POST['date'];


    $sql_query = "INSERT INTO appointments(Staff_ID, PatientID, StartTime, EndTime, AppDate) VALUES('$DoctorID','$PatientID','$StartTime','$EndTime','$Date')";

    if(mysqli_query($connection, $sql_query)){
        $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE Staff_ID=$DoctorID AND AppDate='$Date' ORDER BY StartTime ASC";
        $result = mysqli_query($connection, $all_appointments);
        $Appointments = array();
        while($row = mysqli_fetch_array($result)) {
            $Appointments[] = $row;
        }
        $conflicts = find_conflicts($Appointments);
        $_SESSION['Conflicts'] = $conflicts;
        if(count($_SESSION['Conflicts'])>0){
            header('Location: conflicts_found.php');
        } else{
            header('Location: home.php');
            // add message (success)
        }
        

    } else{
        // find way to add failled message
        header('Location: home.php');
    }

    mysqli_close($connection);

    }


?>