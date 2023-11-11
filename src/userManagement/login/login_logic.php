<?php

session_start();

use userManagement\UserManagementSystem;
require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$ums->calloutAllRegisteredUsersOnConsole();

// ToDo: change this to work with  UMS

$user = [];
$user["Jim"] = "secretPW";
$user["Lea"] = "passwort";



$enteredUsername = htmlspecialchars($_POST["username"]);
$enteredPassword = htmlspecialchars($_POST["password"]);

if (!isset($_SESSION["username"])
    && $user[$enteredUsername] === $enteredPassword) {
    // means actually start or resume
    session_start();
    $_SESSION["username"] = $enteredUsername;


    $value = "Hi" . $_SESSION["username"];
    setcookie("FirstCookie", $value);


    $valueFromCookie = htmlspecialchars($_COOKIE["FirstCookie"]);
}

if (isset($_SESSION["username"])) {
    echo "Hello " . $_SESSION["username"];
}
?>
