<?php

namespace content\news;
class NewsArticle
{
    private $imagePath;
    private $thumbnailPath;
    private $headline;
    private $description;
    private $id;

    /**
     * @param $imagePath
     * @param $thumbnailPath
     * @param $headline
     * @param $description
     */
    public function __construct($imagePath, $thumbnailPath, $headline, $description)
    {
        $id = isset($_SESSION["news"]) ? sizeof($_SESSION["news"]) : 0;

        $this->imagePath = $imagePath;
        $this->thumbnailPath = $thumbnailPath;
        $this->headline = $headline;
        $this->description = $description;
        $this->id = $id;
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
}