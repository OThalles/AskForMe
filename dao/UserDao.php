<?php
require_once('models/User.php');


class UserDao implements UserInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    private function formulateUser($data) {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->birthdate = $data['birthdate'];
        $user->photo = $data['photo'];
        $user->city = $data['description'];
        $user->lastconnection = $data['lastconnection'];
        $user->token = $data['token'];

        return $user;

    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(':email', $email);
        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert(User $user) {
        $sql = $this->pdo->prepare("INSERT INTO users(name,email,password,birthdate,token) VALUES (:name, :email, :password, :birthdate,:token)");
        $sql->bindValue(':name', $user->name);
        $sql->bindValue(':email', $user->email);
        $sql->bindValue(':password', $user->password);
        $sql->bindValue(':birthdate', $user->birthdate);
        $sql->bindValue(':token', $user->token);
        $sql->execute();
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