<?php

use userManagement\UserManagementSystem;
require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$ums->calloutAllRegisteredUsersOnConsole();

// ToDo: change this to work with  UMS

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"]) && $_POST["submit"] == 'login') {
        echo "<script>console.log(' Logging in... ' );</script>";

        $enteredUsername = htmlspecialchars($_POST["username"]);
        $enteredPassword = htmlspecialchars($_POST["password"]);

        if (!isset($_SESSION["username"])
            && $ums->isRegisteredUser($enteredUsername, $enteredPassword)) {

            $_SESSION["username"] = $enteredUsername;
            setcookie("FirstCookie", $_SESSION["username"]);

            echo "<script>console.log(' Logged in as $enteredUsername' );</script>";

            // $valueFromCookie = htmlspecialchars($_COOKIE["FirstCookie"]);
        } else {
            echo "<script>console.log(' Please check if you are already logged in or your input!' );</script>";
        }
    }


    if (isset($_POST["submit"]) && $_POST["submit"] == 'logout') {
        echo "<script>console.log(' Logging out... ' );</script>";
        session_destroy();
        session_abort();
        echo "<script>console.log(' Session has been closed ' );</script>";
    }
}

