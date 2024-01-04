<?php

namespace reservationManagement;

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

    /**
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @return date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return int
     */
    public function getNumOfPersons()
    {
        return $this->numOfPersons;
    }

    /**
     * @return boolean
     */
    public function hasBreakfast()
    {
        return $this->hasBreakfast;
    }

    /**
     * @return int
     */
    public function getNumOfParkingLots()
    {
        return $this->numOfParkingLots;
    }

    /**
     * @return int
     */
    public function getNumOfPets()
    {
        return $this->numOfPets;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}