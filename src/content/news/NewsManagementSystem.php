<?php

class NewsManagementSystem
{

    public function getAllNews()
    {
        if (isset($_SESSION["news"])) {
            return $_SESSION["news"];
        }
        return [];
    }
}