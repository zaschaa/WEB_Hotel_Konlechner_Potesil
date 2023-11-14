<?php

use userManagement\User as User;
use userManagement\UserManagementSystem;

require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$ums->calloutAllRegisteredUsersOnConsole();

if (isset($_SESSION["currentUser"])) {
    header("Location: /userManagement/login/login_form.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $enteredSex =  htmlspecialchars($_POST["sex"]);
        $enteredName = htmlspecialchars($_POST["name"]);
        $enteredLastname = htmlspecialchars($_POST["lastname"]);
        $enteredEmail = htmlspecialchars($_POST["email"]);
        $enteredUsername = htmlspecialchars($_POST["username"]);
        $enteredPassword1 = htmlspecialchars($_POST["password"]);
        $enteredPassword2 = htmlspecialchars($_POST["password2"]);

        if ($enteredPassword1 === $enteredPassword2) {
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