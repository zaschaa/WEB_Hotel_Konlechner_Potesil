<?php

require_once 'Reservation.php';
require_once 'RoomType.php';

class ReservationManagementSystem
{
    public function getRoomTypeInfo($roomType): RoomType
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT RT.id, room_type_name, pic_filepath_name, room_size_range_square_meters, bed_type_name, width_cm, length_cm, has_minibar, price_per_person_per_night_eur
        FROM room_types AS RT
        LEFT JOIN bed_types AS BT
        ON RT.bed_type = BT.id
        WHERE room_type_name = ?;"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("s", $roomType); # character "s" is used due to placeholders of type String
        $statement->execute();
        $statement->bind_result($rtID, $rtName, $picFilepathName, $roomSize, $bedType, $bedWidth, $bedLength, $roomHasMinibar, $roomPrice);
        $statement->fetch();
        $statement->close();        
        $connection->close();

        return RoomType::of( # use constructor-like method to create new instance of RoomType
            $rtID,
            $rtName,
            $picFilepathName,
            $roomSize,
            $bedType,
            $bedWidth,
            $bedLength,
            $roomHasMinibar,
            $roomPrice
        );        
    }

    public function getChargedOptions()
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT id, option_name, price_per_unit_eur
        FROM charged_options;";

        $result = $connection->query($sqlSelect);

        $connection->close();

        $chargedOptions;

        foreach ($result as $row) {            
            $chargedOptions[$row['option_name']]=$row['price_per_unit_eur'];
        }

        $result->close();

        return $chargedOptions;        
    }

    public function getRoomTypeByRoomId($roomId)
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT room_type_name 
        FROM rooms AS R
        LEFT JOIN room_types AS RT
        ON R.room_type=RT.id
        WHERE R.id=$roomId;";

        $result = $connection->query($sqlSelect);
        $connection->close();  

        foreach ($result as $row) {            
            $rt = $row['room_type_name'];
        }
        
        $result->close();             

        return $rt;        
    }

    public function checkRoomAvailability($startDate, $endDate, $numOfPers)
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT DISTINCT room_type_name 
        FROM rooms AS R
        LEFT JOIN room_types AS RT
        ON R.room_type=RT.id
        WHERE capacity >= ?
        AND NOT R.id IN 
        (	SELECT room_id FROM reservations 
            WHERE (start_date <= ? AND end_date > ?)
                    OR
                    (start_date <= ? AND end_date > ?)
                    OR
                    (start_date >= ? AND end_date <= ?)
        );"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        

        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("issssss", $numOfPers, $startDate, $startDate, $endDate, $endDate, $startDate, $endDate);
        $statement->execute();
        $statement->bind_result($rt);

        $availableRT=array();
        
        while($statement->fetch()) { # fetch() goes on with next row of query result
            array_push($availableRT, $rt);
        }

        $statement->close();        
        $connection->close();

        return $availableRT;        
    }

    public function getAvailableRoomId(Reservation $res, $roomType)
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT R.id  
        FROM rooms AS R
        LEFT JOIN room_types AS RT
        ON R.room_type=RT.id
        WHERE capacity >= ?
        AND room_type_name = ?
        AND NOT R.id IN 
        (	SELECT room_id FROM reservations 
            WHERE (start_date <= ? AND end_date > ?)
                    OR
                    (start_date <= ? AND end_date > ?)
                    OR
                    (start_date >= ? AND end_date <= ?)
        );"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        

        $numOfPers = $res->getNumOfPersons();
        $startDate = $res->getStartDateStringISO();
        $endDate = $res->getEndDateStringISO();

        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("isssssss", $numOfPers , $roomType, $startDate, $startDate, $endDate, $endDate, $startDate, $endDate);
        $statement->execute();
        $statement->bind_result($roomId);
        $statement->fetch();       
        $statement->close();        
        $connection->close();

        return $roomId;        
    }

    public function addReservationToDatabase(Reservation $res)
    {
        require '../../database/dbaccess.php';            
        
        $sqlInsert = 
        "INSERT INTO `reservations` (`user_id`, `room_id`, `start_date`, `end_date`, `number_of_persons`, `has_breakfast`, `number_of_parking_lots`, `number_of_pets`, `comment`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        

        $userId = $res->getUserId();
        $roomId = $res->getRoomId();        
        $startDate = $res->getStartDateStringISO();
        $endDate = $res->getEndDateStringISO();
        $numOfPers = $res->getNumOfPersons();
        $hasBreakfast = $res->hasBreakfast();
        $numOfParkingLots = $res->getNumOfParkingLots();
        $numOfPets = $res->getNumOfPets();
        $comment = $res->getComment();

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("iissiiiis", $userId, $roomId, $startDate, $endDate, $numOfPers, $hasBreakfast, $numOfParkingLots, $numOfPets, $comment);
        $result = $statement->execute();
           
        $statement->close();        
        $connection->close();

        return $result;        
    }

    public function printUsersReservations(userManagement\User $user)
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT RE.id, U.firstname, U.lastname, RE.start_date, RE.end_date, RE.number_of_persons, RT.room_type_name, RO.room_number, RE.number_of_parking_lots, RE.number_of_pets, 
                RE.comment, RE.state, RE.created_at
         FROM reservations AS RE
         LEFT JOIN rooms AS RO
         ON RE.room_id = RO.id
         LEFT JOIN room_types AS RT
         ON RO.room_type = RT.id
         LEFT JOIN users AS U
         ON RE.user_id = U.id
         WHERE RE.user_id = ?;"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        

        $userId = $user->getUserId();
       
        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("i", $userId);
        $statement->execute();

        $statement->bind_result($id, $firstName, $lastName, $startDate, $endDate, $numOfPers, $roomTypeName, $roomNumber, $numOfParkingLots, $numOfPets, $comment, $state, $createdAt);
        
        echo "<table class=\"table mb-2\">";    
            # print header           
            echo "<tr>"; 
                echo "<th class=\"resOVth\">Reservierungs-Nr.</th>";
                echo "<th class=\"resOVth\">Anreisetag</th>";
                echo "<th class=\"resOVth\">Abreisetag</th>";                                                            
            echo "</tr>";

            echo "<tr>";           
                echo "<th class=\"resOVth\"></th>";
                echo "<th class=\"resOVth\">Anzahl Personen</th>";                        
                echo "<th class=\"resOVth\">Zimmer-Kategorie</th>";                                                
            echo "</tr>";

            echo "<tr>";           
                echo "<th class=\"resOVth\"></th>";  
                echo "<th class=\"resOVth\">Erstelldatum</th>";
                echo "<th class=\"resOVth\">Status</th>";                
            echo "</tr>";            

        while($statement->fetch()) { # fetch() goes on with next row of query result
            echo "<tbody class=\"table-group-divider\">";
                echo "<tr>";
                    echo "<td class=\"resOVth\">$id</td>";
                    $startDate = date("d.m.Y", date_timestamp_get(date_create($startDate)));
                    echo "<td class=\"resOVth\">$startDate</td>";
                    $endDate = date("d.m.Y", date_timestamp_get(date_create($endDate)));
                    echo "<td class=\"resOVth\">$endDate</td>";
                                            
                echo "</tr>";

                echo "<tr>";
                    echo "<td class=\"resOVth\"></td>";
                    echo "<td class=\"resOVth\">$numOfPers</td>";                
                    echo "<td class=\"resOVth\">$roomTypeName</td>";                                       
                echo "</tr>";

                echo "<tr>";
                    echo "<td class=\"resOVth\"></td>";
                    echo "<td class=\"resOVth\">$createdAt</td>";  

                    $state = $this->getResStateGerman($state);
                    
                    echo "<td class=\"resOVth\">$state</td>";                                   
                echo "</tr>";
            echo "</tbody>";
        }

        echo "</table>";  
    
        $statement->close();        
        $connection->close();
    }

    public function printAllReservations()
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT RE.id, U.firstname, U.lastname, RE.start_date, RE.end_date, RE.number_of_persons, RT.room_type_name, RO.room_number, RE.number_of_parking_lots, RE.number_of_pets, 
                RE.comment, RE.state, RE.created_at
         FROM reservations AS RE
         LEFT JOIN rooms AS RO
         ON RE.room_id = RO.id
         LEFT JOIN room_types AS RT
         ON RO.room_type = RT.id
         LEFT JOIN users AS U
         ON RE.user_id = U.id;";        
       
        $result = $connection->query($sqlSelect);             
            
            if ($result->num_rows > 0) {

                echo "<table class=\"table mb-2\">";    
                    # print header           
                    echo "<tr>"; 
                        echo "<th class=\"resOVth\">Reservierungs-Nr.</th>";
                        echo "<th class=\"resOVth\">Erstelldatum</th>";
                        echo "<th class=\"resOVth\">Status</th>"; 
                        echo "<th class=\"resOVth\"></th>";               
                    echo "</tr>";  

                    // output data of each row
                    while($row = $result->fetch_assoc()) {

                        $id = $row["id"];                        
                        $createdAt = $row["created_at"];
                        $state = $this->getResStateGerman($row["state"]);
                        
                        echo "<tr>";
                            echo "<td class=\"resOVth\">$id</td>";
                            echo "<td class=\"resOVth\">$createdAt</td>";
                            echo "<td class=\"resOVth\">$state</td>";                            
                            echo "<td class=\"resOVth\"><form method=\"post\" action=\"./../admin_reservationManagement/admin_reservation_management.php\"><button class=\"btn btn-primary\" type=\"submit\" name=\"getResDetailView\" id=\"getResDetailView\" value=\"$id\">Details</button></form></td>";                                   
                        echo "</tr>";
                        
                    }
                echo "</table>";

              } else {
                echo "Keine Reservierungen vorhanden!";
              }            
        
        $connection->close();
    }

    public function getResStateGerman($resState)
    {
        switch ($resState) {
            case "new":
                $stateGerman = "neu (=unbestätigt)";
            break;
            case "confirmed":
                $stateGerman = "bestätigt";
            break;
            case "cancelled":
                $stateGerman = "storniert";
            break;
            default: $stateGerman ="-";
        }

        return $stateGerman;
    }

    public function printReservationOverviewById($resId)
    {
        require '../../database/dbaccess.php';            
        
        $sqlSelect = 
        "SELECT RE.id, RE.user_id, RE.room_id, U.firstname, U.lastname, RE.start_date, RE.end_date, RE.number_of_persons, RE.has_breakfast, RT.room_type_name, RO.room_number, RE.number_of_parking_lots, RE.number_of_pets, 
                RE.comment, RE.state, RE.created_at
         FROM reservations AS RE
         LEFT JOIN rooms AS RO
         ON RE.room_id = RO.id
         LEFT JOIN room_types AS RT
         ON RO.room_type = RT.id
         LEFT JOIN users AS U
         ON RE.user_id = U.id
         WHERE RE.id = ?;"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!               
       
        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("i", $resId);
        $statement->execute();

        $statement->bind_result($id, $userId, $roomId, $firstName, $lastName, $startDate, $endDate, $numOfPers, $hasBreakfast, $roomTypeName, $roomNumber, $numOfParkingLots, $numOfPets, $comment, $state, $createdAt);                  

        $statement->fetch();    
        $statement->close();        
        $connection->close();    
        
        $res = Reservation::of( # use constructor-like method to create new instance of Reservation
            $id,    
            $userId, 
            $roomId, 
            date_create($startDate), 
            date_create($endDate), 
            $numOfPers,
            $hasBreakfast,
            $numOfParkingLots, 
            $numOfPets, 
            $comment, 
            $state, 
            $createdAt            
        );

        include '../admin_reservationManagement/reservation_detail_view.php';
    }

    public function updateResState($resId, $state)
    {
        require '../../database/dbaccess.php';            
        
        $sqlUpdate = 
        "UPDATE reservations
        SET state = ?
        WHERE id = ?;";
        
        $statement = $connection->prepare($sqlUpdate);
        $statement->bind_param("si", $state, $resId);
        $statement->execute();            
        $statement->close();        
        $connection->close();
    }
}

