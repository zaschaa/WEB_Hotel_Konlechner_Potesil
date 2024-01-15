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

    <title>Reservierungen verwalten</title>

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

        <h1>Reservierungs-Verwaltung</h1>

        <?php     
            require_once('../../reservationManagement/ReservationManagementSystem.php');   

            $rms = new ReservationManagementSystem();  

            if((isset($_POST["getResDetailView"]) || isset($_POST["cancelRes"]) || isset($_POST["confirmRes"]) || isset($_POST["resetCancel"])) && !isset($_POST["goback2ResList"])) {
                echo "<h2>Detailansicht</h2>";
                if(isset($_POST["getResDetailView"])) {
                    $rms->printReservationOverviewById($_POST["getResDetailView"]);
                } elseif (isset($_POST["cancelRes"])) {
                    $rms->updateResState($_POST["cancelRes"], "cancelled"); 
                    $rms->printReservationOverviewById($_POST["cancelRes"]);
                } elseif (isset($_POST["confirmRes"])) {
                    $rms->updateResState($_POST["confirmRes"], "confirmed");
                    $rms->printReservationOverviewById($_POST["confirmRes"]);
                } elseif (isset($_POST["resetCancel"])) {
                    $rms->updateResState($_POST["resetCancel"], "new");
                    $rms->printReservationOverviewById($_POST["resetCancel"]);
                }
            } else {
                $rms->printAllReservations();
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