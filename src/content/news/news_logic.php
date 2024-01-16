<?php
require_once "./NewsArticle.php";
require_once "./NewsManagementSystem.php";

$nms = new NewsManagementSystem();

function getAndFormatAllNewsArticles() {
    global $nms;
    $newsArticleList = $nms->getAllNews();
    if (empty($newsArticleList)) {
        echo "<p class=\"mb-3\">Sie sind am neuesten Stand, denn es gibt keinerlei Neuigkeiten!</p>";
    }

    return $newsArticleList;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    if(isset($_POST["delete"])){
        $nms->deleteNewsArticle($_POST["delete"]);
    }
}