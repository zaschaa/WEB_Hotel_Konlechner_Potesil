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


  
}