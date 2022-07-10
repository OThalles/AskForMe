<?php
require_once('UserDao.php');
require_once('models/Post.php');


class postDao implements postInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    public function sendPostToUser(Post $post) {

    
        $sql = $this->pdo->prepare("INSERT INTO posts(user_from,user_to,body,sended_date) VALUES (:user_from, :user_to, :body, :sended_date)");
        $sql->bindValue(':user_from', $post->user_from);
        $sql->bindValue(':user_to', $post->user_to);
        $sql->bindValue(':body', $post->body);
        $sql->bindValue(':sended_date', $post->sended_date);
        $sql->execute();
    }

    public function getPostsProfile($id) {
        $postList = [];
        $userDao = new UserDao($this->pdo);
        $sql = $this->pdo->prepare("SELECT * FROM posts WHERE user_to = :user_to");
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
                $postList[] = $newPost;

            }
            return $postList;
        }

        
    }
} 

