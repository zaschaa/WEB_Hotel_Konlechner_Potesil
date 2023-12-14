<?php
require_once "./NewsArticle.php";
require_once "./NewsManagementSystem.php";

$nms = new NewsManagementSystem();
if (!isset($_SESSION["news"])) {
    $_SESSION["news"] = [];
}


function getAndFormatAllNewsArticles() {
    global $nms;
    $newsArticleList = $nms->getAllNews();
    if (empty($newsArticleList)) {
        echo "Sie sind am neuesten Stand, denn es gibt keinerlei Neuigkeiten!";
    }

    return $newsArticleList;
}