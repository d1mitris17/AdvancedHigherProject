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
        <br><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium quos numquam sint repellendus quibusdam molestias mollitia, ea corrupti optio fuga blanditiis temporibus nisi? Nemo sed sequi adipisci tempora aliquid pariatur tenetur vitae architecto. Iusto ratione veritatis, numquam minus tempore maiores, laborum aliquam doloremque, facilis esse deleniti inventore ullam ea? Et non harum beatae quas expedita, repudiandae, deleniti nesciunt alias nisi voluptas ab vel dignissimos dolores quia in sequi laborum, blanditiis veritatis totam exercitationem accusamus eum! Ab consequuntur accusantium perspiciatis doloremque nulla repellendus ut. Dicta ullam blanditiis eaque, possimus nihil quae adipisci quod explicabo iste fuga, molestias, nesciunt nam odit alias sapiente iure fugit cum totam. Dolorum iusto, neque illo, necessitatibus perferendis veniam magni ex consequatur optio tenetur facere doloribus nam quis expedita saepe laudantium consequuntur deleniti voluptas ratione rerum dignissimos? Hic doloribus error distinctio aperiam vel eveniet ex reprehenderit ipsum consequuntur deleniti modi, asperiores, ullam dolor adipisci maiores quidem, pariatur eius dignissimos! Quidem provident libero commodi suscipit molestias iste quam, corporis assumenda dicta consequuntur dignissimos dolores, asperiores est illo sequi et dolorum quas odit qui natus nulla. Enim, ipsum tempore! Voluptatem nemo quos explicabo dolores sed neque. Doloremque cumque esse autem error repellendus dignissimos, iure odio eum laboriosam, natus illo?</p>
        <br><br><br><br><br><br><br><br><br><br>
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