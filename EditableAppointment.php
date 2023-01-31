<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<head>
    <title>Appointment</title>
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
    <div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="BookAppointment.php">Book an Appointment</a>
        <a class='active' href="show_conflicts.php">Show Conflicts</a>
        <a href="NewPatientAccountForm.php">Add Patient</a>
        <a href="NewStaffForm.php">Add Hospital Staff</a>
        <a href="signout.php">Sign Out</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>


    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
    }
    </script> 

    <div class="EditApp">
    <?php
    include 'connect_to_db.php';
    $Appointment_pk = $_GET['id'];

    if (isset($_POST['update2'])){
        // Get info from form
        $OldDate = $_POST['OldDate'];
        $Staff = $_POST['Staff_ID'];
        $NewAppDate = $_POST['AppDate'];
        $StartTime = $_POST['StartTime'];
        $EndTime = $_POST['EndTime'];
        // set all appointments with the PastDate and doctor to not conflicting 
        $update = "UPDATE appointments SET Overlapping=0 WHERE Staff_ID=? AND AppDate=?;";
        $stmt2 = $conn->prepare($update);
        $stmt2->bind_param("is", $Staff, $OldDate);
        $stmt2->execute();
        // update appointment
        $updquery = "UPDATE appointments SET AppDate=?, StartTime=?, EndTime=? WHERE AppointmentID=?";
        $stmt3 = $conn->prepare($updquery);
        $stmt3->bind_param("sssi", $NewAppDate, $StartTime, $EndTime, $Appointment_pk);
        $stmt3->execute();
        // re-run feature to check for conflicts on OldDate
        $all_appointments = "SELECT StartTime, EndTime, AppointmentID FROM appointments WHERE 
        Staff_ID=? AND AppDate=? ORDER BY StartTime ASC;";
        $stmt4 = $conn->prepare($all_appointments);
        $stmt4->bind_param("is", $Staff, $OldDate);
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
            $Appointments2 = array();
            while($row = $result2->fetch_array()) {
                $Appointments2[] = $row;
            }
        if(count($Appointments2)>1){
            $conflicts = find_conflicts($Appointments2);
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
        // header('Location: show_conflicts.php');
        // exit();
    }
    
    $sql_query = "SELECT AppDate, StartTime, EndTime, AppointmentID, Staff_ID FROM appointments WHERE AppointmentID=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $Appointment_pk);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($AppDate, $StartTime, $EndTime, $AppointmentID, $Staff_ID);

    if($stmt->num_rows == 1) {
        $stmt->fetch();
        echo '<form action="" id="update-form" method="POST">
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
        <input type="hidden" name="Staff_ID" value="'.$Staff_ID.'">
        <input type="submit" id="UpdateButt" value="Update" name="update2">
        </form>';
        } else{
            // header('Location: home.php');
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

?>


    </div>
</body>
</html>