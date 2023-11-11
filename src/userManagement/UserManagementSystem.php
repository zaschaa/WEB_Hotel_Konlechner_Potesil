<?php

namespace userManagement;
require_once 'User.php';

class UserManagementSystem
{

    public function initializeUserRegistration()
    {
        session_start();

        if (!isset($_SESSION["registeredUsers"])) {
            $initUser = new User();

            $_SESSION["registeredUsers"] = [$initUser];
        }
    }

    // logs all currently registered users with name and password
    public function calloutAllRegisteredUsersOnConsole()
    {
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            $registeredUserDate = $registeredUser->getUserData();
            echo "<script>console.log(' $registeredUserDate ' );</script>";
        }
    }
}