<?php

class Reservation
{
    private $id;
    private $userId;
    private $roomId;
    private $startDate;
    private $endDate;
    private $numOfPersons;
    private $hasBreakfast;
    private $numOfParkingLots;
    private $numOfPets;
    private $comment;
    private $state;
    private $createdAt; 

    public static function of($res_id, $user_id, $room_id, $start_date, $end_date, $num_of_persons, $has_breakfast, $num_of_parking_lots, $number_of_pets, $res_comment, $res_state, $created_at): Reservation
    {
        $res = new Reservation();
        $res->id = $res_id;
        $res->userId = $user_id;
        $res->roomId = $room_id;
        $res->startDate = $start_date;
        $res->endDate = $end_date;
        $res->numOfPersons = $num_of_persons;
        $res->hasBreakfast = $has_breakfast;
        $res->numOfParkingLots = $num_of_parking_lots;
        $res->numOfPets = $number_of_pets;
        $res->comment = $res_comment;
        $res->state = $res_state;
        $res->createdAt = $created_at;

        return $res;
    }
  
    /**
     * @return int
     */
    public function getResId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($user_id)
    {
        $this->userId = $user_id;
    }

    /**
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    public function setRoomId($room_id)
    {
        $this->roomId =$room_id;
    }

    /**
     * @return date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getStartDateStringISO()
    {
        return date("Y-m-d", date_timestamp_get($this->startDate));
    }

    /**
     * @return string
     */
    public function getStartDateStringGerman()
    {
        return date("d.m.Y", date_timestamp_get($this->startDate));
    }

    public function setStartDate($start_date)
    {
        $this->startDate = $start_date;
    }

    /**
     * @return date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getEndDateStringISO()
    {
        return date("Y-m-d", date_timestamp_get($this->endDate));
    }

    /**
     * @return string
     */
    public function getEndDateStringGerman()
    {
        return date("d.m.Y", date_timestamp_get($this->endDate));
    }

    public function setEndDate($end_date)
    {
        $this->endDate = $end_date;
    }
    
    /**
     * @return int
     */
    public function getNumOfNights()
    {
        $dateDiff = date_diff($this->startDate, $this->endDate);        
        return $dateDiff->format("%a");;
    }

    /**
     * @return int
     */
    public function getNumOfPersons()
    {
        return $this->numOfPersons;
    }

    public function setNumOfPersons($num_of_persons)
    {
        $this->numOfPersons = $num_of_persons;
    }

    /**
     * @return boolean
     */
    public function hasBreakfast()
    {
        return $this->hasBreakfast;
    }

    /**
     * @return string
     */
    public function hasBreakfastYesOrNo()
    {
        if($this->hasBreakfast === 0){
            return "Nein";
        } elseif($this->hasBreakfast === 1) {
            return "Ja";
        }
        return "-";
    }

    public function setHasBreakfast($has_breakfast)
    {
        $this->hasBreakfast = $has_breakfast;
    }

    /**
     * @return int
     */
    public function getNumOfParkingLots()
    {
        return $this->numOfParkingLots;
    }

    public function setNumOfParkingLots($num_of_parking_lots)
    {
        $this->numOfParkingLots = $num_of_parking_lots;
    }

    /**
     * @return int
     */
    public function getNumOfPets()
    {
        return $this->numOfPets;
    }

    public function setNumOfPets($number_of_pets)
    {
        $this->numOfPets = $number_of_pets;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($res_comment)
    {
        $this->comment = $res_comment;
    }
    
    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    public function setState($res_state)
    {
        $this->state = $res_state;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

     /**
     * @return string
     */
    public function getRoomType()
    {
        require_once('../../reservationManagement/ReservationManagementSystem.php');
            
        $rms = new ReservationManagementSystem();
        $roomType = $rms->getRoomTypeByRoomId($this->roomId);

        return $roomType;        
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {   
        require_once('../../reservationManagement/ReservationManagementSystem.php');
            
        $rms = new ReservationManagementSystem();

        $charged_options = $rms->getChargedOptions();

        $pricePerBreakfast = $charged_options["breakfast"];
        $pricePerParkingLot = $charged_options["parking lot"];
        $pricePerPet = $charged_options["pet"];

        $roomTypeInfo = $rms->getRoomTypeInfo($this->getRoomType());

        $numOfNights = $this->getNumOfNights();

        $roomPrice = $roomTypeInfo->getPrice() * $numOfNights * $this->numOfPersons;
         
        $breakfastPrice = $pricePerBreakfast * $numOfNights * $this->numOfPersons;

        $parkingLotsPrice = $pricePerParkingLot * $this->numOfParkingLots * $numOfNights;

        $petsPrice = $pricePerPet * $this->numOfPets * $numOfNights;

        $totalPrice = number_format($roomPrice + $breakfastPrice + $parkingLotsPrice + $petsPrice, 2, "," , ".");

        return $totalPrice;
    }


}