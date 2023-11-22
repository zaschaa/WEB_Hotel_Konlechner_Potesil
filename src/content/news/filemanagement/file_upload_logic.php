<?php
global $uploadPath;

require_once "./NewsArticle.php";
use content\news\NewsArticle as NewsArticle;

$uploadPath = 'uploads/';
$thumbnailPath = 'thumbnails/';

if (!isset($_SESSION)) {
    session_start();
}

if (!file_exists($uploadPath)) {
    mkdir($uploadPath);
}
if (!file_exists($thumbnailPath)) {
    mkdir($thumbnailPath);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["file"]["name"])) {
        echo "<script> console.log('File uploaded...' )</script>";
        $fileName = $_FILES["file"]["name"];
        $fileDirection = $uploadPath . $fileName;
        $thumbnailDirection = $thumbnailPath . 'thumbnail_' . $fileName;

        if (file_exists($fileDirection)) {
            echo "<script> console.log('Fuck off Jimmy...' )</script>";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], $fileDirection);
            createThumbnail($fileDirection, $fileName);

            createNewsArticle($fileDirection, $thumbnailDirection);
        }
    }
}

function createNewsArticle($fileDirection, $thumbnailDirection)
{
    $headline = htmlspecialchars($_POST["headline"]);
    $description = htmlspecialchars($_POST["description"]);

    $newsArticle = new NewsArticle($fileDirection, $thumbnailDirection, $headline, $description);
    $_SESSION["news"][] = $newsArticle;
}

function listAllFilesInDirectory()
{
    global $uploadPath;
    $files = scandir($uploadPath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li> $file </li>";
        }
    }
}

function createThumbnail($imagePath, $fileName) {
    global $thumbnailPath;
    $resizedImage = resizeImage($imagePath, 200, 200);
    imagejpeg($resizedImage, $thumbnailPath . 'thumbnail_' . $fileName);
}

function resizeImage($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}