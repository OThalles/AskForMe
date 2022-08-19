<?php
require_once('models/User.php');


class UserDao implements UserInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    private function formulateUser($data, $all=True) {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->photo = $data['photo'];
        if($all) {
        $user->email = $data['email'];
        $user->description = $data['description'];
        $user->password = $data['password'];
        $user->birthdate = $data['birthdate'];
        $user->city = $data['description'];
        $user->lastconnection = $data['lastconnection'];
        $user->token = $data['token'];
        }
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

    public function otherUsers() {
        $sql = $this->pdo->prepare("SELECT * FROM users ORDER BY RAND() LIMIT 5;");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $selectedProfiles = [];
            foreach($data as $profile) {
                if(in_array($profile['id'], $selectedProfiles)===False) {
                    $selectedProfiles[] = $profile;
                }
            }

            return $selectedProfiles;
        }

    }

    public function updateTokenByEmail($token, $email) {
        $sql = $this->pdo->prepare("UPDATE users SET token = :token WHERE email = :email");
        $sql->bindValue(':token', $token);
        $sql->bindValue(':email', $email);
        $sql->execute();

    }


    public function insert(User $user) {
        $sql = $this->pdo->prepare("INSERT INTO users(name,email,password,birthdate,token,created_at) VALUES (:name, :email, :password, :birthdate,:token, :created_at)");
        $sql->bindValue(':name', $user->name);
        $sql->bindValue(':email', $user->email);
        $sql->bindValue(':password', $user->password);
        $sql->bindValue(':birthdate', $user->birthdate);
        $sql->bindValue(':token', $user->token);
        $sql->bindValue(':created_at', $user->created_at);
        $sql->execute();
    }
    
    public function update(User $info) {
        $sql = $this->pdo->prepare("UPDATE users
         set name = :name,
         email = :email,
         password = :password,
         birthdate = :birthdate,
         photo = :photo,
         description = :description
         WHERE id = :id_user");

        $sql->bindValue(':id_user', $info->id);
        $sql->bindValue(':name', $info->name);
        $sql->bindValue(':email', $info->email);
        $sql->bindValue(':password', $info->password);
        $sql->bindValue(':birthdate', $info->birthdate);
        $sql->bindValue(':photo', $info->photo);
        $sql->bindValue(':description', $info->description);
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

    public function searchUsers($name) {
        if(!empty($name) && is_int($name)===False) {
            $found = [];
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE name LIKE '%$name%'");
            $sql->execute();
            if($sql->rowCount() > 0) {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $user) {
                    $newUser = $this->formulateUser($user, False);
                    $found[] = $newUser;
                }
                return $found;
            }
        }
    }

    
}
?>