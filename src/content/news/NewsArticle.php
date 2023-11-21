<?php

namespace content\news;
class NewsArticle
{
    private $imagePath;
    private $thumbnailPath;
    private $headline;
    private $description;

    /**
     * @param $imagePath
     * @param $thumbnailPath
     * @param $headline
     * @param $description
     */
    public function __construct($imagePath, $thumbnailPath, $headline, $description)
    {
        $this->imagePath = $imagePath;
        $this->thumbnailPath = $thumbnailPath;
        $this->headline = $headline;
        $this->description = $description;
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
}