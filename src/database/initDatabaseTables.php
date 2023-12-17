<?php
require_once "dbaccess.php";

if (
    !isset($dbHost)
    || !isset($dbUsername)
    || !isset($dbPassword)
    || !isset($dbName)
) {
    return;
}

// Create connection
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// sql to create table
$tableSqlList = [
    "CREATE TABLE `users` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
        `password` VARCHAR(250) NOT NULL COLLATE 'utf8mb4_general_ci',
        `sex` ENUM('Keine','Herr','Frau') NOT NULL DEFAULT 'Keine' COLLATE 'utf8mb4_general_ci',
        `firstname` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
        `lastname` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
        `email` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
        `is_admin` TINYINT(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`) USING BTREE,
        UNIQUE INDEX `idx_username` (`username`) USING BTREE
    )
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB;"
];

foreach ($tableSqlList as $tableSql) {
    try {
        if ($connection->query($tableSql) === TRUE) {
            echo "<script>console.log('Created table using:" . $tableSql . "');</script>";
        } else {
            echo '<script>console.log("Error creating table: '
                . $connection->error
                . '");</script>';
        }
    } catch (mysqli_sql_exception $mysqli_sql_exception) {
        echo '<script>console.log("Error creating table: '
            . $mysqli_sql_exception->getMessage()
            . '");</script>';
    }
}