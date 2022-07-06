<?php
require_once('../config.php');
require_once('../models/User.php');


class UserDao implements UserInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    public function formulateUser($data) {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->birthdate = $data['birthdate'];
        $user->photo = $data['photo'];
        $user->city = $data['description'];
        $user->lastconnection = $data['lastconnection'];

        return $user;

    }

    public function getUserById($id) {
        if(!empty($id)) {
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(':id');
            }
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $newUser = formulateUser($data);
            return $newUser;
        }
    }

    
}
?>