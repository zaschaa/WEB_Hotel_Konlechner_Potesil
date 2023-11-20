<?php

namespace userManagement;
require_once 'User.php';

class UserManagementSystem
{   

    private $emailErrMessage;
    private $userNameErrMessage;
    private $pwErrMessage;    

    /**
     * @return string
     */
    public function getEmailErrMessage()
    {   
        return $this->emailErrMessage;        
    }

    /**
     * @return string
     */
    public function getUserNameErrMessage()
    {
        return $this->userNameErrMessage;        
    }

    /**
     * @return string
     */
    public function getPwErrMessage()
    {
        return $this->pwErrMessage;
    }

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

    private function isRegisteredUser($usernameToCheck)
    {        
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            if($registeredUser->getUsername() === $usernameToCheck) {                
                return true;
            }
        }
        return false;
    }

    private function isRegisteredEmail($emailToCheck)
    {      
        foreach ($_SESSION["registeredUsers"] as $registeredUser) {
            if($registeredUser->getEmail() === $emailToCheck) {                
                return true;    
            }             
        }
        return false;
    }
        
    public function isValidEmail($email) 
    {        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {        
            $this->emailErrMessage = "Ungültiges E-Mail-Format!";
            return false;
        } else if($this->isRegisteredEmail($email)) {
            $this->emailErrMessage = "Die E-Mail-Adresse wurde bereits registriert!";
            return false;
        } else {
            return true;
        }
    }

    private function isValidUsername($username) 
    {        
        if(strlen($username)<5) {       
            $this->userNameErrMessage = "Der Username muss mindestens 5 Zeichen lang sein!";
            return false;
        } else if ($this->isRegisteredUser($username)) {
            $this->userNameErrMessage = "Der Username existiert bereits!";
            return false;
        } else {
            return true;
        }
    }

    public function isValidPassword($password1, $password2) 
    {        
        if(strlen($password1)<8) {        
            $this->pwErrMessage = "Das Passwort muss mindestens 8 Zeichen lang sein!";
            return false;
        } else if ($password1 !== $password2) {
            $this->pwErrMessage = "Die Passwörter stimmen nicht überein!";
            return false;
        } else {
            return true;
        }
    }   

    public function isValidRegistration($email, $username, $password1, $password2) {        
        return $this->isValidEmail($email) && $this->isValidUsername($username) && $this->isValidPassword($password1, $password2);
    }  

    public function prepareInput($data) {
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);    
        return $data;
    }

}