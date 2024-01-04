<?php

    if(isset($_POST["roomType"])) {
        require '../../database/dbaccess.php';

        $roomType = htmlspecialchars($_POST["roomType"]);           
        
        echo "<h2>$roomType</h2>";            
    }

?>