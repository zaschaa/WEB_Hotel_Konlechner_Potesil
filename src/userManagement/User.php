<?php
namespace userManagement;

class User {
    public $name = "defaultName";
    public $password = "password";

    public function hasNameAndPassword($nameToCompare, $passwordToCompare)
    {
        return $this->name === $nameToCompare
            && $this->password === $passwordToCompare;
    }

    // This method echos name and password of a user.
    // It exists only for experimentation purposes and should never be used in actual code (duh)
    public function getUserData()
    {
        return 'Name: ' . $this->name . ' Password: ' . $this->password;
    }
}