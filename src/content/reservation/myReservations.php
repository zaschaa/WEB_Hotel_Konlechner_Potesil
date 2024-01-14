<?php
    require_once('../../userManagement/User.php');
    // Start or continue a session
    session_start();     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

    <title>Meine Reservierungen</title>

    <link rel="stylesheet" href="../../styles.css"/>
</head>
<body class="bgColor bg-gradient">
<header>
    <?php
    include '../../navigation/navbar/topNavBar.php';
    ?>
</header>

<main>
    <div class="container justify-content-left">

        <h1>Meine Reservierungen</h1>

        <?php     
            require_once('../../reservationManagement/ReservationManagementSystem.php');   

            if(isset($_SESSION["currentUser"])) {
                $rms = new ReservationManagementSystem();  
                
                $rms->printUsersReservations($_SESSION["currentUser"]);
            } else {
                echo "<p>Bitte loggen Sie sich ein, um Ihre Reservierungen einsehen zu können!</p>";
            }
        ?>

     
    </div>

</main>

<footer>
    <?php
    include '../../navigation/footer/footerNav.php';
    ?>
</footer>
</body>
</html>