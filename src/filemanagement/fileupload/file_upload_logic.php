<?php
global $uploadPath;
$uploadPath = 'uploads/';

if (!file_exists($uploadPath)) {
    mkdir($uploadPath);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<script> console.log('File uploaded...' )</script>";
    if (isset($_FILES)) {
        // var_dump($_FILES);
        $fileDirection = $uploadPath . $_FILES["file"]["name"];

        if (file_exists($fileDirection)) {
            echo "<script> console.log('Fuck off Jimmy...' )</script>";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], $fileDirection);
        }
    }
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