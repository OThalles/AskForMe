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
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $user = $this->formulateUser($data);
            return $user;
        } 
        return false;
    }

    public function findByToken($token) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE token = :token");
        $sql->bindValue(':token', $token);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $user = $this->formulateUser($data);
            return $user;
        } else {
            return false;
        }
    }

    public function updateTokenByEmail($token, $email) {
        $sql = $this->pdo->prepare("UPDATE users SET token = :token WHERE email = :email");
        $sql->bindValue(':token', $token);
        $sql->bindValue(':email', $email);
        $sql->execute();

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
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $newUser = $this->formulateUser($data);
            return $newUser;
        }
    }

    
}
?>