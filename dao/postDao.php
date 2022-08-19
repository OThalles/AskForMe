<?php
require_once('UserDao.php');
require_once('postAswnersDao.php');
require_once('notificationDao.php');
require_once('models/Post.php');


class postDao implements postInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    public function sendPostToUser(Post $post) {
        $bodyNotification = "Fez uma pergunta para você";
        $notification = new notificationDao($this->pdo);
        $notification->addNotification($post->user_to,$post->user_from, $bodyNotification, date('Y-m-d H:i:s'));
    
        $sql = $this->pdo->prepare("INSERT INTO posts(user_from,user_to,body,sended_date) VALUES (:user_from, :user_to, :body, :sended_date)");
        $sql->bindValue(':user_from', $post->user_from);
        $sql->bindValue(':user_to', $post->user_to);
        $sql->bindValue(':body', $post->body);
        $sql->bindValue(':sended_date', $post->sended_date);
        $sql->execute();
    }

    public function findUserByPost($id_post) {
        $sql = $this->pdo->prepare('SELECT * FROM posts WHERE id = :id_post');
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data['user_from'];
        }
        return False;
    }

    public function isMyProfile($id_post) {
        $sql = $this->pdo->prepare("SELECT user_to FROM posts WHERE  id = :id_post");
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data['user_to'];
        }
        return False;
    }    

    public function getPostsProfile($id) {
        $postList = [];
        $userDao = new UserDao($this->pdo);
        $postAswnersDao = new postAswnersDao($this->pdo);
        $sql = $this->pdo->prepare("SELECT * FROM posts WHERE user_to = :user_to ORDER BY sended_date DESC");
        $sql->bindValue(':user_to', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($data as $post) {
                $newPost = new Post();
                $newPost->id = $post['id'];
                $newPost->user_from = $post['user_from'];
                $newPost->user_to = $post['user_to'];
                $newPost->body = $post['body'];
                $newPost->sended_date = $post['sended_date'];

                $newPost->user = $userDao->getUserById($post['user_from']);
                

                $newPost->comments = $postAswnersDao->getAswners($post['id']);
                $postList[] = $newPost;



            }

            return $postList;
        }

        
    }
} 

