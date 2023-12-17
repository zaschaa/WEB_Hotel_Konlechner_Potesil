<?php

namespace userManagement;
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

    private function addUserToDatabase($user)
    {      
        require '../../database/dbaccess.php';

        # Prepared statement
        $sqlInsert = "INSERT INTO users (username, password, sex, firstname, lastname, email) VALUES (?,?,?,?,?,?)";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("ssssss", $username, $passwd, $sex, $fname, $lname, $email); # character "s" is used due to placeholders of type String

        $username = $user->getUsername();
        $passwd = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $sex = $user->getSex();
        $fname = $user->getName();
        $lname = $user->getLastname();
        $email= $user->getEmail();

        if ($statement->execute()) {
            //echo "<h1>Success!</h1>";
        } else {
            //echo "<h1>Failed to insert!</h1>";
        }

        $statement->close();
        $connection->close();
    }

    public function saveUserAsRegistered(User $user)
    {
        if (!$this->isRegisteredUser($user->getUsername())) {
            $this->addUserToDatabase($user);
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
    public function isRegisteredUserWithCorrectPassword($usernameToCheck, $passwordToCheck)
    {
        require '../../database/dbaccess.php';        
       
        # Prepared statement
        $sqlInsert = "SELECT password FROM users WHERE username = ?";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $username); # character "s" is used due to placeholders of type String

        $username = $usernameToCheck;

        $statement->execute();

        $statement->bind_result($password);

        $statement->fetch();

        $statement->close();
        $connection->close();
        
        if(password_verify($passwordToCheck, $password)) {
            return true;
        } 

        return false;
    }

    public function getUserByUsername($usernameToCheck)
    {
        require '../../database/dbaccess.php';        
       
        # Prepared statement
        $sqlInsert = "SELECT * FROM users WHERE username = ?";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $username); # character "s" is used due to placeholders of type String

        $username = $usernameToCheck;

        $statement->execute();

        $statement->bind_result($id, $uName, $password, $sex, $fname, $lname, $email, $isAdmin);

        $statement->fetch();

        $statement->close();
        $connection->close();

        $user = new user();

        $user->setAllValues($uName, $password, $sex, $fname, $lname, $email, $isAdmin);
        
        return $user;        
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
        require '../../database/dbaccess.php';        
       
        # Prepared statement
        $sqlInsert = "SELECT COUNT(*) FROM users WHERE username = ?";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $username); # character "s" is used due to placeholders of type String

        $username = $usernameToCheck;

        $statement->execute();

        $statement->bind_result($count);

        $statement->fetch();

        $statement->close();
        $connection->close();

        if($count === 1) {                
            return true;
        }     
        
        return false;               
    }

    public function isRegisteredEmail($emailToCheck)
    {      
        require '../../database/dbaccess.php';        
       
        # Prepared statement
        $sqlInsert = "SELECT COUNT(*) FROM users WHERE email = ?";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $email); # character "s" is used due to placeholders of type String

        $email = $emailToCheck;

        $statement->execute();

        $statement->bind_result($count);

        $statement->fetch();

        $statement->close();
        $connection->close();

        if($count >= 1) {                
            return true;
        }     
        
        return false;   
    }
}