<?php

namespace userManagement;

class UserRepository
{

    public function getUserByUsername($usernameToCheck): User
    {
        require '../../database/dbaccess.php';
        $sqlSelect = "SELECT * FROM users WHERE username = ?";
        # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!

        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("s", $usernameToCheck); # character "s" is used due to placeholders of type String

        $fetchedUser = $this->fetchAndBindResult($statement);
        $connection->close();
        return $fetchedUser;
    }

    private function fetchAndBindResult($statement): User
    {
        $statement->execute();
        $statement->bind_result($id, $uName, $password, $sex, $fname, $lname, $email, $isAdmin);
        $statement->fetch();

        $statement->close();

        return User::of( # use constructor-like method to create new instance of user
            $id,    
            $uName,
            $password,
            $sex,
            $fname,
            $lname,
            $email,
            $isAdmin
        );
    }

    public function getHashedPasswordForUsername($usernameToCheck): string
    {
        require '../../database/dbaccess.php';
        # Prepared statement
        $sqlInsert = "SELECT password FROM users WHERE username = ?";

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $usernameToCheck);

        $statement->execute();
        $statement->bind_result($password);
        $statement->fetch();

        $statement->close();
        $connection->close();

        return $password;
    }

    public function addUserToDatabase(User $user)
    {
        $userName = $user->getUsername();
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $sex = $user->getSex();
        $firstname = $user->getName();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        
        require '../../database/dbaccess.php';
        $sqlInsert = "INSERT INTO users (username, password, sex, firstname, lastname, email) VALUES (?,?,?,?,?,?)";
        
        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param(
            "ssssss", 
            $userName,
            $password,
            $sex,
            $firstname,
            $lastname,
            $email
        );

        $statement->execute();
        $statement->close();
        $connection->close();
    }

    public function countUsersByUsername($usernameToCheck)
    {
        $sqlInsert = "SELECT COUNT(*) FROM users WHERE username = ?";

        return $this->prepareAndExecuteCountForSqlStatementWithBoundStringParameter($sqlInsert, $usernameToCheck);
    }

    public function countUsersByEmail($emailToCheck)
    {
        $sqlInsert = "SELECT COUNT(*) FROM users WHERE email = ?";

        return $this->prepareAndExecuteCountForSqlStatementWithBoundStringParameter($sqlInsert, $emailToCheck);
    }

    private function prepareAndExecuteCountForSqlStatementWithBoundStringParameter(
        string $sqlInsert,
        string $stringValueToCheck
    ) {
        require '../../database/dbaccess.php';
        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("s", $stringValueToCheck);

        $statement->execute();
        $statement->bind_result($count);
        $statement->fetch();

        $statement->close();
        $connection->close();
        return $count;
    }


}