<?php

use userManagement\User as User;
use userManagement\UserManagementSystem;

require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$ums->calloutAllRegisteredUsersOnConsole();

$isValidRegistration = false;

/*
if (isset($_SESSION["currentUser"])) {
    header("Location: /userManagement/login/login_form.php");
    exit();
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $enteredSex =  $ums->prepareInput($_POST["sex"]);
        $enteredName = $ums->prepareInput($_POST["name"]);
        $enteredLastname = $ums->prepareInput($_POST["lastname"]);
        $enteredEmail = $ums->prepareInput($_POST["email"]);
        $enteredUsername = $ums->prepareInput($_POST["username"]);
        $enteredPassword1 = $ums->prepareInput($_POST["password"]);
        $enteredPassword2 = $ums->prepareInput($_POST["password2"]);

        $isValidRegistration = $ums->isValidRegistration($enteredEmail, $enteredUsername, $enteredPassword1, $enteredPassword2);     
        $emailErrMessage = $ums->getEmailErrMessage();
        $userNameErrMessage = $ums->getUserNameErrMessage();
        $pwErrMessage = $ums->getPwErrMessage();   

        if ($isValidRegistration) {
            $newUser = new User();
            $newUser->setAllValues(
                $enteredUsername,
                $enteredPassword1,
                $enteredSex,
                $enteredName,
                $enteredLastname,
                $enteredEmail
            );

            $ums->saveUserAsRegistered($newUser);
        }
        // ToDo: else { fail }
    }
}

?>