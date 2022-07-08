<?php
require_once 'dao/UserDao.php';

class Auth {
    private $pdo;
    private $base;
    private $dao;


    public function __construct(PDO $pdo, $base) {
        $this->pdo = $pdo;
        $this->base = $base;
        $this->dao = new UserDao($this->pdo);
    }



    public function EmailExists($email) {
        return $this->dao->findByEmail($email) ? true : false;
    }

    public function registerUser($name, $email, $password, $birthdate) {
        $newUser = new User();

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999));

        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->birthdate = $birthdate;
        $newUser->token = $token;

        $this->dao->insert($newUser);
        $_SESSION['token'] = $token;

        
    }
}