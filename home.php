<?php
session_start();
include 'loggedin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav-bar">
    <a href="home.php"><img src="images/logo.png" alt="logo"></a>
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="Appointments.php">Appointments</a></li>
        <li><a href="BookAppointment.php">Book an Appointment</a></li>
        <li><a href="Prescriptions.php">Prescriptions</a></li>
        <li><a href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a href="signout.php">Sign Out</a></li>
    </ul>    
    </div>
    <div id="HomeContents">
        <?php
         echo "<h1> Welcome ".$_SESSION['Name']."</h1>"
        ?>
        <h3>Exemplar Healthcare</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium asperiores dolor quas mollitia ex provident magni dolorum laudantium reprehenderit fuga possimus corrupti, sequi optio corporis impedit. Fuga numquam facilis ipsa ducimus ratione facere eum ut, esse cumque, veniam neque eaque optio odit amet labore! Modi dolorem vel voluptatum exercitationem in ratione explicabo, corrupti quis architecto nihil nisi nulla placeat distinctio eveniet minima quidem voluptatem laborum iusto nam quaerat doloremque delectus voluptate voluptas quisquam! Eveniet rerum amet, vitae fugiat impedit iusto quod dolorem quos quisquam unde ea incidunt odio natus enim. Rerum repellat veritatis ducimus tempora illo a maxime possimus at!</p>
    </div>

    <div id="how-to">
        <h1>How to book Appointments</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere magni dignissimos nemo laborum repellat eveniet repudiandae quod nesciunt aliquid quaerat assumenda, nulla nobis et rem quia placeat, sunt cumque ad illum dolor accusantium quo quis. Assumenda quidem cum modi, architecto labore accusamus cupiditate nemo similique. Eius soluta explicabo nam quasi inventore sunt voluptatibus quas, quisquam omnis fugit tempora, sapiente veritatis ullam perferendis recusandae. Enim ipsum asperiores dicta expedita. Dolores eaque tenetur dicta odit sapiente consequuntur harum debitis officia fuga dignissimos.</p>
        <h1>How to access Digital Prescriptions</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere magni dignissimos nemo laborum repellat eveniet repudiandae quod nesciunt aliquid quaerat assumenda, nulla nobis et rem quia placeat, sunt cumque ad illum dolor accusantium quo quis. Assumenda quidem cum modi, architecto labore accusamus cupiditate nemo similique. Eius soluta explicabo nam quasi inventore sunt voluptatibus quas, quisquam omnis fugit tempora, sapiente veritatis ullam perferendis recusandae. Enim ipsum asperiores dicta expedita. Dolores eaque tenetur dicta odit sapiente consequuntur harum debitis officia fuga dignissimos.</p>
        <h1>How to view scheduled appointments</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere magni dignissimos nemo laborum repellat eveniet repudiandae quod nesciunt aliquid quaerat assumenda, nulla nobis et rem quia placeat, sunt cumque ad illum dolor accusantium quo quis. Assumenda quidem cum modi, architecto labore accusamus cupiditate nemo similique. Eius soluta explicabo nam quasi inventore sunt voluptatibus quas, quisquam omnis fugit tempora, sapiente veritatis ullam perferendis recusandae. Enim ipsum asperiores dicta expedita. Dolores eaque tenetur dicta odit sapiente consequuntur harum debitis officia fuga dignissimos.</p>
    </div>
    
</body>
</html>