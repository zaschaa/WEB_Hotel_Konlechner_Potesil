<?php    

    $isvalidInput=TRUE;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        
        require_once('../../reservationManagement/ReservationManagementSystem.php');
            
        $rms = new ReservationManagementSystem();        
        
        if (isset($_POST["goon"])) {           
            
            if (!isset($_SESSION["currentReservation"])) {
                $_SESSION["currentReservation"] = new Reservation();
            }

            $_SESSION["currentReservation"]->setUserId($_SESSION["currentUser"]->getUserId());

            $startDateForm = htmlspecialchars($_POST["start"]);
            $startDate = date_create($startDateForm);
            $_SESSION["currentReservation"]->setStartDate($startDate);

            $endDateForm = htmlspecialchars($_POST["end"]);            
            $endDate = date_create($endDateForm);
            $_SESSION["currentReservation"]->setEndDate($endDate);

            $dateDiff = date_diff($startDate,$endDate);           
            
            $dateDiffIsPositive = ($dateDiff->invert===0);            

            $dateOfToday = date_create(date('Y-m-d'));

            #echo "date of today: " . date("d.m.Y", date_timestamp_get($dateOfToday)); 

            $startDateIsTodayOrLater = (date_diff($dateOfToday,$startDate)->invert===0);
            
            $numOfPers = htmlspecialchars($_POST["numOfPers"]);
            $_SESSION["currentReservation"]->setNumOfPersons($numOfPers);
            
            if($dateDiffIsPositive && $startDateIsTodayOrLater) {                
                $_SESSION["availableRoomTypes"] = $rms->checkRoomAvailability($startDateForm, $endDateForm, $numOfPers);                
            } else {
                $isvalidInput=FALSE;
            }
        }

        if ((isset($_POST["goon2"]) || isset($_POST["goback"])) && $_SESSION["availableRoomTypes"] != null) {
            
            $roomType = htmlspecialchars($_POST["roomType"]);
            $_SESSION["roomType"] = $roomType;
            
            $breakfast = 0;

            if (isset($_POST["breakfast"]) && htmlspecialchars($_POST["breakfast"]) === "yes") {
                $breakfast = 1;                                                       
            }    

            $_SESSION["currentReservation"]->setHasBreakfast($breakfast);

            $numOfParkingLots = htmlspecialchars($_POST["numOfParkLots"]);
            $_SESSION["currentReservation"]->setNumOfParkingLots($numOfParkingLots);
            
            $numOfPets = htmlspecialchars($_POST["numOfPets"]);
            $_SESSION["currentReservation"]->setNumOfPets($numOfPets);
            
            $commentText = htmlspecialchars($_POST["commentText"]);
            $_SESSION["currentReservation"]->setComment($commentText);

            $roomId = $rms->getAvailableRoomId($_SESSION["currentReservation"], $roomType);            
            $_SESSION["currentReservation"]->setRoomId($roomId);
          
        }

        if (isset($_POST["confirmRes"])) {

            #save reservation in database

            if(isset($_SESSION["currentReservation"]) && $rms->addReservationToDatabase($_SESSION["currentReservation"])) {

            unset($_SESSION["currentReservation"]);
            unset($_SESSION["availableRoomTypes"]);
            unset($_SESSION["roomType"]);

            }
        }
    }

?>