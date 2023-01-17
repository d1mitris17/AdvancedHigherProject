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
include 'connect_to_db.php';


if(isset($_POST['Book'])) {
    $DoctorID = $_POST['doctor'];
    $PatientID = $_POST['patient_id'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $Date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO appointments(Staff_ID, PatientID, StartTime, EndTime, AppDate) VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param('iisss', $DoctorID, $PatientID, $StartTime, $EndTime, $Date);
    $stmt->execute();

    if($stmt->affected_rows > 0){

        $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE Staff_ID=? AND AppDate=? ORDER BY StartTime ASC";
        $stmt2 = $conn->prepare($all_appointments);
        $stmt2->bind_param('is', $DoctorID, $Date);
        $stmt2->execute();

        $result = $stmt2->get_result();
        $Appointments = array();
        while($row = $result->fetch_array()) {
            $Appointments[] = $row;
        }
        $conflicts = find_conflicts($Appointments);
        echo '<pre>'; print_r($conflicts); echo '</pre>';
        if(!empty($conflicts[0])){
            echo 'test2';
            for ($ii=0; $ii<count($conflicts[0]); $ii++){
                $temp1 = $conflicts[0][$ii];
                $update = "UPDATE appointments SET Overlapping=1 WHERE AppointmentID=$temp1"; 
                mysqli_query($conn, $update);
            }
            $conn->close();
            header('Location: show_conflicts.php');
            exit();
        }else{
            echo 'test1';
            $conn->close();
            header('Location: home.php');
            exit();
            // add message (success)
        }
        

    } else{
        // find way to add failled message
        $conn->close();
        header('Location: home.php');
        exit();
    }

}


    ?>