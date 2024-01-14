<?php

class RoomType
{
    private $id;
    private $name;
    private $picFilePathName;
    private $roomSize;
    private $bedType;
    private $bedWidth;
    private $bedLength;
    private $hasMinibar;
    private $price;    

    public static function of($rt_id, $rt_name, $rt_picFilePathName, $rt_roomSize, $rt_bedType, $rt_bedWidth, $rt_bedLength, $rt_hasMinibar, $rt_price): RoomType
    {
        $rt = new RoomType();
        $rt->id = $rt_id;
        $rt->name = $rt_name;
        $rt->picFilePathName = $rt_picFilePathName;
        $rt->roomSize = $rt_roomSize;
        $rt->bedType = $rt_bedType;
        $rt->bedWidth = $rt_bedWidth;
        $rt->bedLength = $rt_bedLength;
        $rt->hasMinibar = $rt_hasMinibar;
        $rt->price = $rt_price;       

        return $rt;
    }

  
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getpicFilePathName()
    {
        return $this->picFilePathName;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->roomSize;
    }

    /**
     * @return string
     */
    public function getBedType()
    {
        return $this->bedType;
    }

    /**
     * @return int
     */
    public function getBedWidth()
    {
        return $this->bedWidth;
    }   

    /**
     * @return int
     */
    public function getBedLength()
    {
        return $this->bedLength;
    }
    
    /**
     * @return int
     */
    public function getHasMinibar()
    {
        return $this->hasMinibar;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

}