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

    <title>Zimmer</title>

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

        <div class="dropdown mb-3">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bitte wählen Sie die Zimmer-Kategorie!
            </button>
            <ul class="dropdown-menu">
                <li><form method="POST"><input name="roomType" type="submit" class="dropdown-item" value="Deluxe Zimmer"/></form></li>
                <li><form method="POST"><input name="roomType" type="submit" class="dropdown-item" value="Junior Suite"/></li>
                <li><form method="POST"><input name="roomType" type="submit" class="dropdown-item" value="Signature Suite"/></li>
                <li><form method="POST"><input name="roomType" type="submit" class="dropdown-item" value="Grand Suite"/></li>
            </ul>
        </div>

    <?php

        if(isset($_POST["roomType"])) {

            #require '../../database/dbaccess.php';
            require_once('../../reservationManagement/ReservationManagementSystem.php');
            
            $rms = new ReservationManagementSystem();

            $roomType = htmlspecialchars($_POST["roomType"]);           
            $_SESSION["roomType"] = $roomType;
            
            echo "<h2>$roomType</h2>";       

            $roomTypeInfo = $rms->getRoomTypeInfo($roomType);

            $picFilepathName = $roomTypeInfo->getpicFilePathName();
            $roomSize = $roomTypeInfo->getSize();
            $bedType = $roomTypeInfo->getBedType();
            $bedWidth = $roomTypeInfo->getBedWidth();
            $bedLength = $roomTypeInfo->getBedLength();
            $roomHasMinibar = $roomTypeInfo->getHasMinibar();
            $roomPrice = $roomTypeInfo->getPrice();

            if($roomHasMinibar===1) {
                $roomHasMinibar = 'Ja';
            } else {
                $roomHasMinibar = 'Nein';
            }

            echo "<p>Größe: $roomSize m²</p>";
            echo "<p>Bett: $bedType ($bedWidth x $bedLength cm)</p>";
            echo "<p>Minibar (alkoholfreie Getränke sind kostenlos): $roomHasMinibar</p>";
            echo "<p>Preis: ab $roomPrice € pro Pers. u. Nacht</p>";

            echo "<p><a class=\"text-decoration-underline\" href=\"./roomReservation.php\">Zur Reservierung</a></p>";
            
        }
    ?>

    <?php if(isset($roomType)) : ?>        

        <div id="carouselExample" class="carousel slide mb-3">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="<?php echo "../../images/rooms/" . $picFilepathName . "_01.jpg"; ?>" class="d-block w-100" alt="Alt-Text">
                </div>
                <div class="carousel-item">
                <img src="<?php echo "../../images/rooms/" . $picFilepathName . "_02.jpg"; ?>" class="d-block w-100" alt="Alt-Text">
                </div>
                <div class="carousel-item">
                <img src="<?php echo "../../images/rooms/" . $picFilepathName . "_03.jpg"; ?>" class="d-block w-100" alt="Alt-Text">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
    <?php endif ?>

    </div>

    <!--
        <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>

    <img src="../../images/construction_2.jpg" alt="Under Construction...">-->

</main>

<footer>
    <?php
    include '../../navigation/footer/footerNav.php';
    ?>
</footer>
</body>
</html>