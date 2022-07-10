<?php

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $birthdate;
    public $photo;
    public $descrition;
    public $lastconnection;
    public $token;
    
}

interface UserInterface {
    public function getUserById($id);
    public function findByEmail($email);
    public function insert(User $user);

}




?>