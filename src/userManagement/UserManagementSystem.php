<?php

namespace userManagement;
require_once 'User.php';
require_once 'UserRepository.php';

class UserManagementSystem
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }
 
    public function saveUserAsRegistered(User $user)
    {
        if (!$this->isRegisteredUser($user->getUsername())) {
            $this->repository->addUserToDatabase($user);
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

    public function isRegisteredUserWithCorrectPassword($usernameToCheck, $passwordToCheck)
    {
        $hashedPasswordFromDb = $this->repository->getHashedPasswordForUsername($usernameToCheck);

        if (password_verify($passwordToCheck, $hashedPasswordFromDb)) {
            return true;
        }

        return false;
    }

    public function getUserByUsername($usernameToCheck)
    {
        return $this->repository->getUserByUsername($usernameToCheck);
    }

    public function isRegisteredUser($usernameToCheck): bool
    {
        $count = $this->repository->countUsersByUsername($usernameToCheck);

        return $count > 0;
    }

    public function isRegisteredEmail($emailToCheck): bool
    {
        $count = $this->repository->countUsersByEmail($emailToCheck);

        return $count > 0;
    }
}