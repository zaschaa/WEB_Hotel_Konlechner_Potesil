<?php

namespace userManagement;
require_once 'User.php';
require_once 'User.php';

class UserManagementSystem
{

    public function initializeUserRegistration()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION["registeredUsers"])) {
            $initUser = new User();

            $_SESSION["registeredUsers"] = [$initUser];
        }
    }

    public function saveUserAsRegistered(User $user)
    {
        if (!$this->isRegisteredUser($user->getUsername())) {
            $_SESSION["registeredUsers"][] = $user;
        } else {
            echo "<script>console.log(' User with Username $user->getUsername() already exists ' );</script>";
        }
    }

    public function updateUser(User $updatedUser)
    {
        if ($this->isRegisteredUser($updatedUser->getUsername())) {
            $userToUpdate = $this->getUserByUsername($updatedUser->getUsername());

            $key = array_search($userToUpdate, $_SESSION["registeredUsers"]);
            if ($key !== false) {
                unset($_SESSION["registeredUsers"][$key]);
            }

            $_SESSION["registeredUsers"][] = $updatedUser;
        } else {
            echo "<script>console.log(' User with Username $updatedUser->getUsername() does not exist ' );</script>";
        }
    }

    // this might not be optimal, has we have to iterate over each registered user
    // but in actual code, this would be done in an SQL anyway and therefore this is only a quick and dirty replacement
    public function isRegisteredUserWithCorrectPassword($username, $password)
    {
        $isRegisteredUser = false;
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            $isRegisteredUser = $isRegisteredUser || $registeredUser->hasUsernameAndPassword($username, $password);
        }
        return $isRegisteredUser;
    }

    public function getUserByUsername($username)
    {
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            if ($registeredUser->getUsername() === $username) {
                return $registeredUser;
            }
        }
        return null;
    }

    // logs all currently registered users with name and password
    public function calloutAllRegisteredUsersOnConsole()
    {
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            $registeredUserDate = $registeredUser->getUserData();
            echo "<script>console.log(' $registeredUserDate ' );</script>";
        }
    }

    public function isRegisteredUser($usernameToCheck)
    {        
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            if($registeredUser->getUsername() === $usernameToCheck) {                
                return true;
            }
        }
        return false;
    }

    public function isRegisteredEmail($emailToCheck)
    {      
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            if($registeredUser->getEmail() === $emailToCheck) {                
                return true;    
            }             
        }
        return false;
    }
}