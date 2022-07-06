<?php

class User {
    public $id;
    public $name;
    public $birthdate;
    public $photo;
    public $descrition;
    public $lastconnection;
    
}

interface UserInterface {
    public function getUserById();
}




?>