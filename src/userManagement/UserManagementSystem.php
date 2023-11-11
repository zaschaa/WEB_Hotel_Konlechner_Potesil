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

    // this might not be optimal, has we have to iterate over each registered user
    // but in actual code, this would be done in an SQL anyway and therefore this is only a quick and dirty replacement
    public function isRegisteredUser($username, $password)
    {
        $isRegisteredUser = false;
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            $isRegisteredUser = $registeredUser->hasNameAndPassword($username, $password);
        }
        return $isRegisteredUser;
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