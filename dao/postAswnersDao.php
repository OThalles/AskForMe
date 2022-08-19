<?php
require_once('UserDao.php');
require_once('notificationDao.php');
require_once('postDao.php');
require_once('models/postAswners.php');


class postAswnersDAO implements postAswnersInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    public function addComment(PostAswners $aswner) {
        $bodyNotification = 'respondeu sua pergunta';

        $sql = $this->pdo->prepare("INSERT INTO postaswners(post_id,user_from,body,sended_date) VALUES(:post_id, :user_from, :body, :sended_date)");
        $sql->bindValue(':post_id', $aswner->post_id);
        $sql->bindValue(':user_from', $aswner->user_from);
        $sql->bindValue(':body', $aswner->body);
        $sql->bindValue(':sended_date', $aswner->sended_date);
        $sql->execute();

        $postDao = new postDao($this->pdo);
        $findUserByPost = $postDao->findUserByPost($aswner->post_id);
        if($findUserByPost) {
            $authorPost = $findUserByPost;
        }

        $notificationDao = new notificationDao($this->pdo);
        $notificationDao->addNotification($authorPost,$aswner->user_from,$bodyNotification,date('Y-m-d H:i:s'));
        
    }

    public function getAswners($id_post) {
        if(!empty($id_post)) {
            $newAswner = [];
            $userDao = new UserDao($this->pdo);
            $sql = $this->pdo->prepare("SELECT * FROM postaswners WHERE post_id = :post_id");
            $sql->bindValue(':post_id', $id_post);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $item) {
                    $postAswners = new postAswners();
                    $postAswners->id = $item['id'];
                    $postAswners->post_id = $item['post_id'];
                    $postAswners->user_from = $item['user_from'];
                    $postAswners->body = $item['body']; 
                    $postAswners->sended_date = $item['sended_date'];

                    $postAswners->user = $userDao->getUserById($item['user_from']);
                    $newAswner[] = $postAswners;
                }

                return $newAswner;

            }
        }
    }
} 

