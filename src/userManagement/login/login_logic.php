<?php

use userManagement\UserManagementSystem;

require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$ums->calloutAllRegisteredUsersOnConsole();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"]) && $_POST["submit"] == 'login') {
        echo "<script>console.log(' Logging in... ' );</script>";

        $enteredUsername = htmlspecialchars($_POST["username"]);
        $enteredPassword = htmlspecialchars($_POST["password"]);

        if (!isset($_SESSION["currentUser"])
            && $ums->isRegisteredUserWithCorrectPassword($enteredUsername, $enteredPassword)) {

            $loggedInUsername = $ums->getUserByUsername($enteredUsername);
            $_SESSION["currentUser"] = $loggedInUsername;

            setcookie("LOGON_USER", $_SESSION["currentUser"]->getUsername(), time()+31557500, '/');

            echo "<script>console.log(' Logged in as $enteredUsername' );</script>";
        } else {
            echo "<script>console.log(' Please check if you are already logged in or your input!' );</script>";
        }
    }


    if (isset($_POST["submit"]) && $_POST["submit"] == 'logout') {
        echo "<script>console.log(' Logging out... ' );</script>";
        // Session also holds the registered users, and therefore it is more practical to only unset the current user
        unset($_SESSION["currentUser"]);
        setcookie('LOGON_USER', '', -1, '/');
        echo "<script>console.log(' Session has been closed ' );</script>";
    }
}