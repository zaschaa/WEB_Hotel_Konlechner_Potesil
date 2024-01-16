<?php

class NewsArticle
{
    private $imagePath;
    private $thumbnailPath;
    private $headline;
    private $description;
    private $id;
    private $createdAt;
    private $userId;

    /**
     * @param $imagePath
     * @param $thumbnailPath
     * @param $headline
     * @param $description
     */
    public function __construct($id, $user_id, $headline, $description, $imagePath, $thumbnailPath, $created_at)
    {       
        $this->id = $id;
        $this->userId = $user_id;
        $this->headline = $headline;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->thumbnailPath = $thumbnailPath;
        $this->createdAt = $created_at;        
    }


    /**
     * @return string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedAtDateTimeString()
    {        
        return date("d.m.Y H:s", date_timestamp_get($this->createdAt));
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

}