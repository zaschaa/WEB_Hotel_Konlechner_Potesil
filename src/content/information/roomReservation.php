<?php
    require_once('../../userManagement/User.php');
    require_once('../../reservationManagement/Reservation.php');
    // Start or continue a session
    session_start();

    include '../../reservationManagement/reservation_logic.php';
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

    <title>Reservierung</title>
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

        <h1>Reservierung</h1>

        <?php 
            if (!isset($_SESSION["currentUser"])) {
                echo "<p class=\"mb-3\">Um ein Zimmer reservieren zu können, müssen Sie sich bitte einloggen!</p>";                
            } else {
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["goon"]) && $isvalidInput && !isset($_POST["goback"])) {        
                  
                    if(count($_SESSION["availableRoomTypes"])===0) {
                        echo "<p class=\"mb-3\">Zu Ihrer Anfrage stehen leider derzeit keine Zimmer zur Auswahl!</p>";
                        
                    } else {
                        include '../../reservationManagement/reservation_form_2.php';
                    }                    
                   
                } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["goon2"]) && !isset($_POST["goback2"])) {
                    include '../../reservationManagement/reservation_overview.php';
                } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["goback2"])) {
                    include '../../reservationManagement/reservation_form_2.php';
                } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmRes"])) {
                    include '../../reservationManagement/reservation_confirmation.php';
                } else {
                    include '../../reservationManagement/reservation_form.php';
                }
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