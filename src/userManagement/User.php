<?php

namespace userManagement;

class User
{

    private $username = "admin";
    private $password = "admin";
    private $sex = "Herr";
    private $name = "Admin";
    private $lastname = "LeBoss";
    private $email = "chef.admin@mailmail.com";
    private $isAdmin = true;

    public function setAllValues($username, $password, $sex, $name, $lastname, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->sex = $sex;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->isAdmin = false;
    }

    public static function of($username, $password, $sex, $name, $lastname, $email, $isAdmin): User
    {
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->sex = $sex;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->isAdmin = $isAdmin;
        return $user;
    }

    public function hasUsernameAndPassword($usernameToCompare, $passwordToCompare)
    {
        return $this->username === $usernameToCompare
            && $this->password === $passwordToCompare;
    }

    // This method echos name and password of a user.
    // It exists only for experimentation purposes and should never be used in actual code (duh)
    public function getUserData()
    {
        return 'Name: ' . $this->username . ' Password: ' . $this->password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }
}