<?php
require_once "./NewsManagementSystem.php";

$nms = new NewsManagementSystem();


$newsArticleList = $nms->getAllNews();

if (empty($newsArticleList)) {
    echo "Sie sind am neuesten Stand, denn es gibt keinerlei Neuigkeiten!";
}

foreach ($newsArticleList as $newsArticle) {
    echo "There is a new";
}