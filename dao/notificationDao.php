<?php
require_once('models/Notification.php');
require_once('UserDao.php');

class notificationDao implements notificationInterface {
    private $pdo;

    public function __construct($driver) {
        $this->pdo = $driver;
    }

    public function getNotificationsUser($user_to) {
        $userDao = new userDao($this->pdo);
        $notifications = [];
        $sql = $this->pdo->prepare("SELECT * from notifications WHERE user_to = :user_to ORDER BY created_at DESC");
        $sql->bindValue(':user_to', $user_to);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $notification) {
                $newNotification = new Notification();
                $newNotification->user_to = $notification['user_to'];
                $newNotification->user_from = $notification['user_from'];
                $newNotification->body = $notification['body'];

                $newNotification->user = $userDao->getUserById($notification['user_from']);
                $notifications[] = $newNotification;
            }
            return $notifications;
        } 
    }

    public function addNotification($user_to, $user_from, $body, $created_at) {
        $sql = $this->pdo->prepare("INSERT INTO notifications(user_from, user_to, body, created_at) VALUES(:user_from, :user_to, :body, :created_at)");
        $sql->bindValue(':user_to', $user_to);
        $sql->bindValue(':user_from', $user_from);
        $sql->bindValue(':body', $body);
        $sql->bindValue(':created_at', $created_at);
        $sql->execute();
    }

}