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
    public $created_at;
    
}

interface UserInterface {
    public function findByEmail($email);
    public function findByToken($token);
    public function otherUsers();
    public function updateTokenByEmail($token, $email);
    public function update(User $info);
    public function searchUsers($name);
    public function getUserById($id);
    public function insert(User $user);

}




?>